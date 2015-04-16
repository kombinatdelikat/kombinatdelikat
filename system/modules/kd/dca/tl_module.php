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


$GLOBALS['TL_DCA']['tl_module']['palettes']['facebook_page'] = '{title_legend},name,type;{fb_legend},fb_app_id,fb_app_secret,fb_page_id;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['fields']['fb_cache'] = array
(
	'sql'                     => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['fb_app_id'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fb_app_id'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'clr w50', 'minlength'=>15, 'maxlength'=>15),
	'sql'                     => "varchar(15) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['fb_app_secret'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fb_app_secret'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'alnum', 'tl_class'=>'w50', 'minlength'=>32, 'maxlength'=>32),
	'sql'                     => "varchar(32) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['fb_page_id'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fb_page_id'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'alnum', 'tl_class'=>'w50'),
	'sql'                     => "varchar(128) NOT NULL default ''"
);
