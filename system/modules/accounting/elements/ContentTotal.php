<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   accounting
 * @author    David Enke <post@davidenke.de>
 * @license   EULA
 * @copyright David Enke 2014
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting\Elements;

class ContentTotal extends \develab\accounting\Elements\ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_accounting_total';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		$objElements = \Contao\ContentModel::findBy(array('id!=? AND pid=? AND ptable=? AND type=?'), array($this->id, $this->pid, $this->ptable, 'accounting_item'));
		$objPrice = $this->getTotalPrice($objElements);

		$this->Template->price = \develab\accounting\Helper::formatPrice($objPrice->price);
		$this->Template->taxes = $objPrice->taxes;
		$this->Template->price_total = \develab\accounting\Helper::formatPrice($objPrice->total);
		$this->Template->currency = $this->getCurrency();
	}

	protected function getTotalPrice($objElements)
	{
		$intPriceGrand = 0;
		$intPriceGrandTotal = 0;
		$arrPriceGrandTax = array();
		$arrTaxes = deserialize(\Config::get('accounting_taxes'), true);

		if (!is_null($objElements))
		{
			foreach ($objElements as $objElement)
			{
				$arrQuantity = deserialize($objElement->quantity, true);
				$intQuantity = $arrQuantity['value'] ?: 1;
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

				$intPriceGrand+= $intPrice;
				$arrPriceGrandTax[$objElement->tax]['raw']+= $intPriceTax;
				$arrPriceGrandTax[$objElement->tax]['price'] = \develab\accounting\Helper::formatPrice($arrPriceGrandTax[$objElement->tax]['raw']);
				$intPriceGrandTotal+= $intPriceTotal;
			}
		}

		return (object) array(
			'price' => $intPriceGrand,
			'taxes' => $arrPriceGrandTax,
			'total' => $intPriceGrandTotal
		);
	}
}
