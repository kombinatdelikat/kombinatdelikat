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
 * Table tl_accounting_settings_format
 */
$GLOBALS['TL_DCA']['tl_accounting_settings_format'] = array
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
		'default'                     => '{no_legend},no_bills_current,no_offers_current,no_customers_current;
										  {pattern_legend:hide},no_bills_pattern,no_offers_pattern,no_customers_pattern,no_customers_groups;
										  {due_legend},due_bills,due_offers'
	),

	// Subpalettes
	'subpalettes' => array
	(),

	// Fields
	'fields' => array
	(
		'no_bills_current' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['no_bills_current'],
			'inputType'               => 'text',
			'default'                 => 1,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'clr w50')
		),
		'no_offers_current' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['no_offers_current'],
			'inputType'               => 'text',
			'default'                 => 1,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50')
		),
		'no_customers_current' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['no_customers_current'],
			'inputType'               => 'text',
			'default'                 => 1,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50')
		),
		'no_bills_pattern' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['no_bills_pattern'],
			'inputType'               => 'text',
			'default'                 => '{{date::Ym}}R{{accounting::no_bills_current::4}}',
			'eval'                    => array('mandatory'=>true, 'nospace'=>true, 'tl_class'=>'clr w50')
		),
		'no_offers_pattern' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['no_offers_pattern'],
			'inputType'               => 'text',
			'default'                 => '{{date::Ym}}A{{accounting::no_offers_current::4}}',
			'eval'                    => array('mandatory'=>true, 'nospace'=>true, 'tl_class'=>'w50')
		),
		'no_customers_pattern' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['no_customers_pattern'],
			'inputType'               => 'text',
			'default'                 => '{{date::Ym}}K{{accounting::no_customers_current::4}}',
			'eval'                    => array('mandatory'=>true, 'nospace'=>true, 'tl_class'=>'w50')
		),
		'no_customers_groups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['no_customers_groups'],
			'inputType'               => 'checkboxWizard',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => array('mandatory'=>true, 'multiple'=>true, 'tl_class'=>'clr w50')
		),
		'due_bills' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['due_bills'],
			'inputType'               => 'text',
			'default'                 => 7,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'clr w50')
		),
		'due_offers' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_format']['due_offers'],
			'inputType'               => 'text',
			'default'                 => 30,
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50')
		)
	)
);
