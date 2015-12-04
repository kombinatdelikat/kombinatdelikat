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
 * Load tl_content language file
 */
\System::loadLanguageFile('tl_content');


/**
 * Table tl_accounting_correspondence
 */
$GLOBALS['TL_DCA']['tl_accounting_correspondence'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_content'),
		'switchToEdit'                => true,
		'onload_callback'             => array
		(
			array('tl_accounting_correspondence', 'onLoad')
		),
		'enableVersioning'            => true,
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
			'fields'                  => array('title'),
			'flag'                    => 11,
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_class'      => 'no_padding'
		),
		'label' => array
		(
			'fields'                  => array('title', 'date', 'responsible', 'customer'),
			'format'                  => '<strong>%s</strong><span style="display:block;width:350px;margin:5px 3px;padding:5px;border:3px dashed #ddd;font-family:Monaco,Courier,serif">%s<span style="display:block;font-size:10px">%s</span><span style="display:block;font-size:13px">%s</span></span>',
			'label_callback'          => array
			(
				'tl_accounting_correspondence', 'setLabel'
			)
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['edit'],
				'href'                => 'table=tl_content',
				'icon'                => 'edit.gif',
				'button_callback'     => array('tl_accounting_correspondence', 'edit')
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'print' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['print'],
				'href'                => 'key=print',
				'icon'                => 'system/modules/accounting/assets/img/accounting_pdf.gif',
				'button_callback'     => array('tl_accounting_correspondence', 'printCorrespondence')
			)
		)
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array
		(
			array('tl_accounting_correspondence', 'addPrintButton')
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(),
		'default'                     => '{date_legend},locked,date;{content_legend},customer,responsible,title,format;{layout_legend},layout'
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
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['date'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'clr w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'locked' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['locked'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'default'                 => 0,
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 m12', 'doNotCopy'=>true, 'doNotShow'=>true, 'isBoolean'=>true),
			'sql'                     => "char(1) NOT NULL default '0'"
		),
		'customer' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['customer'],
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['responsible'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'foreignKey'              => 'tl_address.id',
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('\develab\accounting\Helper', 'getContacts'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'layout' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_correspondence']['layout'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_accounting_settings_layouts.title',
			'load_callback'           => array(array('tl_accounting_correspondence', 'getDefaultLayout')),
			'eval'                    => array('chosen'=>true, 'tl_class'=>'w50', 'mandatory'=>true, 'alwaysSave'=>true),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);

class tl_accounting_correspondence extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function onLoad(DataContainer $dc)
	{
		$this->checkLocked();
	}

	protected function getLockStatus($objCorrespondenceModel=null)
	{
		if (!$objCorrespondenceModel)
		{
			if (!\Input::get('id'))
			{
				return;
			}

			$objCorrespondenceModel = \develab\accounting\Models\CorrespondenceModel::findOneBy('id', \Input::get('id'));
		}

		if (is_null($objCorrespondenceModel))
		{
			return;
		}

		return $objCorrespondenceModel->locked;
	}

	protected function checkLocked()
	{
		$blnReadonly = $this->getLockStatus();

		foreach ($GLOBALS['TL_DCA']['tl_accounting_correspondence']['fields'] as $k=>&$v)
		{
			if ($k != 'locked')
			{
				$v['eval']['readonly'] = $blnReadonly;
				//$v['eval']['disabled'] = $blnReadonly;
			}
		}
	}

	public function edit($row, $href, $label, $title, $icon, $attributes)
	{
		$objCorrespondenceModel = develab\accounting\Models\CorrespondenceModel::findOneBy('id', $row['id']);

		return !$this->getLockStatus($objCorrespondenceModel) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}

	public function setLabel($arrRow, $strLabel, DataContainer $dc, $args)
	{
		$args[0] = $this->replaceInsertTags($arrRow['title']);
		$args[2] = '';
		$args[3] = '';

		$objResponsible = \MemberModel::findOneBy('id', $arrRow['responsible']);
		if (!is_null($objResponsible))
		{
			$args[2].= $objResponsible->company ? '<strong>' . $objResponsible->company . '</strong>' : '';
			$args[2].= (!$objResponsible->company ? '<strong>' : ', ') . $objResponsible->firstname . ' ' . $objResponsible->lastname . (!$objResponsible->company ? '</strong>' : '');
			$args[2].= ', ' . $objResponsible->street;
			$args[2].= ', ' . strtoupper($objResponsible->country ?: 'de') . '-' . $objResponsible->postal . ' ' . $objResponsible->city;
		}

		$objCustomer = \MemberModel::findOneBy('id', $arrRow['customer']);
		if (!is_null($objCustomer))
		{
			$args[3].= $objCustomer->company ? '<br><strong>' . $objCustomer->company . '</strong>' : '';
			$args[3].= '<br>' . (!$objCustomer->company ? '<strong>' : '') . $objCustomer->firstname . ' ' . $objCustomer->lastname . (!$objCustomer->company ? '</strong>' : '');
			$args[3].= '<br>' . $objCustomer->street;
			$args[3].= '<br>' . strtoupper($objCustomer->country ?: 'de') . '-' . $objCustomer->postal . ' ' . $objCustomer->city;
		}

		$strLocked = Image::getHtml('/system/modules/accounting/assets/img/accounting_' . ($arrRow['locked'] ? '' : 'un') . 'locked.png', 'lock') . ' ';

		return $strLocked . vsprintf($GLOBALS['TL_DCA']['tl_accounting_correspondence']['list']['label']['format'], $args);
	}

	public function getDefaultLayout($varValue)
	{
		if (empty($varValue))
		{
			$varValue = \Contao\Config::get('layout_correspondence');
		}

		return $varValue;
	}

	public function printCorrespondence($arrRow, $strHref, $strLabel, $strTitle, $strIcon)
	{
		$blnForce = false;
		$strReturn = '<a href="'.$this->addToUrl($strHref.'&amp;id='.$arrRow['id']).'" target="_blank" title="'.specialchars($strTitle).'" onclick="window.setTimeout(function(){window.location.reload()},500)">'.Image::getHtml($strIcon, $strLabel).'</a> ';

		if (\Input::get('key') == 'print' && \Input::get('id'))
		{
			$objCorrespondenceModel = \develab\accounting\Models\CorrespondenceModel::findOneBy('id', \Input::get('id'));
			if (is_null($objCorrespondenceModel))
			{
				return $strReturn;
			}

			$objModule = new \develab\accounting\Modules\ModuleCorrespondence($objCorrespondenceModel);
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
			$objModels = \develab\accounting\Models\CorrespondenceModel::findBy(array("id IN('" . implode("','", $ids) . "')"), null, array('order'=>'date ASC'));

			if (!is_null($objModels))
			{
				foreach ($objModels as $objModel)
				{
					$objModule = new \develab\accounting\Modules\ModuleCorrespondence($objModel);
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
