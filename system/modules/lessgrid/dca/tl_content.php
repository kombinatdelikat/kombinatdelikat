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
 * Table tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'][] = 'gridColumns';
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'][] = 'gridOffset';
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_grid', 'extendPalettes');

$GLOBALS['TL_DCA']['tl_content']['fields']['perRow']['default'] = 1;
$GLOBALS['TL_DCA']['tl_content']['fields']['gridColumns'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['gridColumns'],
	'exclude'                 => true,
	'default'                 => 8,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_grid', 'getColumns'),
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['gridOffset'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['gridOffset'],
	'exclude'                 => true,
	'default'                 => 0,
	'inputType'               => 'select',
	'options'                 => array(0, 1, 2, 3, 4, 5, 6, 7),
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['noKicker'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['noKicker'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'clr w50 m12'),
	'sql'                     => "char(1) NOT NULL default ''"
);

class tl_content_grid extends tl_content
{
	public function extendPalettes(DataContainer $dc)
	{
		if ($dc->parentTable != 'tl_article')
		{
			return;
		}

		$objArticle = \Contao\ArticleModel::findByPk(\Contao\ContentModel::findByPk($dc->id)->pid);

		if (!is_null($objArticle) && $objArticle->isGrid)
		{
			foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $k => $v)
			{
				if ($k != '__selector__')
				{
					$GLOBALS['TL_DCA']['tl_content']['palettes'][$k] = str_replace
					(
						array
						(
							'type,headline;',
							'type;'
						),
						array
						(
							'type,headline;{layout_legend},gridColumns,gridOffset,noKicker;',
							'type;{layout_legend},gridColumns,gridOffset,noKicker;'
						),
						$v
					);
				}
			}
		}
	}


	public function getColumns(DataContainer $dc)
	{
		if ($dc->parentTable == 'tl_article')
		{
			$objArticle = \ArticleModel::findPublishedById($dc->activeRecord->pid);
			$intColumns = $objArticle->gridColumns;

			for ($i = 1; $i <= $intColumns; ++$i)
			{
				$arrColumns[] = $i;
			}

			return $arrColumns;
		}
	}
}