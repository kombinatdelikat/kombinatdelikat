<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Kd
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'Contao\ContentKdPdfPb'        => 'system/modules/kd/elements/ContentKdPdfPb.php',

	// Classes
	'Contao\KdHelper'              => 'system/modules/kd/classes/KdHelper.php',

	// Plugins
	'meter'                        => 'system/modules/kd/plugins/mpdf-5.7.3/classes/meter.php',
	'grad'                         => 'system/modules/kd/plugins/mpdf-5.7.3/classes/grad.php',
	'directw'                      => 'system/modules/kd/plugins/mpdf-5.7.3/classes/directw.php',
	'bmp'                          => 'system/modules/kd/plugins/mpdf-5.7.3/classes/bmp.php',
	'cssmgr'                       => 'system/modules/kd/plugins/mpdf-5.7.3/classes/cssmgr.php',
	'wmf'                          => 'system/modules/kd/plugins/mpdf-5.7.3/classes/wmf.php',
	'indic'                        => 'system/modules/kd/plugins/mpdf-5.7.3/classes/indic.php',
	'tocontents'                   => 'system/modules/kd/plugins/mpdf-5.7.3/classes/tocontents.php',
	'form'                         => 'system/modules/kd/plugins/mpdf-5.7.3/classes/form.php',
	'fpdi_pdf_parser'              => 'system/modules/kd/plugins/mpdf-5.7.3/mpdfi/fpdi_pdf_parser.php',
	'pdf_context'                  => 'system/modules/kd/plugins/mpdf-5.7.3/mpdfi/pdf_context.php',
	'FilterLZW'                    => 'system/modules/kd/plugins/mpdf-5.7.3/mpdfi/filters/FilterLZW.php',
	'FilterASCII85'                => 'system/modules/kd/plugins/mpdf-5.7.3/mpdfi/filters/FilterASCII85.php',
	'pdf_parser'                   => 'system/modules/kd/plugins/mpdf-5.7.3/mpdfi/pdf_parser.php',

	// Models
	'Contao\KdProductsModel'       => 'system/modules/kd/models/KdProductsModel.php',
	'Contao\KdFormulasModel'       => 'system/modules/kd/models/KdFormulasModel.php',
	'Contao\KdLabelsModel'         => 'system/modules/kd/models/KdLabelsModel.php',
	'Contao\KdStockModel'          => 'system/modules/kd/models/KdStockModel.php',
	'Contao\KdProductChargesModel' => 'system/modules/kd/models/KdProductChargesModel.php',
	'Contao\KdCorrespondenceModel' => 'system/modules/kd/models/KdCorrespondenceModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_kd_pdf_pb'       => 'system/modules/kd/templates/elements',
	'pdf_correspondence' => 'system/modules/kd/templates/pdf',
	'pdf_labels'         => 'system/modules/kd/templates/pdf',
));
