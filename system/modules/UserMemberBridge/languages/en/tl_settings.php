<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']            = array('Fields for synchronization', 'Here you can select the fields that schould be synchronized.');
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']        = array('Format for a user\'s name', 'Choose the format that corresponds to the representation of the name of a user.');
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeActivateAdminSecurity'] = array('Activate administrator security', 'If administrator security is activated, in member administration only administrators are allowed to synchronize the login data (username and password) of a member which is assigned to an administrator to that user. This prevents hacking an administrator account by user that is allowed to edit members.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridge_legend'] = "User / Member Assignment";

/**
 * Options
 */
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']['username'] = "Username";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']['name']     = "Name (Firstname + Lastname)";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']['email']    = "Email address";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']['password'] = "Password";

$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']['lastname_comma_blank_firstname'] = "Lastname, Firstname";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']['firstname_blank_lastname']       = "Firstname Lastname";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']['firstname']                      = "Firstname";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']['lastname']                       = "Lastname";

?>