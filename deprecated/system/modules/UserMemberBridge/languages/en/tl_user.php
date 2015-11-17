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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_user']['assignedMember'] = array('Assigned member', 'Indicate which member should be assigned to that user.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_user']['userMemberBridge_legend'] = "User / Member Assignment";

/**
 * Errors
 */
$GLOBALS['TL_LANG']['tl_user']['assignedMember']['allreadyAssignedError'] = 'The selected member is already assigned to another user. Enter another member of that this user should be assigned.';

/**
 * Global operation
 */
$GLOBALS['TL_LANG']['tl_user']['createUserForMember']        = array('Create user for member', 'Create new user for an existing member');
$GLOBALS['TL_LANG']['tl_user']['createUserForMember_member'] = array('Member', 'Please select a member, the new user should be created for. Only not assigned members will be displayed in the list.');

?>