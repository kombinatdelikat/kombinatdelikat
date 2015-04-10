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
$GLOBALS['TL_DCA']['tl_member']['config']['onload_callback'][] = array('tl_accounting_member', 'renderCustomerNo');
$GLOBALS['TL_DCA']['tl_member']['list']['label']['fields'] = array('icon', 'firstname', 'lastname', 'groups', 'no', 'company');
$GLOBALS['TL_DCA']['tl_member']['list']['label']['label_callback'] = array('tl_accounting_member', 'renderLabel');

//$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = '{personal_legend},firstname,lastname;{groups_legend},groups;{login_legend},login;{homedir_legend:hide},assignDir;{account_legend},disable,start,stop';
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace(',firstname,', ',no,firstname,', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_member']['fields']['email']['eval']['unique'] = false;
$GLOBALS['TL_DCA']['tl_member']['fields']['email']['eval']['mandatory'] = false;
$GLOBALS['TL_DCA']['tl_member']['fields']['firstname']['eval']['tl_class'] = 'clr w50';

$GLOBALS['TL_DCA']['tl_member']['fields']['no'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['no'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 12,
	'inputType'               => 'text',
	'save_callback'           => array(array('tl_accounting_member', 'setCustomerNo')),
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50', 'doNotCopy'=>true, 'doNotShow'=>true),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

class tl_accounting_member extends tl_member {
/*
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
*/

	public function renderCustomerNo(DataContainer $dc)
	{
		if ($dc->id)
		{
			$arrAllowedGroups = deserialize(\Config::get('no_customers_groups'), true);
			$objCustomer = \MemberModel::findOneBy('id', $dc->id);
			$arrGroups = deserialize($objCustomer->groups, true);

			if (sizeof(array_intersect($arrAllowedGroups, $arrGroups)))
			{
				$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('{personal_legend}', '{personal_legend},no', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);
			}
		}
	}

	public function setCustomerNo($varValue, DataContainer $dc)
	{
		if (strlen($varValue))
		{
			return $varValue;
		}

		$strNo = $this->replaceInsertTags(\Contao\Config::get('no_customers_pattern'), false);
		\Contao\Config::persist('no_customers_current', \Contao\Config::get('no_customers_current') + 1);

		return $strNo;
	}

	public function renderLabel($row, $label, DataContainer $dc, $args)
	{
		$args = $this->addIcon($row, $label, $dc, $args);
		$arrGroups = array();
		$arrGroupIds = deserialize($row['groups'], true);

		if (!sizeof($arrGroupIds))
		{
			return $args;
		}

		$objGroups = \MemberGroupModel::findMultipleByIds($arrGroupIds);

		if (is_null($objGroups))
		{
			return $args;
		}

		while ($objGroups->next())
		{
			$arrGroups[] = $objGroups->name;
		}

		$args[3] = implode(', ', $arrGroups);

		return $args;
	}
}
