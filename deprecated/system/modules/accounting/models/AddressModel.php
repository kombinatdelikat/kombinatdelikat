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
namespace W3S\Addresses;


/**
 * Reads and writes Addresses
 *
 * @copyright  David Enke 2010-2014
 * @author     david.enke
 * @license    GNU/GPL
 */
class AddressModel extends \Model {

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_address';
}