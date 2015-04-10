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
namespace develab\accounting\Models;

class AccountingModel extends \Model
{
	public function getFields($intSkip=0, $arrForceFields=null)
	{
		$arrFields = array();

		if (!$this->fields && !$arrForceFields)
		{
			return $arrFields;
		}

		\System::loadLanguageFile('tl_accounting_settings_layouts');

		$arrFieldsAvailable = deserialize($arrForceFields ?: $this->fields, true);

		for ($i=$intSkip, $l=sizeof($arrFieldsAvailable); $i < $l; ++$i)
		{
			$strHeader = $arrFieldsAvailable[$i];
			$arrFields[$strHeader] = array();
			$arrClass = explode('_', $strHeader);
			if (!$i)
			{
				$arrClass[] = 'col_first';
				$arrFields[$strHeader]['first'] = true;
			}
			if ($i == $l-1)
			{
				$arrClass[] = 'col_last';
				$arrFields[$strHeader]['last'] = true;
			}

			$arrFields[$strHeader]['class'] = implode(' ', $arrClass);
			$arrFields[$strHeader]['label'] = $GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fields_types'][$strHeader];
		}

		return $arrFields;
	}
}
