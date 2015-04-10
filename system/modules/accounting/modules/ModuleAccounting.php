<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting\Modules;

abstract class ModuleAccounting extends \Contao\Module
{
	protected $strType;

	protected function compile()
	{
		\System::loadLanguageFile('tl_accounting_' . $this->strType);

		$blnDebug = \Input::get('debug') ? true : false;
		$strTitle = strip_tags($this->title);
		$strCharset = \Config::get('characterSet') ?: 'utf-8';
		$objSender = $this->objModel->getRelated('responsible');
		$objRecipient = $this->objModel->getRelated('customer');
		$objLayout = $this->objModel->getRelated('layout');

		// Create template object
		$this->Template->debug = $blnDebug;
		$this->Template->charset = $strCharset;
		$this->Template->sender = $objSender;
		$this->Template->recipient = $objRecipient;
		$this->Template->date = \Date::parse('d. F Y', $this->date);
		$this->Template->due = \Date::parse('d. F Y', $this->date + (60 * 60 * 24 * $this->due));
		$this->Template->salutation = $this->salutation;
		$this->Template->no = $this->objModel->no;
		$this->Template->fields = $this->objModel->getFields();

		// Set stylesheet
		if ($objLayout->css)
		{
			$objFile = \FilesModel::findByUuid($objLayout->css);

			if (!is_null($objFile) && file_exists(TL_ROOT . '/' . $objFile->path))
			{
				$this->Template->stylesheet = '/' . $objFile->path;
			}
		}

		// Prepare elements
		$arrElements = array();
		$objElements = \ContentModel::findPublishedByPidAndTable($this->objModel->id, 'tl_accounting_' . $this->strType);

		if (!is_null($objElements))
		{
			$i = 1;
			$blnIsAccounting = false;
			$blnPrevIsAccounting = false;
			$arrAccountingTypes = array_flip($GLOBALS['TL_CTE_' . strtoupper($this->strType)]['accounting'] ?: array());

			while ($objElements->next())
			{
				$blnIsAccounting = in_array($objElements->type, $arrAccountingTypes);
				$strClass = \ContentElement::findClass($objElements->type);
				$objElements->typePrefix = 'ce_';
				$objElement = new $strClass($objElements);
				$objElement->sender = $objSender;
				$objElement->recipient = $objRecipient;

				if ($objElements->type == 'accounting_item')
				{
					$objElement->position = $i;
					++$i;
				}

				// Insert table start
				if (!$blnPrevIsAccounting && $blnIsAccounting)
				{
					$objElementStart = new \develab\accounting\Elements\ContentAccountingStart($objElements);
					$arrElements[] = $objElementStart->generate();
				}

				// Insert table stop
				else if ($blnPrevIsAccounting && !$blnIsAccounting)
				{
					$objElementStop = new \develab\accounting\Elements\ContentAccountingStop($objElements);
					$arrElements[] = $objElementStop->generate();
				}

				$arrElements[] = $objElement->generate();

				$blnPrevIsAccounting = $blnIsAccounting;
			}

			// Close table if needed
			if ($blnPrevIsAccounting)
			{
				$objElementStop = new \develab\accounting\Elements\ContentAccountingStop($objElements);
				$arrElements[] = $objElementStop->generate();
			}
		}
		$this->Template->elements = $arrElements;
	}

