<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Faq
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_quotations
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['quotations'] = '{type_legend},type,headline;{list_legend},quotations;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['quotations'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['quotations'],
	'exclude' 		          => true,
	'inputType'               => 'multiColumnWizard',
	'eval'                    => array(  
		'columnFields'             => array(
			'ts_quote'		          => array(
				'label'                   => &$GLOBALS['TL_LANG']['tl_content']['ts_quote'],
				'inputType'               => 'text',
				'eval'                    => array('mandatory'=>true, 'style'=>'width:450px')
			),
			'ts_author'             => array(
				'label'                   => &$GLOBALS['TL_LANG']['tl_content']['ts_author'],
				'inputType'               => 'text',
				'eval'                    => array('mandatory'=>true, 'style'=>'width:150px')
			)
		)
	),
	'sql'                     => "blob NULL"
);