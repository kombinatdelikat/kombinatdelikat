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
 * Table tl_accounting_settings_defaults
 */
$GLOBALS['TL_DCA']['tl_accounting_settings_defaults'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'File',
		'closed'                      => true
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(),
		'default'                     => '{layout_legend},layout_bills,layout_offers,layout_correspondence'
	),

	// Subpalettes
	'subpalettes' => array
	(),

	// Fields
	'fields' => array
	(
		'layout_bills' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_defaults']['layout_bills'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_accounting_settings_layouts.title',
			'eval'                    => array('chosen'=>true, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'layout_offers' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_defaults']['layout_offers'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_accounting_settings_layouts.title',
			'eval'                    => array('chosen'=>true, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'layout_correspondence' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_defaults']['layout_correspondence'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_accounting_settings_layouts.title',
			'eval'                    => array('chosen'=>true, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);
