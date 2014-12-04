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


/**
 * Dynamically add the permission check and parent table
 */
if (Input::get('do') == 'kd_correspondence')
{
	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_kd_correspondence';
}

$GLOBALS['TL_DCA']['tl_content']['palettes']['kd_pdf_pb'] = '{type_legend},type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';