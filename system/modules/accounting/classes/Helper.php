<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting;

class Helper extends \Contao\Controller
{
	public function replaceAccountingInsertTags($strTag)
	{
		$arrTags = explode('::', $strTag);

		if (sizeof($arrTags) < 2 || $arrTags[0] != 'accounting')
		{
			return false;
		}

		switch ($arrTags[1])
		{
			case 'no_bills_current':
			case 'no_offers_current':
				$strReturn = \Contao\Config::get($arrTags[1]);

				if ($arrTags[2])
				{
					$strReturn = str_pad($strReturn, $arrTags[2], '0', STR_PAD_LEFT);
				}

				return $strReturn;
				break;
		}

		return false;
	}

	public function getContacts()
	{
		$arrContacts = array();
		$objContacts = \MemberModel::findAll(array('order' => 'lastname'));

		if (is_null($objContacts))
		{
			return $arrContacts;
		}

		while ($objContacts->next())
		{
			$strGroups = '';
			$arrGroups = array();
			$objGroups = \MemberGroupModel::findMultipleByIds(deserialize($objContacts->groups, true));

			if (!is_null($objGroups))
			{
				while ($objGroups->next())
				{
					$arrGroups[$objGroups->name] = $objGroups->name;
				}
				ksort($arrGroups);
				$strGroups = ' (' . implode(', ', $arrGroups) . ')';
			}

			$arrContacts[$objContacts->id] = $objContacts->firstname . ' ' . $objContacts->lastname . ', ' . $objContacts->company . $strGroups;
		}

		return $arrContacts;
	}

	public function getAccountingContentElements($type='TL_CTE')
	{
		$groups = array();
		$type = $GLOBALS[$type] ? $type : 'TL_CTE';

		foreach ($GLOBALS[$type] as $k=>$v)
		{
			foreach (array_keys($v) as $kk)
			{
				$groups[$k][] = $kk;
			}
		}

		return $groups;
	}
}
