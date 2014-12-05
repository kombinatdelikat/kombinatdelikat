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

	public static function formatPrice($varValue)
	{
		return number_format(floatval($varValue), 2, '.', '');
	}

	public static function formatPriceTiers(array $arrPriceTiers, $strPriceLabel='', $strPriceType='tiers_count')
	{
		$arrReturn = array(
			'size' => sizeof($arrPriceTiers),
			'tiers' => '',
			'price' => '',
			'gross' => ''
		);
		$strUnit = $strPriceType == 'tiers_count' ? 'Stück' : 'Kilogramm';

		if ($arrReturn['size'])
		{
			$arrReturn['tiers'] = '<ul>';
			$arrReturn['price'] = '<ul>';
			$arrReturn['gross'] = '<ul>';

			foreach ($arrPriceTiers as $arrPriceTier)
			{
				$arrReturn['tiers'].= '<li class="tier">ab ' . $arrPriceTier['range_from'] . ' ' . $strUnit . '</li>';
				$arrReturn['price'].= '<li class="price">' . $arrPriceTier['range_price'] . $strPriceLabel . '</li>';
				$arrReturn['gross'].= '<li class="price gross">' . $this->formatPrice($arrPriceTier['range_price'] * 1.07) . $strPriceLabel . '</li>';
			}

			$arrReturn['tiers'].= '</ul>';
			$arrReturn['price'].= '</ul>';
			$arrReturn['gross'].= '</ul>';
		}

		return $arrReturn;
	}

	public function updateContentElement($strAction, $dc)
	{
		if ($strAction == 'updateContentElements')
		{
			$intPid = \Input::post('pid');
			$strPtable = 'tl_accounting_bills';
	
			if (!$intPid)
			{
				echo 'false';
			}
	
			$objContentElements = \Contao\ContentModel::findBy(array('pid=? AND ptable=?'), array($intPid, $strPtable));
	
			if (!is_null($objContentElements))
			{
				$arrReturn = array();
				foreach ($objContentElements as $objContentElement)
				{
					$arrReturn[$objContentElement->id] = $this->getContentElement($objContentElement->id);
				}
				echo json_encode($arrReturn);
			}
			else
			{
				echo 'false';
			}
		}
	}
}
