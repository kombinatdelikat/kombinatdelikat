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
			array('tl_accounting_bills', 'onLoad')
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
			'mode'                    => 2,
			'fields'                  => array('date', 'no DESC'),
			'panelLayout'             => 'filter;sort,search,limit'
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
				'icon'                => 'edit.gif',
				'button_callback'     => array('tl_accounting_bills', 'edit')
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
		'tstamp_generated' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'file_generated' => array
		(
			'sql'                     => "binary(16) NULL"
		),
		'generated' => array
		(
			'inputType'               => 'checkbox',
			'default'                 => 0,
			'eval'                    => array('doNotCopy'=>true, 'doNotShow'=>true),
			'sql'                     => "char(1) NOT NULL default '0'"
		),
		'no' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['no'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 12,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50', 'readonly'=>true, 'doNotCopy'=>true, 'doNotShow'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'locked' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['locked'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'default'                 => 0,
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 m12', 'doNotCopy'=>true, 'doNotShow'=>true),
			'sql'                     => "char(1) NOT NULL default '0'"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['date'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'default'                 => time(),
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'clr w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'due' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['due'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=> 'w50'),
			'load_callback'           => array(array('tl_accounting_bills', 'getDue')),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'customer' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_bills']['customer'],
			'exclude'                 => true,
			'filter'                  => true,
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
			'filter'                  => true,
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
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function onLoad(DataContainer $dc)
	{
		$arrSession = $this->Session->getData();

		if ($arrSession['sorting'][$dc->table] == 'no DESC')
		{
			$GLOBALS['TL_DCA'][$dc->table]['list']['sorting']['disableGrouping'] = true;
		}

		$this->checkLocked();
	}

	protected function getLockStatus($objBillModel=null)
	{
		if (!$objBillModel)
		{
			if (!\Input::get('id'))
			{
				return;
			}

			$objBillModel = \develab\accounting\Models\Bills::findOneBy('id', \Input::get('id'));
		}

		if (is_null($objBillModel))
		{
			return;
		}

		return \Config::get('edit_locked') ? $objBillModel->locked : ($objBillModel->generated ?: $objBillModel->locked);
	}

	protected function checkLocked()
	{
		$blnReadonly = $this->getLockStatus();

		foreach ($GLOBALS['TL_DCA']['tl_accounting_bills']['fields'] as $k=>&$v)
		{
			if ($k != 'locked')
			{
				$v['eval']['readonly'] = $blnReadonly;
			}
		}
	}

	public function edit($row, $href, $label, $title, $icon, $attributes)
	{
		$objBillModel = \develab\accounting\Models\Bills::findOneBy('id', $row['id']);

		return $this->User->isAdmin || !$this->getLockStatus($objBillModel) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
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

		if (\Input::get('key') == 'print' && $arrRow['id'])
		{
			$objBillModel = \develab\accounting\Models\Bills::findOneBy('id', $arrRow['id']);
			if (is_null($objBillModel))
			{
				return $strReturn;
			}

			if (\Input::get('force'))
			{
				$blnForce = true;
			}

			// Get cached
			$strFile = false;
			if ($objBillModel->file_generated)
			{
				$objFile = \FilesModel::findByUuid($objBillModel->file_generated);

				if (!is_null($objFile) && file_exists(TL_ROOT . '/' . $objFile->path))
				{
					$strFile = $objFile->path;
				}
			}

			if (!$objBillModel->generated || !$objBillModel->locked || !$strFile || $blnForce)
			{
				// Generate bill number
				if (empty($objBillModel->no))
				{
					$objBillModel->no = $this->replaceInsertTags(\Contao\Config::get('no_bills_pattern'), false);
					\Contao\Config::persist('no_bills_current', \Contao\Config::get('no_bills_current') + 1);
				}

				$objBillModel->tstamp_generated = time();
				$objBillModel->generated = 1;
				$objBillModel->locked = 1;
				$objBillModel->save();

				// Render template
				$objModule = new \develab\accounting\Modules\ModulePDF($objBillModel);
				$objModule->ptable = 'tl_accounting_bills';
				$objModule->bill = $arrRow['id'];

				$strTemplate = $objModule->generate();
				$strTemplate = $this->replaceInsertTags($strTemplate);
				$strTemplate = html_entity_decode($strTemplate, ENT_QUOTES, \Config::get('characterSet') ?: 'utf-8');

				if (\Input::get('preview'))
				{
					exit($strTemplate);
				}

				// Create new PDF document
				require_once TL_ROOT . '/vendor/mpdf-5.7.3/mpdf.php';
				$objMpdf = new \mPDF('', 'A4', 12, 'opensanscondensed', 25, 25, 50, 50, 0, 0, 'P');
				$objMpdf->allow_charset_conversion = true;
				$objMpdf->list_indent_first_level = true;
				$objMpdf->charset_in = $strCharset;
				$objMpdf->SetDisplayMode('fullpage');
				$objMpdf->SetImportUse();

				// Set pdf background
				if (\Config::get('tpl_bills'))
				{
					$objBgFile = \FilesModel::findByUuid(\Config::get('tpl_bills'));

					if (!is_null($objBgFile) && file_exists(TL_ROOT . '/' . $objBgFile->path))
					{
						$objMpdf->SetDocTemplate(TL_ROOT . '/' . $objBgFile->path, true);
					}
				}

				// Set save path
				$strFolder = '/system/tmp';
				if (\Config::get('path_bills'))
				{
					$objFolder = \FilesModel::findByUuid(\Config::get('path_bills'));

					if (!is_null($objFolder) && file_exists(TL_ROOT . '/' . $objFolder->path))
					{
						$strFolder = $objFolder->path;
					}
				}
				$strFile = $objBillModel->no . '.pdf';
				$strPath = $strFolder. '/' . $strFile;

				// Output to file
				$objMpdf->WriteHTML($strTemplate);
				$objMpdf->Output(TL_ROOT. '/' . $strPath, 'F');

				// Save cached file to bill
				$objFile = new \File($strPath);
				if (!is_null($objFile))
				{
					$objFile->close();
					$objBillModel->file_generated = $objFile->getModel()->uuid;
					$objBillModel->save();
				}

				// Output to screen
				$objMpdf->Output();
				exit;
			}

			// Load cached file
			elseif ($strFile)
			{
				$this->redirect($strFile);
			}
		}

		return $strReturn;
	}
}
