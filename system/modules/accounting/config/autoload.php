<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'develab',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'develab\accounting\Helper'                                  => 'system/modules/accounting/classes/Helper.php',

	// Elements
	'develab\accounting\Elements\ContentAccounting'              => 'system/modules/accounting/elements/ContentAccounting.php',
	'develab\accounting\Elements\ContentAccountingItem'          => 'system/modules/accounting/elements/ContentAccountingItem.php',
	'develab\accounting\Elements\ContentAccountingOverview'      => 'system/modules/accounting/elements/ContentAccountingOverview.php',
	'develab\accounting\Elements\ContentAccountingScopesubtotal' => 'system/modules/accounting/elements/ContentAccountingScopesubtotal.php',
	'develab\accounting\Elements\ContentAccountingScopetotal'    => 'system/modules/accounting/elements/ContentAccountingScopetotal.php',
	'develab\accounting\Elements\ContentAccountingStart'         => 'system/modules/accounting/elements/ContentAccountingStart.php',
	'develab\accounting\Elements\ContentAccountingStop'          => 'system/modules/accounting/elements/ContentAccountingStop.php',
	'develab\accounting\Elements\ContentAccountingSubtotal'      => 'system/modules/accounting/elements/ContentAccountingSubtotal.php',
	'develab\accounting\Elements\ContentAccountingTotal'         => 'system/modules/accounting/elements/ContentAccountingTotal.php',
	'develab\accounting\Elements\ContentPdfPb'                   => 'system/modules/accounting/elements/ContentPdfPb.php',

	// Models
	'develab\accounting\Models\AccountingModel'                  => 'system/modules/accounting/models/AccountingModel.php',
	'develab\accounting\Models\BillsModel'                       => 'system/modules/accounting/models/BillsModel.php',
	'develab\accounting\Models\CorrespondenceModel'              => 'system/modules/accounting/models/CorrespondenceModel.php',
	'develab\accounting\Models\LayoutsModel'                     => 'system/modules/accounting/models/LayoutsModel.php',
	'develab\accounting\Models\OffersModel'                      => 'system/modules/accounting/models/OffersModel.php',

	// Modules
	'develab\accounting\Modules\BackendOverview'                 => 'system/modules/accounting/modules/BackendOverview.php',
	'develab\accounting\Modules\BackendSettings'                 => 'system/modules/accounting/modules/BackendSettings.php',
	'develab\accounting\Modules\ModuleAccounting'                => 'system/modules/accounting/modules/ModuleAccounting.php',
	'develab\accounting\Modules\ModuleBills'                     => 'system/modules/accounting/modules/ModuleBills.php',
	'develab\accounting\Modules\ModuleCorrespondence'            => 'system/modules/accounting/modules/ModuleCorrespondence.php',
	'develab\accounting\Modules\ModuleOffers'                    => 'system/modules/accounting/modules/ModuleOffers.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_accounting_settings'        => 'system/modules/accounting/templates/backend',
	'ce_accounting_item'            => 'system/modules/accounting/templates/elements',
	'ce_accounting_overview'        => 'system/modules/accounting/templates/elements',
	'ce_accounting_scopesubtotal'   => 'system/modules/accounting/templates/elements',
	'ce_accounting_scopetotal'      => 'system/modules/accounting/templates/elements',
	'ce_accounting_start'           => 'system/modules/accounting/templates/elements',
	'ce_accounting_stop'            => 'system/modules/accounting/templates/elements',
	'ce_accounting_subtotal'        => 'system/modules/accounting/templates/elements',
	'ce_accounting_total'           => 'system/modules/accounting/templates/elements',
	'ce_pdf_pb'                     => 'system/modules/accounting/templates/elements',
	'pdf_accounting_bills'          => 'system/modules/accounting/templates/pdf',
	'pdf_accounting_correspondence' => 'system/modules/accounting/templates/pdf',
	'pdf_accounting_offers'         => 'system/modules/accounting/templates/pdf',
));
