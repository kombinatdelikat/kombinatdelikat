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

\System::loadLanguageFile('tl_accounting_settings_units');
\System::loadLanguageFile('tl_accounting_settings_layouts');

/**
 * Table tl_accounting_offers
 */
$GLOBALS['TL_DCA']['tl_accounting_offers'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_content'),
		'enableVersioning'            => true,
		'switchToEdit'                => true,
		'onload_callback'             => array
		(
			array('tl_accounting_offers', 'onLoad')
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
			'fields'                  => array('no', 'due', 'date', 'responsible', 'customer'),
			'format'                  => '<strong>%s</strong>, ' . $GLOBALS['TL_LANG']['MSC']['validation'] . ' %s<span style="display:block;width:350px;margin:5px 3px;padding:5px;border:3px dashed #ddd;font-family:Monaco,Courier,serif">%s<span style="display:block;font-size:10px">%s</span><span style="display:block;font-size:13px">%s</span></span>',
			'label_callback'          => array
			(
				'tl_accounting_offers', 'setLabel'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_offers']['edit'],
				'href'                => 'table=tl_content',
				'icon'                => 'edit.gif',
				'button_callback'     => array('tl_accounting_offers', 'edit')
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_offers']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_offers']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_offers']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_offers']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'print' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_offers']['print'],
				'href'                => 'key=print',
				'icon'                => 'system/modules/accounting/assets/img/accounting_pdf.gif',
				'button_callback'     => array('tl_accounting_offers', 'printBill')
			)
		)
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array
		(
			array('tl_accounting_offers', 'addPrintButton')
		)
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
		'default'                     => '{date_legend},no,locked,date,due;{content_legend},customer,responsible,salutation;{fields_legend:hide},fields,categories;{layout_legend},layout'
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
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'eval'                    => array('doNotCopy'=>true, 'doNotShow'=>true)
		),
		'file_generated' => array
		(
			'sql'                     => "binary(16) NULL",
			'eval'                    => array('doNotCopy'=>true, 'doNotShow'=>true)
		),
		'generated' => array
		(
			'inputType'               => 'checkbox',
			'default'                 => 0,
			'eval'                    => array('doNotCopy'=>true, 'doNotShow'=>true, 'isBoolean'=>true),
			'sql'                     => "char(1) NOT NULL default '0'"
		),
		'no' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_offers']['no'],
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_offers']['locked'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'default'                 => 0,
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 m12', 'doNotCopy'=>true, 'doNotShow'=>true, 'isBoolean'=>true),
			'sql'                     => "char(1) NOT NULL default '0'"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_offers']['date'],
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_offers']['due'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=> 'w50'),
			'load_callback'           => array(array('tl_accounting_offers', 'getDue')),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'customer' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_offers']['customer'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'foreignKey'              => 'tl_address.id',
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('\develab\accounting\Helper', 'getContacts'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'responsible' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_offers']['responsible'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'foreignKey'              => 'tl_address.id',
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('\develab\accounting\Helper', 'getContacts'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'salutation' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_offers']['salutation'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'decodeEntities'=>true, 'tl_class'=>'clr'),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		),
		'fields' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fields'],
			'options'                 => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fields_types'],
			'load_callback'           => array(array('\develab\accounting\Helper', 'getDefaultFields')),
			'inputType'               => 'checkboxWizard',
			'eval' 			          => array('tl_class'=>'clr w50', 'multiple'=>true, 'alwaysSave'=>true),
			'sql'                     => "blob NULL"
		),
		'categories' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_units']['accounting_categories'],
			'load_callback'           => array(array('\develab\accounting\Helper', 'getDefaultCategories')),
			'inputType'               => 'listWizard',
			'eval' 			          => array('tl_class'=>'clr long', 'alwaysSave'=>true),
			'sql'                     => "blob NULL"
		),
		'layout' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_offers']['layout'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_accounting_settings_layouts.title',
			'load_callback'           => array(array('tl_accounting_offers', 'getDefaultLayout')),
			'eval'                    => array('chosen'=>true, 'tl_class'=>'w50', 'mandatory'=>true, 'alwaysSave'=>true),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);

