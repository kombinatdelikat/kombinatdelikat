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
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{userMemberBridge_legend},userMemberBridgeSyncFields,userMemberBridgeUsernameFormat,userMemberBridgeActivateAdminSecurity;';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['userMemberBridgeSyncFields'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields'],
	'inputType'               => 'checkbox',
	'options'                 => array('username', 'name', 'email', 'password'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeSyncFields'],
	'eval'                    => array('multiple'=>true, 'mandatory'=>true, 'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['userMemberBridgeUsernameFormat'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat'],
	'inputType'               => 'radio',
	'options'                 => array('lastname_comma_blank_firstname', 'firstname_blank_lastname', 'firstname', 'lastname'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeUsernameFormat'],
	'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['userMemberBridgeActivateAdminSecurity'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['userMemberBridgeActivateAdminSecurity'],
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'clr w50')
);

?>