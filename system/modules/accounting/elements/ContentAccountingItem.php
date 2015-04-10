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

class ContentAccountingItem extends ContentAccounting
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_accounting_item';

	/**
	 * Compile the content element
	 */
	protected function compile()
	{
		parent::compile();

		$objPrice = \develab\accounting\Helper::getTotalPrice(array($this));

		$this->Template->price_unit = \develab\accounting\Helper::formatPrice($this->price_unit);
		$this->Template->price_subtotal = \develab\accounting\Helper::formatPrice($objPrice->price);
		$this->Template->price_total = \develab\accounting\Helper::formatPrice($objPrice->total);
		$this->Template->taxes = $objPrice->taxes;
		$this->Template->quantities = $objPrice->quantities;

		$this->Template->name = $this->name;
		$this->Template->description = $this->replaceInsertTags($this->description, true);
		$this->Template->position = $this->position;
		$this->Template->tax = $this->tax;
		$this->Template->tax_label = $this->tax_label;
	}
}
