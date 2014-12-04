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
 * Add delete callback to remove an existing assignment
 */
$GLOBALS['TL_DCA']['tl_member']['config']['ondelete_callback'][] = array('UserMemberSyncronizer', 'deleteMember');

/**
 * Add save callback to member
 * NOTE: Because ModulePersonalData does not support 'onsubmit_callback' we need a save_callback on each possible field for frontend editing
 */
$GLOBALS['TL_DCA']['tl_member']['fields']['username']['save_callback'][]  = array('UserMemberSyncronizer', 'saveMemberFromFronted');
$GLOBALS['TL_DCA']['tl_member']['fields']['firstname']['save_callback'][] = array('UserMemberSyncronizer', 'saveMemberFromFronted');
$GLOBALS['TL_DCA']['tl_member']['fields']['lastname']['save_callback'][]  = array('UserMemberSyncronizer', 'saveMemberFromFronted');
$GLOBALS['TL_DCA']['tl_member']['fields']['email']['save_callback'][]     = array('UserMemberSyncronizer', 'saveMemberFromFronted');
$GLOBALS['TL_DCA']['tl_member']['fields']['password']['save_callback'][]  = array('UserMemberSyncronizer', 'saveMemberFromFronted');

/**
 * Add submit callback
 * NOTE: So we can diffe if the request coms from member administration (neede to pay attention to admin security)
 */
$GLOBALS['TL_DCA']['tl_member']['config']['onsubmit_callback'][] = array('UserMemberSyncronizer', 'saveMemberFromBackend');

/**
 * Add global operation "createMemberForUser"
 */
array_insert
(
	$GLOBALS['TL_DCA']['tl_member']['list']['global_operations'],
	0,
	array
	(
		'createMemberForUser' => array
		(
			'label'      => &$GLOBALS['TL_LANG']['tl_member']['createMemberForUser'],
			'href'       => 'key=createMemberForUser',
			'attributes' => 'onclick="Backend.getScrollOffset();" style="background: url(system/modules/UserMemberBridge/html/createMemberForUser.png) no-repeat scroll left center transparent; padding: 2px 0 3px 20px;"'
		)
	)
);
 
?>