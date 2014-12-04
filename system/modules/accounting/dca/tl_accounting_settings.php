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
$GLOBALS['TL_DCA']['tl_accounting_settings'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'File',
		'closed'                      => true,
		'onload_callback'             => array(array('tl_accounting_settings', 'setDefaultValues'))
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(),
		'default'                     => '{no_legend:hide},no_bills_current,no_offers_current,no_bills_pattern,no_offers_pattern,due_bills,due_offers;{unit_legend},accounting_units;{tpl_legend},tpl_bills,tpl_offers'
	),

	// Subpalettes
	'subpalettes' => array
	(),

	// Fields
	'fields' => array
	(
		'no_bills_current' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['no_bills_current'],
			'inputType'               => 'text',
			'default'                 => 1,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50', 'readonly'=>true)
		),
		'no_offers_current' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['no_offers_current'],
			'inputType'               => 'text',
			'default'                 => 1,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50', 'readonly'=>true)
		),
		'no_bills_pattern' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['no_bills_pattern'],
			'inputType'               => 'text',
			'default'                 => '{{date::Ym}}R{{accounting::no_bills}}',
			'eval'                    => array('mandatory'=>true, 'nospace'=>true, 'tl_class'=>'clr w50')
		),
		'no_offers_pattern' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['no_offers_pattern'],
			'inputType'               => 'text',
			'default'                 => '{{date::Ym}}A{{accounting::no_bills}}',
			'eval'                    => array('mandatory'=>true, 'nospace'=>true, 'tl_class'=>'w50')
		),
		'due_bills' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['due_bills'],
			'inputType'               => 'text',
			'default'                 => 7,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'clr w50')
		),
		'due_offers' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['due_offers'],
			'inputType'               => 'text',
			'default'                 => 30,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50')
		),

		'accounting_units' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['accounting_units'],
			'inputType'               => 'listWizard',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'alnum', 'nospace'=>true, 'tl_class'=>'long')
		),

		'tpl_bills' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['tpl_bills'],
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'extensions'=>'pdf', 'tl_class'=>'clr w50')
		),
		'tpl_offers' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings']['tpl_offers'],
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'extensions'=>'pdf', 'tl_class'=>'w50')
		)
	)
);

class tl_accounting_settings extends Backend
{
	public function setDefaultValues(DataContainer $dc) {
		$arrModified = array();
		foreach ($GLOBALS['TL_DCA']['tl_accounting_settings']['fields'] as $strName => $arrField)
		{
			if ($arrField['default'] && !\Contao\Config::get($strName))
			{
				$arrModified[] = $strName;
				\Contao\Config::persist($strName, $arrField['default']);
			}
		}
		if (sizeof($arrModified))
		{
			\System::log('Added default accounting settings ('.implode(', ', $arrModified).')', __METHOD__, TL_CONFIGURATION);
			$this->reload();
		}
	}
}
