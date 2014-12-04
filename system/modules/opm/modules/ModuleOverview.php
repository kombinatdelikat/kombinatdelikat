<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\opm;

class ModuleOverview extends \Contao\BackendModule {

	protected $strTemplate = 'be_opm_overview';

	protected function compile() {
		//\Contao\System::loadLanguageFile('tl_maintenance');
		$arrModules = array();
		foreach ($GLOBALS['BE_MOD']['opm'] as $strModule => $arrModule) {
			if ($strModule != 'opm_overview') {
				$arrModules[$GLOBALS['TL_LANG']['MOD'][$strModule][0]] = '?do=' . $strModule;
			}
		}

		$this->Template->modules = $arrModules;
		$this->Template->href = $this->getReferer(true);
		$this->Template->title = specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle']);
		$this->Template->button = $GLOBALS['TL_LANG']['MSC']['backBT'];
	}
}