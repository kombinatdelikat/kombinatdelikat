<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace KombinatDelikat\Classes;

class Helper extends \Controller
{

	public function wrapHeadlines(ContentModel $objElementModel, $strBuffer, $objElement)
	{
		if ($objElementModel->type == 'headline')
		{
			if (preg_match('/(.*"\>)+(.*)(\<\/h.+\>)+/is', $strBuffer, $arrBuffer))
			{
				$arrHeadline = explode('{{br}}', trim($arrBuffer[2]));
				return $arrBuffer[1] . '<span>' . implode('</span><span>', $arrHeadline) . '</span>'  . $arrBuffer[3];
			}
		}

		return $strBuffer;
	}

	public function formatPrice($varValue)
	{
		return number_format(floatval($varValue), 2, '.', '');
	}

	public function formatPriceTiers(array $arrPriceTiers, $strPriceLabel='', $strPriceType='tiers_count')
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

	public function showStockMessage()
	{
		$intStockCount = \KdStockModel::countBy('type', 'incoming');

		if (!$intStockCount)
		{
			Message::addError('Momentan sind keine Waren im Bestand!');
			return;
		}

		$strAssets = sprintf('%ssystem/modules/kd/assets', TL_ASSETS_URL);

		$GLOBALS['TL_CSS'][] = 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700';
		$GLOBALS['TL_CSS'][] = sprintf('%s/css/kd_stock.css|screen', $strAssets);

		// set header
		$strMessage = '<table class="stock">';
		$strMessage.= sprintf('<thead><tr><th><image src="%s/img/kd.png" alt=""></th>', $strAssets);
		$strMessage.= '<th class="tier">Preis pro kg</th>';
		$strMessage.= '<th class="price">Netto</th>';
		$strMessage.= '<th class="price gross">Brutto</th>';
		$strMessage.= '<th class="stock">vorrätig</th>';
		$strMessage.= '<th class="stock">bestellt</th>';
		$strMessage.= '<th class="stock">verfügbar</th>';
		$strMessage.= '</tr></thead>';

		$intQuantityTotal = 0;
		$intOrderedTotal = 0;

		$arrProducts = array();
		$objStockItems = \KdStockModel::findAll();

		while ($objStockItems->next())
		{
			$objProduct;
			$intQuantity;

			// collect data
			switch ($objStockItems->type)
			{
				case 'incoming':
					$objCharge = \KdProductChargesModel::findByPk($objStockItems->charge);
					if (is_null($objCharge))
					{
						continue;
					}
					$objProduct = $objCharge->getRelated('pid');
					$intQuantity = $objCharge->quantity;
					break;

				case 'outgoing':
					$objCharge = \KdProductChargesModel::findByPk($objStockItems->charge);
					if (is_null($objCharge))
					{
						continue;
					}
					$objProduct = $objCharge->getRelated('pid');
					$intQuantity = $objStockItems->quantity;
					break;

				case 'order':
					$objProduct = \KdProductsModel::findByPk($objStockItems->product);
					$intQuantity = $objStockItems->delivery < time() ? 0 : $objStockItems->quantity;
					break;
			}

			// prepare entry
			if (!$arrProducts[$objProduct->title])
			{
				if ($objProduct->price_type == 'fix')
				{
					$arrProducts[$objProduct->title]['tiers'] = false;
					$arrProducts[$objProduct->title]['price'] = $objProduct->price_fix;
				}
				else
				{
					$arrPriceTiers = $this->formatPriceTiers(deserialize($objProduct->price_tiers, true), null, $objProduct->price_type);
					$arrProducts[$objProduct->title]['collapse'] = $arrPriceTiers['size'] * 29;
					$arrProducts[$objProduct->title]['tiers'] = $arrPriceTiers['tiers'];
					$arrProducts[$objProduct->title]['price'] = $arrPriceTiers['price'];
					$arrProducts[$objProduct->title]['gross'] = $arrPriceTiers['gross'];
				}

				$arrProducts[$objProduct->title]['quantity'] = 0;
				$arrProducts[$objProduct->title]['ordered'] = 0;
			}

			// set quantities
			switch ($objStockItems->type)
			{
				case 'incoming':
					$arrProducts[$objProduct->title]['quantity']+= $intQuantity;
					break;

				case 'outgoing':
					$arrProducts[$objProduct->title]['quantity']-= $intQuantity;
					break;

				case 'order':
					$arrProducts[$objProduct->title]['ordered']+= $intQuantity;
					break;
			}
		}

		// sort by title
		ksort($arrProducts);

		// build message
		foreach ($arrProducts as $strProduct=>$arrProduct)
		{
			$intDiff = $arrProduct['quantity'] - $arrProduct['ordered'];
			$strDiff = $intDiff < 0 ? '<span class="red">' . $intDiff . '</span>' : $intDiff;
			$intQuantityTotal+= $arrProduct['quantity'];
			$intOrderedTotal+= $arrProduct['ordered'];

			$strMessage.= '<tr onmouseover="Theme.hoverRow(this,1)' . ($arrProduct['collapse'] ? ';this.getElements(\'ul\').setStyle(\'height\',' . $arrProduct['collapse'] . ')' : '') . '" onmouseout="Theme.hoverRow(this,0)' . ($arrProduct['collapse'] ? ';this.getElements(\'ul\').removeProperty(\'style\')' : '') . '" onclick="Theme.toggleSelect(this)"><td>' . $strProduct . '</td>';

			if (!$arrProduct['tiers'])
			{
				$strMessage.= '<td></td>';
				$strMessage.= '<td class="price">' . $this->formatPrice($arrProduct['price']) . '</td>';
				$strMessage.= '<td class="price gross">' . $this->formatPrice($arrProduct['price'] * 1.07). '</td>';
			}
			else
			{
				$strMessage.= '<td class="collapse">' . $arrProduct['tiers'] . '</td>';
				$strMessage.= '<td class="collapse">' . $arrProduct['price'] . '</td>';
				$strMessage.= '<td class="collapse">' . $arrProduct['gross'] . '</td>';
			}

			$strMessage.= '<td class="stock">' . $arrProduct['quantity'] . '</td>';
			$strMessage.= '<td class="stock">' . $arrProduct['ordered'] . '</td>';
			$strMessage.= '<td class="stock">' . $strDiff . '</td>';
			$strMessage.= '</tr>';
		}

		// set footer
		$intDiffTotal = $intQuantityTotal - $intOrderedTotal;
		$strDiffTotal = $intDiffTotal < 0 ? '<span class="red">' . $intDiffTotal . '</span>' : $intDiffTotal;

		$strMessage.= '<tfoot><tr><td colspan="4">Gesamt</td>';
		$strMessage.= '<td class="stock">' . $intQuantityTotal . '</td>';
		$strMessage.= '<td class="stock">' . $intOrderedTotal . '</td>';
		$strMessage.= '<td class="stock">' . $intDiffTotal . '</td>';
		$strMessage.= '</tr></tfoot></table>';

		Message::addRaw($strMessage);
	}

	public function addLabelAssets($strContent, $strTemplate)
	{
		if ($strTemplate == 'be_main')
		{
			$strAssets = '<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css">';
			$strAssets.= '<link href="system/modules/kd/assets/css/kd_labeler.css" rel="stylesheet" type="text/css">';
			$strAssets.= '<link href="system/modules/kd/assets/css/kd_labeler_print.css" rel="stylesheet" type="text/css" media="print">';
			$strContent = str_ireplace('</head>', $strAssets . '</head>', $strContent);
		}

		return $strContent;
	}

	public function addInsertTags($strTag)
	{
		if ($strTag == 'strong_open')
		{
			return '<strong>';
		}
		elseif ($strTag == 'strong_close')
		{
			return '</strong>';
		}
		
		return false;
	}

	public function generateLabels($arrRow)
	{
		
	}
}