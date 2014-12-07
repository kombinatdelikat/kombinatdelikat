<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting;

class Helper extends \Contao\Controller
{
	public static function getCurrency()
	{
		$strReturn = 'Euro';
		$arrCurrency = deserialize(\Config::get('accounting_currency'), true);

		if (sizeof($arrCurrency) > 1)
		{
			$strReturn = $arrCurrency[1];
		}

		return $strReturn;
	}

	public static function getTotalPrice($objElements)
	{
		$intPriceGrand = 0;
		$intPriceGrandTotal = 0;
		$arrPriceGrandTax = array();
		$arrPriceGrandQuantity = array();
		$arrTaxes = deserialize(\Config::get('accounting_taxes'), true);

		if (!is_null($objElements))
		{
			foreach ($objElements as $objElement)
			{
				$arrQuantity = deserialize($objElement->quantity, true);
				$intQuantity = $arrQuantity['value'] ?: 0;
				$intPrice = $intQuantity * $objElement->price_unit;
				$intPriceTax = $intPrice * $objElement->tax / 100;
				$intPriceTotal = $intPrice + $intPriceTax;

				if (!$arrPriceGrandTax[$objElement->tax])
				{
					$arrPriceGrandTax[$objElement->tax] = array(
						'raw' => 0,
						'price' => 0,
						'value' => '',
						'label' => '',
						'abbr' => ''
					);

					foreach ($arrTaxes as $arrTax)
					{
						if ($arrTax['accounting_tax_value'] == $objElement->tax)
						{
							$arrPriceGrandTax[$objElement->tax]['value'] = $arrTax['accounting_tax_value'];
							$arrPriceGrandTax[$objElement->tax]['label'] = $arrTax['accounting_tax_name'];
							$arrPriceGrandTax[$objElement->tax]['abbr'] = $arrTax['accounting_tax_abbr'];
						}
					}
				}

				if (!$arrPriceGrandQuantity[$arrQuantity['unit']])
				{
					$arrPriceGrandQuantity[$arrQuantity['unit']] = 0;
				}

				$intPriceGrand+= $intPrice;
				$arrPriceGrandTax[$objElement->tax]['raw']+= $intPriceTax;
				$arrPriceGrandTax[$objElement->tax]['price'] = \develab\accounting\Helper::formatPrice($arrPriceGrandTax[$objElement->tax]['raw']);
				$arrPriceGrandQuantity[$arrQuantity['unit']]+= $intQuantity;
				$intPriceGrandTotal+= $intPriceTotal;
			}
		}

		foreach ($arrPriceGrandQuantity as $strUnit=>&$intQuantity)
		{
			switch ($strUnit)
			{
				case 'kg':
					$intQuantity = \develab\accounting\Helper::formatWeight($intQuantity);
					break;

				case 'g':
				case 'pc':
					$intQuantity = \develab\accounting\Helper::formatPiece($intQuantity);
			}
		}

		return (object) array(
			'price' => $intPriceGrand,
			'taxes' => $arrPriceGrandTax,
			'total' => $intPriceGrandTotal,
			'quantities' => $arrPriceGrandQuantity
		);
	}

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

			case 'price_total_bill':
				$strReturn = 0;

				if ($arrTags[2])
				{
					$objElements = \Contao\ContentModel::findBy(array('pid=? AND ptable=? AND type=?'), array($arrTags[2], 'tl_accounting_bills', 'accounting_item'));
					$objPrice = \develab\accounting\Helper::getTotalPrice($objElements);
					$strReturn = $objPrice->total;
				}
				if ($arrTags[3])
				{
					$strReturn = \develab\accounting\Helper::formatPrice($strReturn) . ' ' . \develab\accounting\Helper::getCurrency();
				}

				return $strReturn;
				break;

			case 'price_total_offer':
				$strReturn = 0;

				if ($arrTags[2])
				{
					$objElements = \Contao\ContentModel::findBy(array('pid=? AND ptable=? AND type=?'), array($arrTags[2], 'tl_accounting_offers', 'accounting_item'));
					$objPrice = \develab\accounting\Helper::getTotalPrice($objElements);
					$strReturn = $objPrice->total;
				}
				if ($arrTags[3])
				{
					$strReturn = \develab\accounting\Helper::formatPrice($strReturn) . ' ' . \develab\accounting\Helper::getCurrency();
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

	public static function getHeaders($strType='tl_accounting_bills')
	{
		\System::loadLanguageFile('tl_accounting_settings');

		$arrHeadersAvailable = deserialize(\Config::get('elements_' . str_replace('tl_accounting_', '', $strType)), true);
		$arrHeaders = array();

		for ($i=0, $l=sizeof($arrHeadersAvailable); $i < $l; ++$i)
		{
			$strHeader = $arrHeadersAvailable[$i];
			$arrHeaders[$strHeader] = array();
			$arrClass = explode('_', $strHeader);
			if (!$i)
			{
				$arrClass[] = 'col_first';
				$arrHeaders[$strHeader]['first'] = true;
			}
			if ($i == $l-1)
			{
				$arrClass[] = 'col_last';
				$arrHeaders[$strHeader]['last'] = true;
			}

			$arrHeaders[$strHeader]['class'] = implode(' ', $arrClass);
			$arrHeaders[$strHeader]['label'] = $GLOBALS['TL_LANG']['tl_accounting_settings']['elements_types'][$strHeader];
		}

		return $arrHeaders;
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

	public static function formatPrice($varValue, $intLength=2, $strSep=',', $strThousands='.')
	{
		return number_format(floatval($varValue), $intLength, $strSep, $strThousands);
	}

	public static function formatWeight($varValue, $intLength=3, $strSep=',', $strThousands='.')
	{
		return number_format(floatval($varValue), $intLength, $strSep, $strThousands);
	}

	public static function formatPiece($varValue, $intLength=0, $strSep=',', $strThousands='.')
	{
		return number_format(floatval($varValue), $intLength, $strSep, $strThousands);
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
