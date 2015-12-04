<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @copyright  David Enke 2013-2015
 * @author     David Enke (davidenke@develab.de) 
 * @package    lessgrid 
 * @license    LGPL
 */


/**
 * Table tl_layout
 */
$GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] = str_replace('sPosition;', 'sPosition;{grid_legend},gridCols,gridPadding;', $GLOBALS['TL_DCA']['tl_layout']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_layout']['fields']['gridCols'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['gridCols'],
	'exclude'                 => true,
	'default'                 => 12,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit', 'min'=>2),
	'sql'                     => "int(10) NOT NULL default '12'"
);
$GLOBALS['TL_DCA']['tl_layout']['fields']['gridPadding'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['gridPadding'],
	'exclude'                 => true,
	'default'                 => 10,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit'),
	'sql'                     => "int(10) NOT NULL default '10'"
);
