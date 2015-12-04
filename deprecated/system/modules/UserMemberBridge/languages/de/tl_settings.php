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
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']            = array('Felder zur Synchronisation', 'Hier können Sie die Felder auswählen, die synchronisiert werden sollen.');
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']        = array('Format für den Namen eines Benutzers', 'Wählen sie das Format, welches der Darstellung des Namen eines Benutzers entspricht.');
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeActivateAdminSecurity'] = array('Administrator Sicherheit aktivieren', 'Bei aktivierter Administratoren Sicherheit ist es nur Administratoren gestattet, über die Mitgliederverwaltung die Logindaten (Benutzername und Passwort) eines Mitglieds, das mit einem Administrator verknüpft ist, auf diesen Benutzer zu synchronisieren. Das Hacken eine Administratoraccounts durch einen Mitgliederbearbeiter wird so unterbunden.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridge_legend'] = "Benutzer / Mitglieder Zuordnung";

/**
 * Options
 */
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']['username'] = "Benutzername";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']['name']     = "Name (Vorname + Nachname)";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']['email']    = "E-Mail-Adresse";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields']['password'] = "Passwort";

$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']['lastname_comma_blank_firstname'] = "Nachname, Vorname";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']['firstname_blank_lastname']       = "Vorname Nachname";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']['firstname']                      = "Vorname";
$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat']['lastname']                       = "Nachname";

?>