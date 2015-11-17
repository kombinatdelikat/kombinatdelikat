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
		'accounting_contacts' => array(
			'tables'		=> array('tl_member', 'tl_address'),
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
			'icon'			=> 'system/modules/accounting/assets/img/accounting_offers.png',
			'javascript'	=> 'system/modules/accounting/assets/js/accounting.js'
		),
		'accounting_correspondence' => array(
			'tables'		=> array('tl_accounting_correspondence', 'tl_content'),
			'icon'			=> 'system/modules/accounting/assets/img/accounting_correspondence.png'
		),
		'accounting_settings' => array(
			'callback'		=> 'develab\accounting\Modules\BackendSettings',
			'tables'		=> array('tl_accounting_settings_format', 'tl_accounting_settings_units', 'tl_accounting_settings_layouts', 'tl_accounting_settings_defaults'),
			'icon'			=> 'system/modules/accounting/assets/img/accounting_settings.png',
			'modules'		=> array(
				'accounting_settings_general' => array(
					'accounting_settings_format' => array(
						'tables'		=> array('tl_accounting_settings_format'),
						'icon'			=> 'system/modules/accounting/assets/img/accounting_settings.png'
					),
					'accounting_settings_units' => array(
						'tables'		=> array('tl_accounting_settings_units'),
						'icon'			=> 'system/modules/accounting/assets/img/accounting_settings.png'
					),
					'accounting_settings_layouts' => array(
						'tables'		=> array('tl_accounting_settings_layouts'),
						'icon'			=> 'system/modules/accounting/assets/img/accounting_settings.png'
					),
					'accounting_settings_defaults' => array(
						'tables'		=> array('tl_accounting_settings_defaults'),
						'icon'			=> 'system/modules/accounting/assets/img/accounting_settings.png'
					)
				)
			)
		)
	)
));

if (TL_MODE == 'BE')
{
    $GLOBALS['TL_CSS'][] = 'system/modules/accounting/assets/css/backend.css';
}

// !Content elements
$GLOBALS['TL_CTE_CORRESPONDENCE'] = array(
	'texts' => array(
		'headline' => $GLOBALS['TL_CTE']['texts']['headline'],
		'text' => $GLOBALS['TL_CTE']['texts']['text'],
		'list' => $GLOBALS['TL_CTE']['texts']['list'],
		'table' => $GLOBALS['TL_CTE']['texts']['table']
	),
	'layout' => array(
		'accounting_pdf_pb' => 'develab\accounting\Elements\ContentPdfPb'
	)
);
$GLOBALS['TL_CTE_BILLS'] = array(
	'texts' => array(
		'accounting_overview' => 'develab\accounting\Elements\ContentAccountingOverview',
		'headline' => $GLOBALS['TL_CTE']['texts']['headline'],
		'text' => $GLOBALS['TL_CTE']['texts']['text'],
		'list' => $GLOBALS['TL_CTE']['texts']['list'],
		'table' => $GLOBALS['TL_CTE']['texts']['table']
	),
	'accounting' => array(
		'accounting_item' => 'develab\accounting\Elements\ContentAccountingItem',
		'accounting_scopesubtotal' => 'develab\accounting\Elements\ContentAccountingScopesubtotal',
		'accounting_scopetotal' => 'develab\accounting\Elements\ContentAccountingScopetotal',
		'accounting_subtotal' => 'develab\accounting\Elements\ContentAccountingSubtotal',
		'accounting_total' => 'develab\accounting\Elements\ContentAccountingTotal'
	),
	'layout' => array(
		'accounting_pdf_pb' => 'develab\accounting\Elements\ContentPdfPb'
	)
);
$GLOBALS['TL_CTE_OFFERS'] = array(
	'texts' => array(
		'accounting_overview' => 'develab\accounting\Elements\ContentAccountingOverview',
		'headline' => $GLOBALS['TL_CTE']['texts']['headline'],
		'text' => $GLOBALS['TL_CTE']['texts']['text'],
		'list' => $GLOBALS['TL_CTE']['texts']['list'],
		'table' => $GLOBALS['TL_CTE']['texts']['table']
	),
	'accounting' => array(
		'accounting_item' => 'develab\accounting\Elements\ContentAccountingItem',
		'accounting_scopesubtotal' => 'develab\accounting\Elements\ContentAccountingScopesubtotal',
		'accounting_scopetotal' => 'develab\accounting\Elements\ContentAccountingScopetotal',
		'accounting_subtotal' => 'develab\accounting\Elements\ContentAccountingSubtotal',
		'accounting_total' => 'develab\accounting\Elements\ContentAccountingTotal'
	),
	'layout' => array(
		'accounting_pdf_pb' => 'develab\accounting\Elements\ContentPdfPb'
	)
);

// !Models
$GLOBALS['TL_MODELS']['tl_accounting_bills'] = 'develab\accounting\Models\BillsModel';
$GLOBALS['TL_MODELS']['tl_accounting_correspondence'] = 'develab\accounting\Models\CorrespondenceModel';
$GLOBALS['TL_MODELS']['tl_accounting_offers'] = 'develab\accounting\Models\OffersModel';
$GLOBALS['TL_MODELS']['tl_accounting_settings_layouts'] = 'develab\accounting\Models\LayoutsModel';

// !Hook's
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('\develab\accounting\Helper', 'replaceAccountingInsertTags');
$GLOBALS['TL_HOOKS']['executePostActions'][] = array('\develab\accounting\Helper', 'updateContentElement');
