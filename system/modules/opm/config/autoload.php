<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Opm
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
	'develab\opm\Models\Correspondence' => 'system/modules/opm/models/Correspondence.php',
	'develab\opm\Models\Offers'         => 'system/modules/opm/models/Offers.php',
	'develab\opm\Models\Bills'          => 'system/modules/opm/models/Bills.php',

	// Classes
	'develab\opm\Helper'                => 'system/modules/opm/classes/Helper.php',

	// Elements
	'develab\opm\Elements\ContentPdfPb' => 'system/modules/opm/elements/ContentPdfPb.php',

	// Modules
	'develab\opm\ModuleOverview'        => 'system/modules/opm/modules/ModuleOverview.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_pdf_pb'       => 'system/modules/opm/templates/elements',
	'be_opm_overview' => 'system/modules/opm/templates/backend',
	'pdf_opm_bills'   => 'system/modules/opm/templates/pdf',
));
