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

class ContentItem extends \Contao\ContentElement
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
		$this->tax_label = 'Steuerfrei';

		$objPrice = \develab\accounting\Helper::getTotalPrice(array($this));
		$arrFields = \develab\accounting\Helper::getFields($this->objParentModel);

		$this->Template->price_unit = \develab\accounting\Helper::formatPrice($this->price_unit);
		$this->Template->price_subtotal = \develab\accounting\Helper::formatPrice($objPrice->price);
		$this->Template->taxes = $objPrice->taxes;
		$this->Template->quantities = $objPrice->quantities;
		$this->Template->price_total = \develab\accounting\Helper::formatPrice($objPrice->total);

		$this->Template->fields = $arrFields;
		$this->Template->name = $this->name;
		$this->Template->description = $this->replaceInsertTags($this->description, true);
		$this->Template->position = $this->position;
		$this->Template->tax = $this->tax;
		$this->Template->tax_label = $this->tax_label;
		$this->Template->currency = \develab\accounting\Helper::getCurrency();
		$this->Template->position = $this->position;
	}
}
