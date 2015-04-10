<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting\Modules;

class BackendSettings extends BackendOverview
{
	/**
	 * Get modules
	 * @return array
	 */
	protected function getModules()
	{
		$arrReturn = array();

		foreach ($GLOBALS['BE_MOD']['accounting']['accounting_settings']['modules'] as $strGroup => $arrModules)
		{
			foreach ($arrModules as $strModule => $arrConfig)
			{
				if (is_array($arrConfig['tables']))
				{
					$GLOBALS['BE_MOD']['accounting']['accounting_settings']['tables'] = array_merge
					(
						$GLOBALS['BE_MOD']['accounting']['accounting_settings']['tables'],
						$arrConfig['tables']
					);
				}
				$arrReturn[$strGroup]['modules'][$strModule] = array_merge
				(
					$arrConfig,
					array
					(
						'label'	        => specialchars($GLOBALS['TL_LANG']['MOD'][$strModule][0] ?: $strModule),
						'description'   => specialchars(strip_tags($GLOBALS['TL_LANG']['MOD'][$strModule][1])),
						'href'          => \Contao\Environment::get('script') . '?do=accounting_settings&mod=' . $strModule,
						'class'         => $arrConfig['class'],
					)
				);
				$strLabel = str_replace(':hide', '', $strGroup);
				$arrReturn[$strGroup]['label'] = $GLOBALS['TL_LANG']['MOD'][$strLabel] ?: $strLabel;
			}
		}
		return $arrReturn;
	}

	protected function checkUserAccess($module)
	{
		return \BackendUser::getInstance()->isAdmin;// || \BackendUser::getInstance()->hasAccess($module, 'iso_modules');
	}

	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$this->Template->modules = $this->arrModules;
		$this->Template->before = '<h1 id="tl_welcome">' . $GLOBALS['TL_LANG']['MOD']['accounting_settings'][1] . '</h1>';

		parent::compile();
	}
}
