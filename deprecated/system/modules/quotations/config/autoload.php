<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'Contao\ContentQuotations' => 'system/modules/quotations/elements/ContentQuotations.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_quotations' => 'system/modules/quotations/templates',
));
