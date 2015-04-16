<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   KombinatDelikat
 * @author    David Enke <post@davidenke.de>
 * @license   EULA
 * @copyright David Enke 2014
 */


// Palettes
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace(',type;', ',type;{theme_legend},logo_color;', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);


// Fields
$GLOBALS['TL_DCA']['tl_page']['fields']['logo_color'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['logo_color'],
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>6, 'size'=>1, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'clr w50 wizard'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);
