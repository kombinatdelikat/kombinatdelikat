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
 * Table tl_kd_product_charges
 */
$GLOBALS['TL_DCA']['tl_kd_product_charges'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'ptable'                      => 'tl_kd_products',
		'onload_callback'             => array
		(
			array('KdHelper', 'showStockMessage')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
				'number' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('date DESC'),
			'headerFields'            => array('title'),
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_callback'   => array('tl_kd_product_charges', 'renderLabel')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_product_charges']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_product_charges']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_product_charges']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array()
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => '{settings_legend},number,date,quantity;{expiry_legend},expiry_fridge,expiry_frost'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_kd_products.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'number' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_product_charges']['number'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'save_callback' => array
			(
				array('tl_kd_product_charges', 'generateNumber')
			),
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'alnum', 'unique'=>true, 'doNotCopy'=>true, 'tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_product_charges']['date'],
			'inputType'               => 'text',
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'quantity' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_product_charges']['quantity'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'expiry_fridge' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_product_charges']['expiry_fridge'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'load_callback' => array
			(
				array('tl_kd_product_charges', 'generateExpiryFridgeDate')
			),
			'save_callback' => array
			(
				array('tl_kd_product_charges', 'generateExpiryFridgeDate')
			),
			'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'expiry_frost' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_product_charges']['expiry_frost'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'load_callback' => array
			(
				array('tl_kd_product_charges', 'generateExpiryFrostDate')
			),
			'save_callback' => array
			(
				array('tl_kd_product_charges', 'generateExpiryFrostDate')
			),
			'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);

class tl_kd_product_charges extends Backend
{
	public function renderLabel($arrRow)
	{
		return sprintf('%s <strong style="display:inline-block;width:70px;text-align:center">%s Stk.</strong> %s', $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'] ?: 'd.m.Y', $arrRow['date']), $arrRow['quantity'], $arrRow['number']);
	}

	public function generateNumber($varValue, DataContainer $dc)
	{
		$autoNumber = false;

/*
		// Generate charge number if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = standardize(String::restoreBasicEntities($dc->activeRecord->headline));
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_news WHERE alias=?")
								   ->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}
*/

		return $varValue;
	}

	public function generateExpiryFridgeDate($varValue, DataContainer $dc)
	{
		if ($varValue == '' || $varValue < $dc->activeRecord->date) {
			$varValue = $dc->activeRecord->date + 5 * 24 * 60 * 60;
		}
		return $varValue;
	}

	public function generateExpiryFrostDate($varValue, DataContainer $dc)
	{
		if ($varValue == '' || $varValue < $dc->activeRecord->date) {
			$varValue = $dc->activeRecord->date + 21 * 24 * 60 * 60;
		}
		return $varValue;
	}
}

