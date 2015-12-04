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
$GLOBALS['TL_LANG']['tl_user']['assignedMember'] = array('Zugeordnetes Mitglied', 'Geben Sie an, welches Mitglied diesem Benutzer zugeordnet sein soll.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_user']['userMemberBridge_legend'] = "Benutzer / Mitglieder Zuordnung";

/**
 * Errors
 */
$GLOBALS['TL_LANG']['tl_user']['assignedMember']['allreadyAssignedError'] = 'Das ausgewählte Mitglied ist bereits einem anderen Benutzer zugeordnet. Geben Sie ein anderes Mitglied an, dass diesem Benutzer zugeordnet sein soll.';

/**
 * Global operation
 */
$GLOBALS['TL_LANG']['tl_user']['createUserForMember']        = array('Benutzer zu Mitglied anlegen', 'Neuen Benutzer zu einem existierendem Mitglied anlegen');
$GLOBALS['TL_LANG']['tl_user']['createUserForMember_member'] = array('Mitglied', 'Wählen Sie ein Mitglied aus, zu dem ein Benutzer anlegt werden soll. Es werden nur Mitglieder angezeigt, die noch nicht mit Benutzern verknüpfte sind.');

?>