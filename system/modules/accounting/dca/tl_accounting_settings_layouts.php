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
 * Table tl_accounting_settings_layouts
 */
$GLOBALS['TL_DCA']['tl_accounting_settings_layouts'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
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
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Select
	'select' => array
	(
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
		'default'                     => '{title_legend},title,fields;
										  {layout_legend},tpl_pdf,css,format,orientation,margin;
										  {font_legend},fontfamily,fontsize;
										  {output_legend},path'
	),

	// Subpalettes
	'subpalettes' => array
	(),

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
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'path' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['path'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('files'=>false, 'fieldType'=>'radio', 'tl_class'=>'clr w50'),
			'sql'                     => "binary(16) NULL"
		),
		'tpl_pdf' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['tpl_pdf'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'extensions'=>'pdf', 'tl_class'=>'clr w50'),
			'sql'                     => "binary(16) NULL"
		),
		'css' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['css'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'extensions'=>'css', 'tl_class'=>'clr w50'),
			'sql'                     => "binary(16) NULL"
		),
		'fields' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fields'],
			'options'                 => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fields_types'],
			'exclude'                 => true,
			'inputType'               => 'checkboxWizard',
			'default'                 => 'a:6:{i:0;s:8:"position";i:1;s:11:"description";i:2;s:8:"quantity";i:3;s:14:"price_subtotal";i:4;s:9:"price_tax";i:5;s:11:"price_total";}',
			'eval' 			          => array('mandatory'=>true, 'tl_class'=>'clr w50', 'multiple'=>true),
			'sql'                     => "blob NULL"
		),
		'format' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['format'],
			'exclude'                 => true,
			'options'                 => array('A4'),
			'inputType'               => 'select',
			'eval'                    => array('tl_class'=>'clr w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'fontfamily' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fontfamily'],
			'exclude'                 => true,
			'default'                 => 'opensanscondensed',
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'clr w50', 'rgxp'=>'alnum'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'fontsize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fontsize'],
			'exclude'                 => true,
			'default'                 => 12,
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'clr w50', 'rgxp'=>'digit'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'margin' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['margin'],
			'exclude'                 => true,
			'default'                 => 'a:4:{i:0;s:2:"25";i:1;s:2:"20";i:2;s:2:"25";i:3;s:2:"20";}',
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'clr w50', 'rgxp'=>'digit', 'multiple'=>true, 'size'=>4),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'orientation' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['orientation'],
			'options'                 => &$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['orientations'],
			'exclude'                 => true,
			'default'                 => 'P',
			'inputType'               => 'select',
			'eval'                    => array('tl_class'=>'clr w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		)
	)
);
