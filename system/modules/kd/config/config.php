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
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD'], 0, array
(
	'kd' => array
	(
		'kd_stock' => array
		(
			'tables'		=> array('tl_kd_stock'),
			'icon'			=> 'system/modules/kd/assets/img/kd_stock.png'
		),
		'kd_products' => array
		(
			'tables'		=> array('tl_kd_products', 'tl_kd_product_charges'),
			'icon'			=> 'system/modules/kd/assets/img/kd_products.png'
		),
		'kd_formulas' => array
		(
			'tables'		=> array('tl_kd_formulas'),
			'icon'			=> 'system/modules/kd/assets/img/kd_formulas.png'
		),
/*
		'kd_contacts' => array(
			'tables'		=> array('tl_member'),
			'icon'			=> 'system/modules/kd/assets/img/kd_contacts.png'
		),
		'kd_bills' => array(
			'tables'		=> array('tl_kd_bills'),
			'icon'			=> 'system/modules/kd/assets/img/kd_bills.png'
		),
		'kd_offers' => array(
			'tables'		=> array('tl_kd_offers'),
			'icon'			=> 'system/modules/kd/assets/img/kd_offers.png'
		),
		'kd_correspondence' => array(
			'tables'		=> array('tl_kd_correspondence', 'tl_content'),
			'icon'			=> 'system/modules/kd/assets/img/kd_correspondence.png'
		),
*/
		'kd_labels' => array
		(
			'tables'		=> array('tl_kd_labels'),
			'icon'			=> 'system/modules/kd/assets/img/kd_labels.png'
		)
	)
));


/**
 * Content elements
 */


/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD']['miscellaneous'], 99, array
(
	'facebook_page'			=> 'KombinatDelikat\Modules\ModuleFacebookPage'
));


/**
 * Hooks
 */
//$GLOBALS['TL_HOOKS']['getContentElement'][] = array('KombinatDelikat\Classes\Helper', 'wrapHeadlines');
$GLOBALS['TL_HOOKS']['parseBackendTemplate'][] = array('KombinatDelikat\Classes\Helper', 'addLabelAssets');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('KombinatDelikat\Classes\Helper', 'addInsertTags');

if (!\Input::get('do'))
{
	//$GLOBALS['TL_HOOKS']['getSystemMessages'][] = array('\KombinatDelikat\Classes\Helper', 'showStockMessage');
}
