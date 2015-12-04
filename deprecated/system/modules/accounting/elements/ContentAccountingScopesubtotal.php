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

class ContentAccountingScopesubtotal extends ContentAccounting
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_accounting_scopesubtotal';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		parent::compile();

		$arrElements = array();
		$arrElementTypes = array_keys($GLOBALS['TL_CTE_' . strtoupper(str_replace('tl_accounting_', '', $this->ptable))]['accounting']);
		$intIndent = isset($this->indent) ? $this->indent : 2;
		$objElements = \Contao\ContentModel::findBy(
			array('id!=? AND pid=? AND ptable=? AND sorting<=?'),
			array($this->id, $this->pid, $this->ptable, $this->sorting),
			array('order'=>'sorting DESC')
		);

		if (!is_null($objElements))
		{
			foreach ($objElements as $objElement)
			{
				if (!in_array($objElement->type, $arrElementTypes))
				{
					break;
				}
				if ($objElement->type == 'accounting_item')
				{
					$arrElements[] = $objElement;
				}
			}
		}

		$objPrice = \develab\accounting\Helper::getTotalPrice($arrElements);
		$arrFields = $this->objParentModel->getFields($intIndent, $this->fields);

		$this->Template->indent = $intIndent;
		$this->Template->fields = $arrFields;
		$this->Template->price_subtotal = \develab\accounting\Helper::formatPrice($objPrice->price);
		$this->Template->taxes = $objPrice->taxes;
		$this->Template->quantities = $objPrice->quantities;
		$this->Template->price_total = \develab\accounting\Helper::formatPrice($objPrice->total);
	}
}