	public function generatePDF($blnForce=false, $blnSilent=false)
	{
		$strFile = false;

		if (\Input::get('force'))
		{
			$blnForce = true;
		}

		// Get cached
		if ($this->objModel->file_generated)
		{
			$objFile = \FilesModel::findByUuid($this->objModel->file_generated);

			if (!is_null($objFile) && file_exists(TL_ROOT . '/' . $objFile->path))
			{
				$strFile = $objFile->path;
			}
		}

		if (!$this->objModel->generated || !$this->objModel->locked || !$strFile || $blnForce)
		{
			// Generate bill number
			if (empty($this->objModel->no))
			{
				$objConfig = \Contao\Config::getInstance();
				$strBuffer = $objConfig->get('no_' . $this->strType . '_pattern');
				$tags = preg_split('/\{\{(([^\{\}]*|(?R))*)\}\}/', $strBuffer, -1, PREG_SPLIT_DELIM_CAPTURE);
				$strBuffer = '';

				for ($_rit=0, $_cnt=count($tags); $_rit<$_cnt; $_rit+=3)
				{
					$strBuffer.= $tags[$_rit];
					$strTag = $tags[$_rit+1];

					if ($strTag == '')
					{
						continue;
					}

					$flags = explode('|', $strTag);
					$tag = array_shift($flags);
					$elements = explode('::', $tag);

					if ($elements[0] != 'accounting')
					{
						$strBuffer.= '{{' . $strTag . '}}';
						continue;
					}

					switch (strtolower($elements[1]))
					{
						case 'no_bills_current':
						case 'no_offers_current':
						case 'no_customers_current':
							$strReturn = $objConfig->get('no_' . $this->strType . '_current');
							if ($elements[2])
							{
								$strReturn = str_pad($strReturn, $elements[2], '0', STR_PAD_LEFT);
							}
							$strBuffer.= $strReturn;
							break;
						default:
							$strBuffer.= '{{' . $strTag . '}}';
							break;
					}
				}

				$this->objModel->no = $this->replaceInsertTags($strBuffer, false);

				$objConfig->persist('no_' . $this->strType . '_current', $objConfig->get('no_' . $this->strType . '_current') + 1);
				$objConfig->save();
				$objConfig->preload();
			}

			$this->objModel->tstamp_generated = time();
			$this->objModel->generated = 1;
			if (!$blnForce)
			{
				$this->objModel->locked = 1;
			}
			$this->objModel->save();

			// Render template
			$strTemplate = $this->generate();
			$strTemplate = $this->replaceInsertTags($strTemplate);
			$strTemplate = html_entity_decode($strTemplate, ENT_QUOTES, \Config::get('characterSet') ?: 'utf-8');

			// Get default settings
			$objLayout = $this->objModel->getRelated('layout');
			$strFormat = $objLayout->format ?: 'A4';
			$strFontFamily = $objLayout->fontyfamilly ?: 'opensanscondensed';
			$strFontsize = $objLayout->fontsize ?: 12;
			$strOrientation = $objLayout->orientation ?: 'P';
			$arrMargins = $objLayout->margin ? deserialize($objLayout->margin, true) : array(50, 25, 50, 25);

			// Create new PDF document
			require_once TL_ROOT . '/vendor/mpdf-5.7.3/mpdf.php';
			$objMpdf = new \mPDF('', $strFormat, $strFontsize, $strFontFamily, $arrMargins[3], $arrMargins[1], $arrMargins[0], $arrMargins[2], 0, 0, $strOrientation);
			$objMpdf->allow_charset_conversion = true;
			$objMpdf->list_indent_first_level = true;
			$objMpdf->charset_in = $strCharset;
			$objMpdf->SetDisplayMode('fullpage');
			$objMpdf->SetImportUse();

			// Set pdf background
			if ($objLayout->tpl_pdf)
			{
				$objBgFile = \FilesModel::findByUuid($objLayout->tpl_pdf);
	
				if (!is_null($objBgFile) && file_exists(TL_ROOT . '/' . $objBgFile->path))
				{
					$objMpdf->SetDocTemplate(TL_ROOT . '/' . $objBgFile->path, true);
				}
			}

			// Set save path
			$strFolder = '/system/tmp';
			if ($objLayout->path)
			{
				$objFolder = \FilesModel::findByUuid($objLayout->path);
	
				if (!is_null($objFolder) && file_exists(TL_ROOT . '/' . $objFolder->path))
				{
					$strFolder = $objFolder->path;
				}
			}

			// Set file name
			$arrSearch = array('/[^a-zA-Z0-9 \.\&\/_-]+/', '/[ \.\&\/-]+/');
			$arrReplace = array('', '-');

			$strFile = $this->objModel->no ?: $this->objModel->title;
			$strFile = html_entity_decode($strFile, ENT_QUOTES, $GLOBALS['TL_CONFIG']['characterSet']);
			$strFile = strip_insert_tags($strFile);
			$strFile = utf8_romanize($strFile);
			$strFile = preg_replace($arrSearch, $arrReplace, $strFile);
			$strFile = $strFile . '.pdf';
			$strPath = $strFolder. '/' . $strFile;

			// Exit on preview
			if (\Input::get('preview'))
			{
				exit($strTemplate);
			}

			// Output to file
			$objMpdf->WriteHTML($strTemplate);
			$objMpdf->Output(TL_ROOT. '/' . $strPath, 'F');

			// Save cached file
			$objFile = new \File($strPath);
			if (!is_null($objFile))
			{
				$objFile->close();
				$this->objModel->file_generated = $objFile->getModel()->uuid;
				$this->objModel->save();
			}

			// Output to screen
			if (!$blnSilent)
			{
				$objMpdf->Output();
				exit;
			}
		}

		// Load cached file
		elseif ($strFile && !$blnSilent)
		{
			$this->redirect($strFile);
		}
	}
}
