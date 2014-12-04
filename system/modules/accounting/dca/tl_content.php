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
	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_correspondence';
}
if (Input::get('do') == 'accounting_bills')
{
	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_bills';
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['options_callback'] = array('tl_content_accounting', 'getBillContentElements');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['default'] = 'accounting_item';
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['eval']['helpwizard'] = false;
}
if (Input::get('do') == 'accounting_offers')
{
	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_offers';
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['options_callback'] = array('tl_content_accounting', 'getOfferContentElements');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['default'] = 'accounting_item';
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['eval']['helpwizard'] = false;
}

$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_pdf_pb'] = '{type_legend},type;{template_legend:hide},customTpl';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_item'] = '{type_legend},type;{content_legend},quantity,price_unit,price_subtotal,name,description';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_subtotal'] = '{type_legend},type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_total'] = '{type_legend},type';

$GLOBALS['TL_DCA']['tl_content']['fields']['quantity'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['quantity'],
	'exclude'                 => true,
	'inputType'               => 'inputUnit',
	'options_callback'        => array('tl_content_accounting', 'getaccountingUnits'),
	'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

class tl_content_accounting extends \develab\accounting\Helper
{
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
}
