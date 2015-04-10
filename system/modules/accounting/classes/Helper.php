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
			case 'no_customers_current':
				$strReturn = \Contao\Config::get($arrTags[1]);

				if ($arrTags[2])
				{
					$strReturn = str_pad($strReturn, $arrTags[2], '0', STR_PAD_LEFT);
				}

				return $strReturn;
				break;

			case 'price_total_bill':
				$strReturn = 0;

				if ($arrTags[2] || \Input::get('id'))
				{
					$objElements = \Contao\ContentModel::findBy(array('pid=? AND ptable=? AND type=?'), array($arrTags[2] ?: \Input::get('id'), 'tl_accounting_bills', 'accounting_item'));
					if (is_null($objElements))
					{
						return false;
					}
					$objPrice = \develab\accounting\Helper::getTotalPrice($objElements);
					$strReturn = $objPrice->total;
				}
				if ($arrTags[3])
				{
					$strReturn = \develab\accounting\Helper::formatPrice($strReturn) . ' ' . \develab\accounting\Helper::getCurrency();
				}

				return $strReturn;
				break;

			case 'date_bill':
				$strReturn = false;

				if ($arrTags[2] || \Input::get('id'))
				{
					$objBillModel = Models\BillsModel::findOneBy('id', $arrTags[2] ?: \Input::get('id'));
					if (is_null($objBillModel))
					{
						return false;
					}
					$strReturn = $objBillModel->date;
				}
				if ($arrTags[3])
				{
					$strReturn = \Date::parse('d. F Y', $objBillModel->date);
				}

				return $strReturn;
				break;

			case 'date_due_bill':
				$strReturn = false;

				if ($arrTags[2] || \Input::get('id'))
				{
					$objBillModel = Models\BillsModel::findOneBy('id', $arrTags[2] ?: \Input::get('id'));
					if (is_null($objBillModel))
					{
						return false;
					}
					$strReturn = $objBillModel->due;
				}
				if ($arrTags[3])
				{
					$strReturn = \Date::parse('d. F Y', $objBillModel->date + (60 * 60 * 24 * $objBillModel->due));
				}

				return $strReturn;
				break;

			case 'sender_bill':
				$strReturn = false;

				if (($arrTags[2] || \Input::get('id')) && $arrTags[3])
				{
					$objBillModel = Models\BillsModel::findOneBy('id', $arrTags[2] ?: \Input::get('id'));
					if (is_null($objBillModel))
					{
						return false;
					}
					$objRelatedModel = $objBillModel->getRelated('responsible');
					$strReturn = $objRelatedModel->$arrTags[3];

					if ($arrTags[3] == 'salutation')
					{
						if ($objRelatedModel->gender)
						{
							$strReturn = 'Sehr' . ($objRelatedModel->gender == 'female' ? 'geehrte Frau' : 'geehrter Herr') . ' ' . $objRelatedModel->lastname;
						}
						else
						{
							$strReturn = 'Guten Tag';
						}
					}
				}

				return $strReturn;
				break;

			case 'recipient_bill':
				$strReturn = false;

				if (($arrTags[2] || \Input::get('id')) && $arrTags[3])
				{
					$objBillModel = Models\BillsModel::findOneBy('id', $arrTags[2] ?: \Input::get('id'));
					if (is_null($objBillModel))
					{
						return false;
					}
					$objRelatedModel = $objBillModel->getRelated('customer');
					$strReturn = $objRelatedModel->$arrTags[3];

					if ($arrTags[3] == 'salutation')
					{
						if ($objRelatedModel->gender)
						{
							$strReturn = 'Sehr ' . ($objRelatedModel->gender == 'female' ? 'geehrte Frau' : 'geehrter Herr') . ' ' . $objRelatedModel->lastname;
						}
						else
						{
							$strReturn = 'Guten Tag';
						}
					}
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
			$arrContacts[$objContacts->id] = $objContacts->firstname . ' ' . $objContacts->lastname . ($objContacts->company ? ', ' . $objContacts->company : ($objContacts->isPrivateAddress ? ', privat' : ''));
		}

		return $arrContacts;
	}

	public function getDefaultFields($varValue, $dc)
	{
		if (isset($varValue))
		{
			return $varValue;
		}

		$strFieldsDefault = \Config::get('fields_' . str_replace('tl_accounting_', '', $dc->table));

		if (!strlen($strFieldsDefault))
		{
			$this->loadDataContainer('tl_accounting_settings_layouts');
			$strFieldsDefault = $GLOBALS['TL_DCA']['tl_accounting_settings_layouts']['fields']['fields']['default'];
		}
		$dc->activeRecord->fields = $strFieldsDefault;

		return $strFieldsDefault;
	}

	public function getDefaultCategories($varValue, $dc)
	{
		if (isset($varValue))
		{
			return $varValue;
		}

		$strCategoriesDefault = \Config::get('accounting_categories');

		if (!strlen($strCategoriesDefault))
		{
			$this->loadDataContainer('tl_accounting_settings_layouts');
			$strCategoriesDefault = $GLOBALS['TL_DCA']['tl_accounting_settings_layouts']['fields']['categories']['default'];
		}
		$dc->activeRecord->categories = $strFieldsDefault;

		return $strCategoriesDefault;	
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

	public function setDefaultValues($dc)
	{
		if ($dc->table)
		{
			$arrModified = array();
			foreach ($GLOBALS['TL_DCA'][$dc->table]['fields'] as $strName => $arrField)
			{
				if ($arrField['default'] && !\Contao\Config::get($strName))
				{
					$arrModified[] = $strName;
					$objConfig = \Contao\Config::getInstance();
					$objConfig->persist($strName, $arrField['default']);
					$objConfig->save();
					$objConfig->preload();
				}
			}
			if (sizeof($arrModified))
			{
				\System::log('Added default accounting settings ('.implode(', ', $arrModified).') from "' . $dc->table . '"', __METHOD__, TL_CONFIGURATION);
				$this->reload();
			}
		}
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
			$strPtable = 'tl_accounting_' . str_replace('accounting_', '', \Input::post('do'));
	
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
