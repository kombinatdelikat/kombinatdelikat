<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting\Modules;

class ModulePDF extends \Contao\Module {

	protected $strTemplate = 'pdf_accounting_bills';


	protected function compile()
	{
		\System::loadLanguageFile('tl_accounting_bills');

		$blnDebug = \Input::get('debug') ? true : false;
		$strTitle = strip_tags($this->title);
		$strCharset = \Config::get('characterSet') ?: 'utf-8';
		$strBillsTemplate = 'pdf_accounting_bills';

		// Create template object
		$this->Template->debug = $blnDebug;
		$this->Template->charset = $strCharset;
		$this->Template->date = 'Dresden, den ' . \Date::parse('d. F Y', $this->date);
		$this->Template->due = \Date::parse('d. F Y', $this->date + (60 * 60 * 24 * $this->due));
		$this->Template->salutation = $this->salutation;
		$this->Template->sender = $this->objModel->getRelated('responsible');
		$this->Template->recipient = $this->objModel->getRelated('customer');
		$this->Template->fields = \develab\accounting\Helper::getFields($this->objModel);

		// Set stylesheet
		if (\Config::get('css_bills'))
		{
			$objFile = \FilesModel::findByUuid(\Config::get('css_bills'));

			if (!is_null($objFile) && file_exists(TL_ROOT . '/' . $objFile->path))
			{
				$this->Template->stylesheet = '/' . $objFile->path;
			}
		}

		// Prepare elements
		$strElements = '';
		$strAccounting = '';
		$objElements = \ContentModel::findPublishedByPidAndTable($this->objModel->id, 'tl_accounting_bills');
		if (!is_null($objElements))
		{
			$i = 1;
			while ($objElements->next())
			{
				$strClass = \ContentElement::findClass($objElements->type);
				$objElements->typePrefix = 'ce_';
				$objElement = new $strClass($objElements);
				$objElement->objParentModel = $this->objModel;
				$objElement->sender = $this->Template->sender;
				$objElement->recipient = $this->Template->recipient;

				if ($objElements->type == 'accounting_item')
				{
					$objElement->position = $i;
					++$i;
				}

				if (in_array($objElements->type, array_flip($GLOBALS['TL_CTE_BILLS']['accounting'])))
				{
					$strAccounting.= $objElement->generate();
				}
				else
				{
					$strElements.= $objElement->generate();
				}
			}
		}
		$this->Template->accounting = preg_replace_callback(
			'/(<h2)+( class=")*/i',
			function($arrResults) {
				return $arrResults[1] . ' class="first-of-type' . ($arrResults[2] ? ' ' : '"');
			},
			$strAccounting,
			1
		);
		$this->Template->content = preg_replace_callback(
			'/(<h2)+( class=")*/i',
			function($arrResults) {
				return $arrResults[1] . ' class="first-of-type' . ($arrResults[2] ? ' ' : '"');
			},
			$strElements,
			1
		);
	}
}