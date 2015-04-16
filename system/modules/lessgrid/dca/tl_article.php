<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @copyright  David Enke 2013-2015
 * @author     David Enke (davidenke@develab.de) 
 * @package    lessgrid 
 * @license    LGPL
 */


/**
 * Table tl_article
 */
$GLOBALS['TL_DCA']['tl_article']['list']['label']['fields'][] = 'gridColumns';
$GLOBALS['TL_DCA']['tl_article']['list']['label']['fields'][] = 'gridOffset';
$GLOBALS['TL_DCA']['tl_article']['list']['label']['label_callback'] = array('tl_article_grid', 'addGridInfo');

$GLOBALS['TL_DCA']['tl_article']['palettes']['__selector__'][] = 'isGrid';
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace('{layout_legend},inColumn', '{layout_legend},isGrid,inColumn', $GLOBALS['TL_DCA']['tl_article']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_article']['subpalettes']['isGrid'] = 'gridColumns,gridOffset';

$GLOBALS['TL_DCA']['tl_article']['fields']['inColumn']['eval']['tl_class'] = 'clr';
$GLOBALS['TL_DCA']['tl_article']['fields']['isGrid'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_article']['isGrid'],
	'exclude'                 => true,
	'default'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true),
	'sql'                     => "char(1) NOT NULL default '1'"
);
$GLOBALS['TL_DCA']['tl_article']['fields']['gridColumns'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_article']['gridColumns'],
	'exclude'                 => true,
	'default'                 => 8,
	'inputType'               => 'select',
	'options_callback'        => array('tl_article_grid', 'getGridColumns'),
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_article']['fields']['gridOffset'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_article']['gridOffset'],
	'exclude'                 => true,
	'default'                 => 0,
	'inputType'               => 'select',
	'options_callback'        => array('tl_article_grid', 'getGridOffsets'),
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

class tl_article_grid extends tl_article
{
	public function addGridInfo($arrRow, $strLabel)
	{
		if ($arrRow['isGrid'])
		{
			$strLabel.= sprintf('<br><span style="color:#b3b3b3">Rasterspalten: %s, Rastereinzug: %s</span>', $arrRow['gridColumns'], $arrRow['gridOffset']);
		}

		return $this->addIcon($arrRow, $strLabel);
	}


	public function getGridColumns(DataContainer $dc)
	{
		$arrReturn = array();

		if ($dc->activeRecord)
		{
			$objParent = \PageModel::findWithDetails($dc->activeRecord->pid);
			if (!is_null($objParent))
			{
				$objLayout = $objParent->getRelated('layout');
			}
			else
			{
				$objLayout = \LayoutModel::findOneBy('pid', 1);
			}
		}
		else
		{
			$objLayout = \LayoutModel::findOneBy('pid', 1);
		}

		$arrReturn = range(1, $objLayout->gridCols);

		return $arrReturn;
	}


	public function getGridOffsets(DataContainer $dc)
	{
		$arrReturn = array();

		if ($dc->activeRecord)
		{
			$objParent = \PageModel::findWithDetails($dc->activeRecord->pid);
			if (!is_null($objParent))
			{
				$objLayout = $objParent->getRelated('layout');
			}
			else
			{
				$objLayout = \LayoutModel::findBy('id!=0', null, array('limit'=>1));
			}

			$arrReturn = range(0, $objLayout->gridCols - 1);
		}

		return $arrReturn;
	}
}
