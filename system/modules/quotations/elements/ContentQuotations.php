<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Core
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;


/**
 * Class ContentText
 *
 * Front end content element "quotations".
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    Core
 */
class ContentQuotations extends \ContentElement {

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_quotations';


	/**
	 * Generate the content element
	 */
	protected function compile() {
		$arrItems = array();
		$items = deserialize($this->quotations);
		$limit = count($items) - 1;

		for ($i=0, $c=count($items); $i<$c; $i++) {
			$arrItems[] = array(
				'class' => (($i == 0) ? 'first' : (($i == $limit) ? 'last' : '')),
				'content' => $items[$i]
			);
		}

		$this->Template->items = $arrItems;
		$this->Template->tag = 'ul';
	}
}
