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
 * HOOKs
 */
$GLOBALS['TL_HOOKS']['getArticle'][] = array('Helper', 'prepareGridArticles');
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('Helper', 'wrapGridElements');
$GLOBALS['TL_HOOKS']['getContentElement'][] = array('Helper', 'prepareGridElements');
$GLOBALS['TL_HOOKS']['generatePage'][] = array('Helper', 'addAliasClass');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('Helper', 'addClassHeader');
