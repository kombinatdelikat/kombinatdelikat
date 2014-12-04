<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Quotations
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
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
