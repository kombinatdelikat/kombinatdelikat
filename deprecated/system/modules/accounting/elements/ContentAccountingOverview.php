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

class ContentAccountingOverview extends ContentAccounting
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_accounting_overview';

	/**
	 * Compile the content element
	 */
	protected function compile()
	{
		parent::compile();

		$this->loadLanguageFile('tl_content');

		$arrElements = array();
		$arrCategories = array();
		$arrFields = $this->objParentModel->getFields(0, $this->fields);
		$objElements = \Contao\ContentModel::findBy(
			array('id!=? AND pid=? AND ptable=? AND type=?'),
			array($this->id, $this->pid, $this->ptable, 'accounting_item'),
			array('order'=>'category ASC')
		);

		if (!is_null($objElements))
		{
			foreach ($objElements as $objElement)
			{
				$strCategory = $objElement->category ?: $GLOBALS['TL_LANG']['tl_content']['category_none'];
				if (!$arrElements[$strCategory])
				{
					$arrElements[$strCategory] = array(
						'category' => $strCategory,
						'elements' => array(),
						'fields' => $arrFields
					);
				}
				$arrElements[$strCategory]['elements'][] = $objElement;
			}
		}

		foreach ($arrElements as &$arrCategory)
		{
			$objPrice = \develab\accounting\Helper::getTotalPrice($arrCategory['elements']);
			$arrCategory['taxes'] =  $objPrice->taxes;
			$arrCategory['quantities'] = $objPrice->quantities;
			$arrCategory['price_subtotal'] = \develab\accounting\Helper::formatPrice($objPrice->price);
			$arrCategory['price_total'] = \develab\accounting\Helper::formatPrice($objPrice->total);
		}

		$objElementStart = new \develab\accounting\Elements\ContentAccountingStart($objElements);
		$objElementStart->fields = $this->fields;
		$this->Template->start = $objElementStart->generate();

		$objElementStop = new \develab\accounting\Elements\ContentAccountingStop($objElements);
		$objElementStop->fields = $this->fields;
		$this->Template->stop = $objElementStop->generate();

		$objElementTotal = new \develab\accounting\Elements\ContentAccountingTotal($objElements);
		$objElementTotal->indent = 1;
		$objElementTotal->fields = $this->fields;
		$this->Template->tfoot = $objElementTotal->generate();

		$this->Template->fields = $arrFields;
		$this->Template->elements = $arrElements;
	}
}
