<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package accounting
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
	// Models
	'develab\accounting\Models\Correspondence' => 'system/modules/accounting/models/Correspondence.php',
	'develab\accounting\Models\Offers'         => 'system/modules/accounting/models/Offers.php',
	'develab\accounting\Models\Bills'          => 'system/modules/accounting/models/Bills.php',

	// Classes
	'develab\accounting\Helper'                => 'system/modules/accounting/classes/Helper.php',

	// Elements
	'develab\accounting\Elements\ContentPdfPb' => 'system/modules/accounting/elements/ContentPdfPb.php',

	// Modules
	'develab\accounting\ModuleOverview'        => 'system/modules/accounting/modules/ModuleOverview.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_pdf_pb'       => 'system/modules/accounting/templates/elements',
	'be_accounting_overview' => 'system/modules/accounting/templates/backend',
	'pdf_accounting_bills'   => 'system/modules/accounting/templates/pdf',
));
