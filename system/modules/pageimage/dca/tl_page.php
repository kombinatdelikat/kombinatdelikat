<?php

/**
 * pageimage Extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2009-2014, terminal42 gmbh
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/terminal42/contao-pageimage
 */


/**
 * Palettes
 */
foreach ($GLOBALS['TL_DCA']['tl_page']['palettes'] as $name => $palette)
{
    if ($name == '__selector__') {
        continue;
    }

    $GLOBALS['TL_DCA']['tl_page']['palettes'][$name] = str_replace('{meta_legend}', '{image_legend:hide},pageImage,pageImageJumpTo,pageImageAlt,pageImageTitle;{meta_legend}', $palette);
    $GLOBALS['TL_DCA']['tl_page']['fields']['type']['eval']['gallery_types'][] = $name;
}


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['pageImage'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['pageImage'],
    'inputType'     => 'fileTree',
    'exclude'       => true,
    'eval'          => array('fieldType'=>'checkbox', 'orderField'=>'pageImageOrder', 'multiple'=>true, 'files'=>true, 'filesOnly'=>true, 'extensions'=>'jpg,jpeg,gif,png', 'isGallery'=>true),
    'sql'           => "blob NULL",
);

// field is used to store the order of the list of images in pageImage
$GLOBALS['TL_DCA']['tl_page']['fields']['pageImageOrder'] = array
(
    'eval'          => array('doNotShow'=>true),
    'sql'           => "blob NULL",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['pageImageJumpTo'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['pageImageJumpTo'],
    'exclude'       => true,
    'inputType'     => 'pageTree',
    'foreignKey'    => 'tl_page.title',
    'eval'          => array('fieldType'=>'radio'),
    'sql'           => "int(10) unsigned NOT NULL default '0'",
    'relation'      => array('type'=>'hasOne', 'load'=>'lazy'),
);

$GLOBALS['TL_DCA']['tl_page']['fields']['pageImageAlt'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['pageImageAlt'],
    'inputType'     => 'text',
    'exclude'       => true,
    'eval'          => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'           => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['pageImageTitle'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['pageImageTitle'],
    'inputType'     => 'text',
    'exclude'       => true,
    'eval'          => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'           => "varchar(255) NOT NULL default ''",
);
