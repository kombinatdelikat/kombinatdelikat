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
 * Table tl_member
 */

unset($GLOBALS['TL_DCA']['tl_member']['list']['operations']['su']);
$GLOBALS['TL_DCA']['tl_member']['list']['label']['fields'] = array('icon', 'firstname', 'lastname', 'groups', 'company');
$GLOBALS['TL_DCA']['tl_member']['list']['label']['label_callback'] = array('accounting_member', 'renderLabel');

$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace(';{groups_legend}', ',comment;{groups_legend}', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace(',company,', ',company,tax_number,', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_member']['fields']['tax_number'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['tax_number'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'address', 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['email']['eval']['unique'] = false;
$GLOBALS['TL_DCA']['tl_member']['fields']['email']['eval']['mandatory'] = false;
$GLOBALS['TL_DCA']['tl_member']['fields']['comment'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['comment'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'textarea',
	'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'helpwizard'=>true, 'tl_class'=>'clr', 'feEditable'=>false, 'feViewable'=>false),
	'explanation'             => 'insertTags',
	'sql'                     => "mediumtext NULL"
);

class accounting_member extends tl_member {
	public function addIcon($row, $label, DataContainer $dc, $args) {
		$image = 'member';
		$arrGroupIds = deserialize($row['groups'], true);

		if (sizeof($arrGroupIds) && in_array(1, $arrGroupIds)) {
			$image = 'admin';
		}

		if ($row['disable'] || strlen($row['start']) && $row['start'] > time() || strlen($row['stop']) && $row['stop'] < time()) {
			$image .= '_';
		}

		$args[0] = sprintf('<div class="list_icon_new" style="background-image:url(\'%ssystem/themes/%s/images/%s.gif\')">&nbsp;</div>', TL_ASSETS_URL, Backend::getTheme(), $image);
		return $args;
	}

	public function renderLabel($row, $label, DataContainer $dc, $args) {
		$args = $this->addIcon($row, $label, $dc, $args);
		$arrGroups = array();
		$arrGroupIds = deserialize($row['groups'], true);

		if (!sizeof($arrGroupIds)) {
			return $args;
		}

		$objGroups = \MemberGroupModel::findMultipleByIds($arrGroupIds);

		if (is_null($objGroups)) {
			return $args;
		}

		while ($objGroups->next()) {
			$arrGroups[] = $objGroups->name;
		}

		$args[3] = implode(', ', $arrGroups);

		return $args;
	}
}
