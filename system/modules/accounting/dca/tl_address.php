<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Core
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_address
 */
$GLOBALS['TL_DCA']['tl_address']['palettes']['default'] = str_replace(';{additional_legend}', ',comment;{additional_legend}', $GLOBALS['TL_DCA']['tl_address']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_address']['palettes']['default'] = str_replace(',company,', ',company,tax_number,', $GLOBALS['TL_DCA']['tl_address']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_address']['fields']['pid']['foreignKey'] = 'tl_member.id';
$GLOBALS['TL_DCA']['tl_address']['fields']['pid']['relation'] = array('type'=>'hasOne', 'load'=>'lazy');
$GLOBALS['TL_DCA']['tl_address']['fields']['tax_number'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['tax_number'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_address']['fields']['comment'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['comment'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'textarea',
	'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'helpwizard'=>true, 'tl_class'=>'clr'),
	'explanation'             => 'insertTags',
	'sql'                     => "mediumtext NULL"
);
