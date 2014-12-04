<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2014 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2011-2014
 * @author     Cliff Parnitzky
 * @package    UserMemberBridge
 * @license    LGPL
 */

/**
 * Back end modules
 */
// Extend backend module configuration for global operation
$GLOBALS['BE_MOD']['accounts']['user']['createUserForMember'] = array('UserMemberSyncronizer', 'createUserForMember');
$GLOBALS['BE_MOD']['accounts']['member']['createMemberForUser'] = array('UserMemberSyncronizer', 'createMemberForUser');
 
/**
 * to fix height of style class w50 in backend
 */
if (TL_MODE == 'BE')
{
	$GLOBALS['TL_CSS'][] = 'system/modules/UserMemberBridge/html/w50_fix.css'; 
}  
?>