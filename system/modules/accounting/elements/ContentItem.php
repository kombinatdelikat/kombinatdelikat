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

class ContentItem extends \develab\accounting\Elements\ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_accounting_item';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		$arrTaxes = deserialize(\Config::get('accounting_taxes'), true);
		$arrQuantity = deserialize($this->quantity, true);
		$this->quantity = $arrQuantity['value'] ?: 1;
		$this->unit = $arrQuantity['unit'] ?: '';
		$this->tax_label = 'Steuerfrei';

		foreach ($arrTaxes as $arrTax)
		{
			if ($arrTax['accounting_tax_value'] == $this->tax)
			{
				$this->tax_label = $arrTax['accounting_tax_name'];
				$this->tax_abbr = $arrTax['accounting_tax_abbr'];
			}
		}

		$this->price = $this->quantity * $this->price_unit;
		$this->price_tax = $this->price * $this->tax / 100;
		$this->price_total = $this->price + $this->price_tax;

		$this->Template->name = $this->name;
		$this->Template->description = $this->replaceInsertTags($this->description, true);
		$this->Template->position = $this->position;
		$this->Template->quantity = $this->quantity;
		$this->Template->unit = $this->unit;
		$this->Template->price_unit = \develab\accounting\Helper::formatPrice($this->price_unit);
		$this->Template->price = \develab\accounting\Helper::formatPrice($this->price);
		$this->Template->price_tax = \develab\accounting\Helper::formatPrice($this->price_tax);
		$this->Template->price_total = \develab\accounting\Helper::formatPrice($this->price_total);
		$this->Template->tax = $this->tax;
		$this->Template->tax_label = $this->tax_label;
		$this->Template->currency = $this->getCurrency();
	}
}
