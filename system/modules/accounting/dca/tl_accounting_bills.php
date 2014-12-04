<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   KombinatDelikat
 * @author    David Enke <post@davidenke.de>
 * @license   EULA
 * @copyright David Enke 2014
 */


/**
 * Table tl_accounting_bills
 */
$GLOBALS['TL_DCA']['tl_accounting_bills'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_content'),
		'enableVersioning'            => true,
		'onload_callback'             => array
		(
			array('tl_accounting_bills', 'checkLocked')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('date DESC', 'no'),
			'flag'                    => 8,
			'panelLayout'             => 'filter;search,limit'
		),
		'label' => array
		(
			'fields'                  => array('no', 'due', 'date', 'customer'),
			'format'                  => '<strong style="text-transform:uppercase">%s</strong>, fällig am %s<span style="display:block;width:250px;margin:5px 0;padding:5px;border:1px solid #ccc;font-family:Courier">%s<br>%s</span>',
			'label_callback'          => array
			(
				'tl_accounting_bills', 'setLabel'
			)
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_bills']['edit'],
				'href'                => 'table=tl_content',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_bills']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_bills']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_bills']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_bills']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'print' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_bills']['print'],
				'href'                => 'key=print',
				'icon'                => 'assets/contao/images/print.gif',
				'button_callback'     => array('tl_accounting_bills', 'printBill')
			)
		)
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array()
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(),
		'default'                     => '{date_legend},no,locked,date,due;{content_legend},customer,responsible'
	),

	// Subpalettes
	'subpalettes' => array(),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'generated' => array
		(
			'sql'                     => "char(1) NOT NULL default '0'"
		),
		'no' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['no'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50', 'readonly'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'locked' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['locked'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 m12'),
			'sql'                     => "char(1) NOT NULL default '0'"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['date'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 6,
			'inputType'               => 'text',
			'default'                 => time(),
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'clr w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'due' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['due'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=> 'w50'),
			'load_callback'           => array(array('tl_accounting_bills', 'getDue')),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'customer' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['customer'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.id',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('\develab\accounting\Helper', 'getContacts'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'responsible' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['responsible'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.id',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('\develab\accounting\Helper', 'getContacts'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);

class tl_accounting_bills extends Backend
{

	public function checkLocked(DataContainer $dc)
	{
		if (!\Input::get('id'))
		{
			return;
		}

		$objBillModel = \develab\accounting\Models\Bills::findOneBy('id', \Input::get('id'));

		if (is_null($objBillModel))
		{
			return;
		}

		$GLOBALS['TL_DCA']['tl_accounting_bills']['fields']['no']['eval']['readonly'] = $objBillModel->generated ?: $objBillModel->locked;
	}

	public function setLabel($arrRow, $strLabel, DataContainer $dc, $args)
	{
		if (empty($args[0]))
		{
			$args[0] = "Rechnungsdatum wird beim Drucken gesetzt";
		}
		$args[1] = \Date::parse(\Config::get('dateFormat'), $arrRow['date'] + (60 * 60 * 24 * $arrRow['due']));
		$args[3] = '';

		$objCustomer = \MemberModel::findOneBy('id', $arrRow['customer']);
		if (!is_null($objCustomer))
		{
			$args[3].= $objCustomer->company ? '<strong>' . $objCustomer->company . '</strong>' : '';
			$args[3].= '<br>' . (!$objCustomer->company ? '<strong>' : '') . $objCustomer->firstname . ' ' . $objCustomer->lastname . (!$objCustomer->company ? '</strong>' : '');
			$args[3].= '<br>' . $objCustomer->street;
			$args[3].= '<br>' . strtoupper($objCustomer->country ?: 'de') . '-' . $objCustomer->postal . ' ' . $objCustomer->city;
		}

		return vsprintf($GLOBALS['TL_DCA']['tl_accounting_bills']['list']['label']['format'], $args);
	}

	public function getDue($varValue, DataContainer $dc)
	{
		if (empty($varValue))
		{
			$varValue = \Contao\Config::get('due_bills');
		}

		return $varValue;
	}

	public function printBill($arrRow, $strHref, $strLabel, $strTitle, $strIcon)
	{
		$strReturn = '<a href="'.$this->addToUrl($strHref.'&amp;id='.$arrRow['id']).'" target="_blank" title="'.specialchars($strTitle).'">'.Image::getHtml($strIcon, $strLabel).'</a> ';

		if (\Input::get('key') == 'print' && \Input::get('id'))
		{
			$objBillModel = \develab\accounting\Models\Bills::findOneBy('id', \Input::get('id'));
			if (is_null($objBillModel))
			{
				return $strReturn;
			}

			if (!$objBillModel->generated && empty($objBillModel->no))
			{
				$objBillModel->no = $this->replaceInsertTags(\Contao\Config::get('no_bills_pattern'), false);
				$objBillModel->generated = true;
				$objBillModel->locked = true;
				$objBillModel->save();

				\Contao\Config::persist('no_bills_current', \Contao\Config::get('no_bills_current') + 1);
			}

			$arrRow = $objBillModel->row();

			require_once TL_ROOT . '/system/modules/accounting/vendor/mpdf-5.7.3/mpdf.php';

			\System::loadLanguageFile('tl_accounting_bills');

			$blnDebug = false;
			$strTitle = strip_tags($arrRow['title']);
			$strCharset = \Config::get('characterSet') ?: 'utf-8';
			$strBillsTemplate = 'pdf_accounting_bills';

			// Create template object
			$objTemplate = new \BackendTemplate($strBillsTemplate);
			$objTemplate->setData($arrRow);
			$objTemplate->debug = $blnDebug;
			$objTemplate->charset = $strCharset;
			$objTemplate->date = 'Dresden, den ' . \Date::parse('d. F Y', $arrRow['date']);
			$objTemplate->customer = (object) \MemberModel::findOneBy('id', $arrRow['customer']);

			// Prepare elements
			$strElements = '';
			$objElements = \ContentModel::findPublishedByPidAndTable($arrRow['id'], 'tl_accounting_correspondence');
			if (!is_null($objElements))
			{
				while ($objElements->next())
				{
					$strElements.= $this->getContentElement($objElements->id);
				}
			}
			$objTemplate->content = preg_replace_callback(
				'/(<h2)+( class=")*/i',
				function($arrResults) {
					return $arrResults[1] . ' class="first-of-type' . ($arrResults[2] ? ' ' : '"');
				},
				$strElements,
				1
			);

			// Render template
			$strTemplate = $this->replaceInsertTags($objTemplate->parse());
			$strTemplate = html_entity_decode($strTemplate, ENT_QUOTES, $strCharset);
			//exit($strTemplate);

			// Create new PDF document
			$objMpdf = new \mPDF('', strtoupper($arrRow['format']), 12, 'opensanscondensed', 25, 25, 50, 70, 0, 0, 'P');
			$objMpdf->allow_charset_conversion = true;
			$objMpdf->list_indent_first_level = true;
			$objMpdf->charset_in = $strCharset;
			$objMpdf->SetDisplayMode('fullpage');
			$objMpdf->SetImportUse();

			if (\Config::get('tpl_bills'))
			{
				$objFile = \FilesModel::findByUuid(\Config::get('tpl_bills'));

				if (!is_null($objFile) && file_exists(TL_ROOT . '/' . $objFile->path))
				{
					$objMpdf->SetDocTemplate(TL_ROOT . '/' . $objFile->path, true);
				}
			}

			$objMpdf->WriteHTML($strTemplate);
			$objMpdf->Output();

			exit;
		}

		return $strReturn;
	}
}
