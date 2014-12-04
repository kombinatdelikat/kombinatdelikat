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
 * Table tl_kd_products
 */
$GLOBALS['TL_DCA']['tl_kd_products'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_kd_product_charges'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'onload_callback'             => array
		(
			array('KdHelper', 'showStockMessage')
		),
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
			'disableGrouping'         => true
		),
		'label' => array
		(
			'fields'                  => array('title', 'tiers', 'price', 'gross'),
			'showColumns'             => true,
			'label_callback'          => array
			(
				'tl_kd_products', 'setLabel'
			)
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
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_products']['edit'],
				'href'                => 'table=tl_kd_product_charges',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_products']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_products']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_products']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_products']['show'],
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
		'__selector__'                => array('price_type'),
		'default'                     => '{title_legend},title;{price_legend},price_type;',
		'fix'                         => '{title_legend},title;{price_legend},price_type,price_fix;',
		'tiers_count'                 => '{title_legend},title;{price_legend},price_type,price_tiers;',
		'tiers_weight'                => '{title_legend},title;{price_legend},price_type,price_tiers;'
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
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_products']['title'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'tiers' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_products']['tiers']
		),
		'price' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_products']['price']
		),
		'gross' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_products']['gross']
		),
		'price_type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_products']['price_type'],
			'default'                 => 'fix',
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('fix', 'tiers_count', 'tiers_weight'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_kd_products']['price_types'],
			'eval'                    => array('helpwizard'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'price_fix' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_products']['price_fix'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'w50'),
			'save_callback'           => array(array('KdHelper', 'formatPrice')),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'price_tiers' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_products']['price_tiers'],
			'exclude'                 => true,
			'inputType'               => 'multiColumnWizard',
			//'load_callback'           => array(array('tl_kd_products', 'orderPriceTiers')),
			'save_callback'           => array(array('tl_kd_products', 'orderPriceTiers')),
			'eval'                    => array
			(
				'tl_class' => 'clr long',
				'buttons' => array('up' => false, 'down' => false),
				'columnFields' => array
				(
					'range_from' => array
					(
						'label'         => call_user_func(array('tl_kd_products', 'getRangeFromLabel')),
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>255, 'style'=>'width:250px')
					),
					'range_price' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_kd_products']['range_price'],
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>255, 'style'=>'width:250px')
					)
				)
			),
			'sql'                     => "blob NULL"
		)
	)
);

class tl_kd_products extends Backend
{
	static function getRangeFromLabel()
	{
		if (!\Input::get('id'))
		{
			return;
		}
		$objProduct = \KdProductsModel::findOneBy('id', \Input::get('id'));

		return $objProduct->price_type == 'tiers_count' ? $GLOBALS['TL_LANG']['tl_kd_products']['range_from_count'] : $GLOBALS['TL_LANG']['tl_kd_products']['range_from_weight'];
	}

	public function setLabel($arrRow, $strLabel, \DataContainer $dc, $args)
	{
		$objKdHelper = new \KdHelper();

		if ($arrRow['price_type'] == 'fix')
		{
			$args[1] = '<ul><li></li></ul>';
			$args[2] = '<ul><li>' . $objKdHelper->formatPrice($arrRow['price_fix']) . ' €</li></ul>';
			$args[3] = '<ul><li>' . $objKdHelper->formatPrice($arrRow['price_fix'] * 1.07) . ' €</li></ul>';
		}
		else
		{
			$arrPriceTiers = $objKdHelper->formatPriceTiers(deserialize($arrRow['price_tiers'], true), ' €', $arrRow['price_type']);
			$args[1] = $arrPriceTiers['tiers'];
			$args[2] = $arrPriceTiers['price'];
			$args[3] = $arrPriceTiers['gross'];
		}

		return $args;
	}

	protected function sortPriceTiers()
	{
		return function ($a, $b) {
			return $a['range_from'] - $b['range_from'];
		};
	}

	public function orderPriceTiers($varValue, \DataContainer $dc)
	{
		$arrValues = deserialize($varValue, true);

		if (!sizeof($arrValues))
		{
			return $arrValues;
		}

		$objKdHelper = new \KdHelper();
		foreach ($arrValues as $i=>$arrValue)
		{
			$arrValues[$i]['range_from'] = number_format($arrValue['range_from'], 0, '.', '');
			$arrValues[$i]['range_price'] = $objKdHelper->formatPrice($arrValue['range_price']);
		}

		usort($arrValues, $this->sortPriceTiers());

		return serialize($arrValues);
	}
}