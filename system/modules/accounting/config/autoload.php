<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Accounting
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
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
	'develab\accounting\Helper'                   => 'system/modules/accounting/classes/Helper.php',

	// Elements
	'develab\accounting\Elements\ContentElement'  => 'system/modules/accounting/elements/ContentElement.php',
	'develab\accounting\Elements\ContentItem'     => 'system/modules/accounting/elements/ContentItem.php',
	'develab\accounting\Elements\ContentPdfPb'    => 'system/modules/accounting/elements/ContentPdfPb.php',
	'develab\accounting\Elements\ContentSubtotal' => 'system/modules/accounting/elements/ContentSubtotal.php',
	'develab\accounting\Elements\ContentTotal'    => 'system/modules/accounting/elements/ContentTotal.php',

	// Models
	'develab\accounting\Models\Bills'             => 'system/modules/accounting/models/Bills.php',
	'develab\accounting\Models\Correspondence'    => 'system/modules/accounting/models/Correspondence.php',
	'develab\accounting\Models\Offers'            => 'system/modules/accounting/models/Offers.php',

	// Modules
	'develab\accounting\Modules\ModulePDF'        => 'system/modules/accounting/modules/ModulePDF.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_accounting_overview'        => 'system/modules/accounting/templates/backend',
	'ce_accounting_item'            => 'system/modules/accounting/templates/elements',
	'ce_accounting_subtotal'        => 'system/modules/accounting/templates/elements',
	'ce_accounting_total'           => 'system/modules/accounting/templates/elements',
	'ce_pdf_pb'                     => 'system/modules/accounting/templates/elements',
	'pdf_accounting_bills'          => 'system/modules/accounting/templates/pdf',
	'pdf_accounting_correspondence' => 'system/modules/accounting/templates/pdf',
));
