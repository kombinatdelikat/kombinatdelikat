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

\System::loadLanguageFile('tl_accounting_settings');

/**
 * Dynamically add the permission check and parent table
 */

if (Input::get('do') == 'accounting_correspondence')
{
	$GLOBALS['TL_CTE'] = $GLOBALS['TL_CTE_CORRESPONDENCE'];

	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_correspondence';
	$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_accounting', 'checkPermissions');
}
if (Input::get('do') == 'accounting_bills')
{
	$GLOBALS['TL_CTE'] = $GLOBALS['TL_CTE_BILLS'];

	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_bills';
	$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_accounting', 'checkPermissions');
	$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'] = array('date', 'no');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['options_callback'] = array('tl_content_accounting', 'getBillContentElements');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['default'] = 'accounting_item';
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['eval']['helpwizard'] = false;
}
if (Input::get('do') == 'accounting_offers')
{
	$GLOBALS['TL_CTE'] = $GLOBALS['TL_CTE_OFFERS'];

	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_accounting_offers';
	$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_accounting', 'checkPermissions');
	$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'] = array('date', 'no');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['options_callback'] = array('tl_content_accounting', 'getOfferContentElements');
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['default'] = 'accounting_item';
	$GLOBALS['TL_DCA']['tl_content']['fields']['type']['eval']['helpwizard'] = false;
}

$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_pdf_pb'] = '{type_legend},type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_item'] = '{type_legend},type,category;{price_legend},quantity,price_unit,tax;{date_legend:hide},date_from,date_to;{content_legend},name,description';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_overview'] = '{type_legend},type;{fields_legend},fields';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_scopesubtotal'] = '{type_legend},type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_scopetotal'] = '{type_legend},type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_subtotal'] = '{type_legend},type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['accounting_total'] = '{type_legend},type';

$GLOBALS['TL_DCA']['tl_content']['fields']['category'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['category'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_accounting', 'getCategories'),
	'eval'                    => array('tl_class'=>'w50', 'includeBlankOption'=>true, 'blankOptionLabel'=>&$GLOBALS['TL_LANG']['tl_content']['category_none']),
	'sql'                     => "varchar(32) NOT NULL default ''"
);
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
$GLOBALS['TL_DCA']['tl_content']['fields']['fields'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['fields_overview'],
	'options'                 => &$GLOBALS['TL_LANG']['tl_accounting_settings']['fields_types'],
	'inputType'               => 'checkboxWizard',
	'eval' 			          => array('mandatory'=>true, 'tl_class'=>'clr w50', 'multiple'=>true),
	'sql'                     => "blob NULL"
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
		$objParent = $this->getParentModel($dc->parentTable, $dc->id);

		if (is_null($objParent) || $objParent->locked)
		{
			$this->log('The parent entry is locked or not existent.', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}
	}

	protected function getParentModel($strParentTable, $intId)
	{
		if (\Contao\Input::get('act') == 'edit')
		{
			$objElement = \Contao\ContentModel::findOneBy('id', $intId);
			$intId = $objElement->pid;
		}

		$objParentClass = $GLOBALS['TL_MODELS'][$strParentTable];
		$objParentModel = $objParentClass::findOneBy('id', $intId);

		return $objParentModel;
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

	public function getCategories(DataContainer $dc)
	{
		$arrReturn = deserialize(\Config::get('accounting_categories'), true);

		if ($dc->activeRecord)
		{
			$objParent = $this->getParentModel($dc->activeRecord->ptable, $dc->activeRecord->pid);

			if (!is_null($objParent) && $objParent->categories)
			{
				$arrReturn = deserialize($objParent->categories, true);
			}
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
