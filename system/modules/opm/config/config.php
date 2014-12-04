<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   OPM
 * @author    David Enke <post@davidenke.de>
 * @license   EULA
 * @copyright David Enke 2014
 */

// !Backend modules
array_insert($GLOBALS['BE_MOD'], 0, array(
	'opm' => array(
/*
		'opm_overview' => array(
			'callback'      => '\develab\opm\ModuleOverview',
			'icon'			=> 'system/modules/opm/assets/img/opm.gif',
			'stylesheet'	=> array(
				'system/modules/opm/assets/css/be_opm.css',
			),
			'javascript'	=> array(
				'system/modules/opm/assets/plugins/mootabs-0.1.0/mootabs-0.1.0-nc.js',
				'system/modules/opm/assets/js/be_opm.js'
			)
		),
*/
		'opm_contacts' => array(
			'tables'		=> array('tl_member'),
			'icon'			=> 'system/modules/opm/assets/img/opm_contacts.png'
		),
		'opm_contact_groups' => array(
			'tables'		=> array('tl_member_group'),
			'icon'			=> 'system/modules/opm/assets/img/opm_contact_groups.png'
		),
		'opm_bills' => array(
			'tables'		=> array('tl_opm_bills', 'tl_content'),
			'icon'			=> 'system/modules/opm/assets/img/opm_bills.png'
		),
		'opm_offers' => array(
			'tables'		=> array('tl_opm_offers', 'tl_content'),
			'icon'			=> 'system/modules/opm/assets/img/opm_offers.png'
		),
		'opm_correspondence' => array(
			'tables'		=> array('tl_opm_correspondence', 'tl_content'),
			'icon'			=> 'system/modules/opm/assets/img/opm_correspondence.png'
		),
		'opm_settings' => array(
			'tables'		=> array('tl_opm_settings'),
			'icon'			=> 'system/modules/opm/assets/img/opm_settings.png'
		)
	)
));

// !Content elements
$GLOBALS['TL_CTE_BILLS'] = array(
	'accounting' => array(
		'opm_item' => '\develab\opm\Elements\ContentItem',
		'opm_subtotal' => '\develab\opm\Elements\ContentSubtotal',
		'opm_total' => '\develab\opm\Elements\ContentTotal'
	),
	'layout' => array(
		'opm_pdf_pb' => '\develab\opm\Elements\ContentPdfPb'
	)
);

// !Models
$GLOBALS['TL_MODELS']['tl_opm_bills'] = 'develab\opm\Models\Bills';
$GLOBALS['TL_MODELS']['tl_opm_correspondence'] = 'develab\opm\Models\Correspondence';
$GLOBALS['TL_MODELS']['tl_opm_offers'] = 'develab\opm\Models\Offers';

// !Hook's
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('\develab\opm\Helper', 'replaceOpmInsertTags');
