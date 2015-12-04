<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;

class KdStockModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_kd_stock';

	public static function getQuantity($varFormula=null, $varExcludeId=null, $varDateLimit=null)
	{
/*
		$t = static::$strTable;
		$strQuery = "SELECT SUM($t.quantity) as q FROM $t WHERE $t.type=?";

		if ($varFormula)
		{
			$strQuery.= " AND $t.formula=$varFormula";
		}
		if ($varExcludeId)
		{
			$strQuery.= " AND $t.id!=$varExcludeId";
		}
		if ($varDateLimit)
		{
			$strQuery.= " AND $t.date<=$varDateLimit";
		}

		$objQuantityP = \Database::getInstance()->prepare($strQuery)->execute('incoming');
		$objQuantityM = \Database::getInstance()->prepare($strQuery)->execute('outgoing');

		$intQuantity = 0;
		$intQuantity+= $objQuantityP->q ?: 0;
		$intQuantity-= $objQuantityM->q ?: 0;

		return $intQuantity;
*/
		return 3;
	}
	
	public static function getQuantityByFormula($varFormula, $varExcludeId=null, $varDateLimit=null)
	{
		if (!$varFormula)
		{
			return null;
		}

		return static::getQuantity($varFormula, $varExcludeId, $varDateLimit);
	}

	public static function countOrders($varFormula=null, $varExcludeId=null, $varDateLimit=null)
	{
/*
		$t = static::$strTable;
		$strQuery = "SELECT SUM($t.quantity) as q FROM $t WHERE $t.type=?";

		if ($varFormula)
		{
			$strQuery.= " AND $t.formula=$varFormula";
		}
		if ($varExcludeId)
		{
			$strQuery.= " AND $t.id!=$varExcludeId";
		}
		if ($varDateLimit)
		{
			$strQuery.= " AND $t.date<=$varDateLimit";
		}

		$objQuantity = \Database::getInstance()->prepare($strQuery)->execute('order');

		return $objQuantity->q ?: 0;
*/
		return 2;
	}

	public static function countOrdersByFormula($varFormula, $varExcludeId=null, $varDateLimit=null)
	{
		if (!$varFormula)
		{
			return null;
		}

		return static::countOrders($varFormula, $varExcludeId, $varDateLimit);
	}
}