class tl_accounting_offers extends Backend
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

			$objBillModel = \develab\accounting\Models\OffersModel::findOneBy('id', \Input::get('id'));
		}

		if (is_null($objBillModel))
		{
			return;
		}

		return $objBillModel->locked; //\Config::get('edit_locked') ? $objBillModel->locked : ($objBillModel->generated ?: $objBillModel->locked);
	}

	protected function checkLocked()
	{
		$blnReadonly = $this->getLockStatus();

		foreach ($GLOBALS['TL_DCA']['tl_accounting_offers']['fields'] as $k=>&$v)
		{
			if ($k != 'locked')
			{
				$v['eval']['readonly'] = $blnReadonly;
			}
		}
	}

	public function edit($row, $href, $label, $title, $icon, $attributes)
	{
		$objBillModel = develab\accounting\Models\OffersModel::findOneBy('id', $row['id']);

		return !$this->getLockStatus($objBillModel) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}

	public function setLabel($arrRow, $strLabel, DataContainer $dc, $args)
	{
		if (empty($args[0]))
		{
			$args[0] = "Angebotsnummer wird beim Drucken generiert";
		}
		$args[1] = \Date::parse(\Config::get('dateFormat'), $arrRow['date'] + (60 * 60 * 24 * $arrRow['due']));
		$args[3] = '';
		$args[4] = '';

		$objResponsible = \MemberModel::findOneBy('id', $arrRow['responsible']);
		if (!is_null($objResponsible))
		{
			$args[3].= $objResponsible->company ? '<strong>' . $objResponsible->company . '</strong>' : '';
			$args[3].= (!$objResponsible->company ? '<strong>' : ', ') . $objResponsible->firstname . ' ' . $objResponsible->lastname . (!$objResponsible->company ? '</strong>' : '');
			$args[3].= ', ' . $objResponsible->street;
			$args[3].= ', ' . strtoupper($objResponsible->country ?: 'de') . '-' . $objResponsible->postal . ' ' . $objResponsible->city;
		}

		$objCustomer = \MemberModel::findOneBy('id', $arrRow['customer']);
		if (!is_null($objCustomer))
		{
			$args[4].= $objCustomer->company ? '<br><strong>' . $objCustomer->company . '</strong>' : '';
			$args[4].= '<br>' . (!$objCustomer->company ? '<strong>' : '') . $objCustomer->firstname . ' ' . $objCustomer->lastname . (!$objCustomer->company ? '</strong>' : '');
			$args[4].= '<br>' . $objCustomer->street;
			$args[4].= '<br>' . strtoupper($objCustomer->country ?: 'de') . '-' . $objCustomer->postal . ' ' . $objCustomer->city;
		}

		$strLocked = Image::getHtml('/system/modules/accounting/assets/img/accounting_' . ($arrRow['locked'] ? '' : 'un') . 'locked.png', 'lock') . ' ';

		return $strLocked . vsprintf($GLOBALS['TL_DCA']['tl_accounting_offers']['list']['label']['format'], $args);
	}

	public function getDefaultLayout($varValue)
	{
		if (empty($varValue))
		{
			$varValue = \Contao\Config::get('layout_offers');
		}

		return $varValue;
	}

	public function getDue($varValue, DataContainer $dc)
	{
		if (empty($varValue))
		{
			$varValue = \Contao\Config::get('due_offers');
		}

		return $varValue;
	}

	public function printBill($arrRow, $strHref, $strLabel, $strTitle, $strIcon)
	{
		$blnForce = false;
		$strReturn = '<a href="'.$this->addToUrl($strHref.'&amp;id='.$arrRow['id']).'" target="_blank" title="'.specialchars($strTitle).'" onclick="window.setTimeout(function(){window.location.reload()},500)">'.Image::getHtml($strIcon, $strLabel).'</a> ';

		if (\Input::get('key') == 'print' && \Input::get('id'))
		{
			$objModel = \develab\accounting\Models\OffersModel::findOneBy('id', \Input::get('id'));
			if (is_null($objModel))
			{
				return $strReturn;
			}

			$objModule = new \develab\accounting\Modules\ModuleOffers($objModel);
			$objModule->generatePDF();
		}

		return $strReturn;
	}

	public function addPrintButton($arrButtons)
	{
		if (Input::post('FORM_SUBMIT') == 'tl_select' && isset($_POST['print']))
		{
			$session = $this->Session->getData();
			$ids = $session['CURRENT']['IDS'];
			$objModels = \develab\accounting\Models\OffersModel::findBy(array("id IN('" . implode("','", $ids) . "')"), null, array('order'=>'date ASC'));

			if (!is_null($objModels))
			{
				foreach ($objModels as $objModel)
				{
					$objModule = new \develab\accounting\Modules\ModuleOffers($objModel);
					$objModule->generatePDF(true, true);
				}
			}

			$this->redirect($this->getReferer());
		}

		// Add the button
		$arrButtons['print'] = '<input type="submit" name="print" id="print" class="tl_submit" accesskey="p" value="'.specialchars($GLOBALS['TL_LANG']['MSC']['printSelected']).'"> ';

		return $arrButtons;
	}
}
