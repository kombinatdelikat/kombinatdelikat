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
 * Dynamically add the permission check and parent table
 */

if (Input::get('do') == 'accounting_correspondence')
{
	$GLOBALS['TL_CTE'] = $GLOBALS['TL_CTE_CORRESPONDENCE'];

	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_correspondence';
}
if (Input::get('do') == 'accounting_bills')
{
	$GLOBALS['TL_CTE'] = $GLOBALS['TL_CTE_BILLS'];

	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_bills';
	$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_accounting', 'checkPermissions');
	$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'] = array('date');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['options_callback'] = array('tl_content_accounting', 'getBillContentElements');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['default'] = 'accounting_item';
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['eval']['helpwizard'] = false;
}
if (Input::get('do') == 'accounting_offers')
{
	$GLOBALS['TL_CTE'] = $GLOBALS['TL_CTE_OFFERS'];

	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_offers';
	$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_accounting', 'checkPermissions');
	$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'] = array('date');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['options_callback'] = array('tl_content_accounting', 'getOfferContentElements');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['default'] = 'accounting_item';
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['eval']['helpwizard'] = false;
}

$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_pdf_pb'] = '{type_legend},type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_item'] = '{type_legend},type;{price_legend},quantity,price_unit,tax;{date_legend:hide},date_from,date_to;{content_legend},name,description';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_subtotal'] = '{type_legend},type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_total'] = '{type_legend},type';

$GLOBALS['TL_DCA']['tl_content']['fields']['quantity'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['quantity'],
	'exclude'                 => true,
	'inputType'               => 'inputUnit',
	'options_callback'        => array('tl_content_accounting', 'getAccountingUnits'),
	'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['price_unit'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['price_unit'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'clr w50'),
	'save_callback'           => array(array('tl_content_accounting', 'formatPriceProxy')),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['tax'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['tax'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_accounting', 'getTaxTypes'),
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['date_from'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['date_from'],
	'default'                 => time(),
	'exclude'                 => true,
	'sorting'                 => true,
	'flag'                    => 8,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'clr w50 wizard'),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['date_to'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['date_to'],
	'default'                 => time(),
	'exclude'                 => true,
	'sorting'                 => true,
	'flag'                    => 8,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['name'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['name'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr long'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['description'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['description'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'textarea',
	'eval'                    => array('style'=>'height:60px!important', 'decodeEntities'=>true),
	'explanation'             => 'insertTags',
	'sql'                     => "mediumtext NULL"
);

class tl_content_accounting extends \develab\accounting\Helper
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function checkPermissions(DataContainer $dc)
	{
		if ($this->User->isAdmin)
		{
			return;
		}

		$objParent = null;
		switch ($dc->parentTable)
		{
			case 'tl_accounting_bills':
				$objParent = \develab\accounting\Models\Bills::findOneBy('id', $dc->id);
				break;
			case 'tl_accounting_offers':
				$objParent = \develab\accounting\Models\Bills::findOneBy('id', $dc->id);
				break;
		}

		if (is_null($objParent) || $objParent->locked)
		{
			$this->log('The parent entry is locked or not existant.', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}
	}

	public function getBillContentElements()
	{
		return $this->getAccountingContentElements('TL_CTE_BILLS');
	}

	public function getOfferContentElements()
	{
		return $this->getAccountingContentElements('TL_CTE_OFFERS');
	}

	public function getAccountingUnits()
	{
		$arrReturn = array();

		if (\Config::get('accounting_units'))
		{
			$arrReturn = deserialize(\Config::get('accounting_units'));
		}

		return $arrReturn;
	}

	public function getTaxTypes()
	{
		$arrReturn = array();
		$arrOptions = deserialize(\Config::get('accounting_taxes'), true);

		foreach ($arrOptions as $arrOption)
		{
			$arrReturn[$arrOption['accounting_tax_value']] = $arrOption['accounting_tax_name'];
		}

		return $arrReturn;
	}

	public function formatWeightProxy($varValue)
	{
		return parent::formatWeight($varValue, 3, '.', '');
	}

	public function formatPriceProxy($varValue)
	{
		return parent::formatPrice($varValue, 2, '.', '');
	}
}
