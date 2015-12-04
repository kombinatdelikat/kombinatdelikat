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
 * Table tl_accounting_settings_units
 */
$GLOBALS['TL_DCA']['tl_accounting_settings_units'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'File',
		'closed'                      => true,
		'onload_callback'             => array(array('develab\accounting\Helper', 'setDefaultValues'))
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(),
		'default'                     => '{unit_legend},accounting_currency,accounting_taxes,accounting_units;
										  {category_legend},accounting_categories'
	),

	// Subpalettes
	'subpalettes' => array
	(),

	// Fields
	'fields' => array
	(
		'accounting_currency' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_units']['accounting_currency'],
			'inputType'               => 'text',
			'default'                 => 'a:2:{i:0;s:4:"Euro";i:1;s:3:"€";}',
			'eval'                    => array('mandatory'=>true, 'multiple'=>true, 'size'=>2, 'nospace'=>true, 'tl_class'=>'clr')
		),
		'accounting_taxes' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_units']['accounting_taxes'],
			'inputType'               => 'multiColumnWizard',
			'default'                 => 'a:2:{i:0;a:3:{s:20:"accounting_tax_value";s:2:"19";s:19:"accounting_tax_name";s:18:"Mehrwertsteuer 19%";s:19:"accounting_tax_abbr";s:9:"19% MwSt.";}i:1;a:3:{s:20:"accounting_tax_value";s:1:"7";s:19:"accounting_tax_name";s:17:"Mehrwertsteuer 7%";s:19:"accounting_tax_abbr";s:8:"7% MwSt.";}}',
			'eval' 			          => array
			(
				'minCount'                => 1,
				'columnFields'            => array
				(
					'accounting_tax_value' => array
					(
						'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_units']['accounting_tax_value'],
						'inputType'               => 'text',
						'eval'                    => array('mandatory'=>true, 'rgxp'=>'prcnt', 'style'=>'width:180px')
					),
					'accounting_tax_name' => array
					(
						'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_units']['accounting_tax_name'],
						'inputType'               => 'text',
						'eval'                    => array('mandatory'=>true, 'rgxp'=>'extnd', 'style'=>'width:180px')
					),
					'accounting_tax_abbr' => array
					(
						'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_units']['accounting_tax_abbr'],
						'inputType'               => 'text',
						'eval'                    => array('mandatory'=>true, 'rgxp'=>'extnd', 'style'=>'width:180px')
					)
				)
			)
		),
		'accounting_units' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_units']['accounting_units'],
			'inputType'               => 'listWizard',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'alnum', 'nospace'=>true, 'tl_class'=>'long')
		),
		'accounting_categories' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_units']['accounting_categories'],
			'inputType'               => 'listWizard',
			'eval'                    => array('tl_class'=>'long')
		)
	)
);
