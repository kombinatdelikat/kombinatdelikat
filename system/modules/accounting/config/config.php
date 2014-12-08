<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   accounting
 * @author    David Enke <post@davidenke.de>
 * @license   EULA
 * @copyright David Enke 2014
 */

// !Backend modules
array_insert($GLOBALS['BE_MOD'], 0, array(
	'accounting' => array(
/*
		'accounting_overview' => array(
			'callback'      => '\develab\accounting\ModuleOverview',
			'icon'			=> 'system/modules/accounting/assets/img/accounting.gif',
			'stylesheet'	=> array(
				'system/modules/accounting/assets/css/be_accounting.css',
			),
			'javascript'	=> array(
				'system/modules/accounting/assets/plugins/mootabs-0.1.0/mootabs-0.1.0-nc.js',
				'system/modules/accounting/assets/js/be_accounting.js'
			)
		),
*/
		'accounting_contacts' => array(
			'tables'		=> array('tl_member'),
			'icon'			=> 'system/modules/accounting/assets/img/accounting_contacts.png'
		),
		'accounting_contact_groups' => array(
			'tables'		=> array('tl_member_group'),
			'icon'			=> 'system/modules/accounting/assets/img/accounting_contact_groups.png'
		),
		'accounting_bills' => array(
			'tables'		=> array('tl_accounting_bills', 'tl_content'),
			'icon'			=> 'system/modules/accounting/assets/img/accounting_bills.png',
			'javascript'	=> 'system/modules/accounting/assets/js/accounting.js'
		),
		'accounting_offers' => array(
			'tables'		=> array('tl_accounting_offers', 'tl_content'),
			'icon'			=> 'system/modules/accounting/assets/img/accounting_offers.png'
		),
		'accounting_correspondence' => array(
			'tables'		=> array('tl_accounting_correspondence', 'tl_content'),
			'icon'			=> 'system/modules/accounting/assets/img/accounting_correspondence.png'
		),
		'accounting_settings' => array(
			'tables'		=> array('tl_accounting_settings'),
			'icon'			=> 'system/modules/accounting/assets/img/accounting_settings.png'
		)
	)
));

// !Content elements
$GLOBALS['TL_CTE_CORRESPONDENCE'] = $GLOBALS['TL_CTE'];
$GLOBALS['TL_CTE_BILLS'] = array(
	'texts' => array(
		'headline' => $GLOBALS['TL_CTE']['texts']['headline'],
		'text' => $GLOBALS['TL_CTE']['texts']['text'],
		'list' => $GLOBALS['TL_CTE']['texts']['list'],
		'table' => $GLOBALS['TL_CTE']['texts']['table']
	),
	'accounting' => array(
		'accounting_item' => 'develab\accounting\Elements\ContentItem',
		'accounting_subtotal' => 'develab\accounting\Elements\ContentSubtotal',
		'accounting_total' => 'develab\accounting\Elements\ContentTotal'
	),
	'layout' => array(
		'accounting_pdf_pb' => 'develab\accounting\Elements\ContentPdfPb'
	)
);
$GLOBALS['TL_CTE_OFFERS'] = array();

// !Models
$GLOBALS['TL_MODELS']['tl_accounting_bills'] = 'develab\accounting\Models\Bills';
$GLOBALS['TL_MODELS']['tl_accounting_correspondence'] = 'develab\accounting\Models\Correspondence';
$GLOBALS['TL_MODELS']['tl_accounting_offers'] = 'develab\accounting\Models\Offers';

// !Hook's
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('\develab\accounting\Helper', 'replaceAccountingInsertTags');
$GLOBALS['TL_HOOKS']['executePostActions'][] = array('\develab\accounting\Helper', 'updateContentElement');
