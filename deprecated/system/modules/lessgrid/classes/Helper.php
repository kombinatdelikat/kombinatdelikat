<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  David Enke 2013-2015
 * @author     David Enke (davidenke@develab.de) 
 * @package    lessgrid 
 * @license    LGPL
 * @filesource
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;

/**
 * Class Helper
 *
 */
class Helper extends \Controller
{
	
	public function prepareGridArticles($objArticle)
	{
		if ($objArticle->isGrid)
		{
			$arrCssId = deserialize($objArticle->cssID, true);
			$arrCssId[1].= 'grid-' . $objArticle->gridColumns . ' offset-' . $objArticle->gridOffset;
			$objArticle->cssID = serialize($arrCssId);
		}
	}


	public function wrapGridElements($strContent, $strTemplate)
	{
		if ($strTemplate != 'mod_article')
		{
			return $strContent;
		}

		return preg_replace('/(<div.*>)(.*)(<\/div>)\s*$/siU', '$1<div class="inside">$2</div>$3', $strContent);
	}


	public function prepareGridElements($objElementModel, $strBuffer, $objElementController)
	{
		if (strpos($strBuffer, 'grid-'))
		{
			return $strBuffer;
		}

		$objArticle = \Contao\ArticleModel::findByPk($objElementModel->pid);

		if (!is_null($objArticle) && $objArticle->isGrid)
		{
			$arrClasses = $objElementModel->classes;
			$arrClasses[] = 'grid-' . $objElementModel->gridColumns;
			$arrClasses[] = 'offset-' . $objElementModel->gridOffset;

			$objElementModel->classes = $arrClasses;
			$objElementController->classes = $arrClasses;

			return preg_replace
			(
				'/(<[div|section]+ class=".*ce_+.*)(">)(.*)(<\/[div|section]+>)(\s*)(<!-- indexer::continue -->)*$/siU',
				'$1 ' . implode(' ', $arrClasses) . '$2<div class="inside"><div class="content"><div class="inner">$3</div></div></div>$4$5$6',
				$strBuffer //$objElementController->generate()
			);
		}

		return $strBuffer;
	}


	public function addAliasClass(\PageModel $objPage, \LayoutModel $objLayout, \PageRegular $objPageRegular)
	{
		$objPage->cssClass.= ' ' . $objPage->alias;
	}


	public function addClassHeader($strContent, $strTemplate)
	{
		if ($strTemplate == 'fe_page')
		{
			if (BE_USER_LOGGED_IN) {
				$strContent = str_replace('<body ', '<body data-grid="true" ', $strContent);
			}
		}

		return $strContent;
	}
}

?>