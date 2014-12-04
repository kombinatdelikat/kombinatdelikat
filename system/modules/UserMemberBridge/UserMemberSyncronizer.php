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
 * Class UserMemberBridgeSyncronizer
 *
 * Provide methods to syncronize data between member and user.
 * @copyright  Cliff Parnitzky 2011-2014
 * @author     Cliff Parnitzky
 * @package    UserMemberBridge
 */
class UserMemberSyncronizer extends Backend {
	/**
	 * Syncronizes all fields from user to member
	 * @param DataContainer
	 */
	public function syncUserWithMember(DataContainer $dc) {
		$memberId = $this->Database->prepare("SELECT assignedMember FROM tl_user WHERE id = ?")->execute($dc->activeRecord->id);
		if ($memberId->next()){
			// we have an assigned member so lets update the data
			$arrSyncFields = deserialize($GLOBALS['TL_CONFIG']['userMemberBridgeSyncFields']);
			
			if ($arrSyncFields) {
				if (in_array('username', $arrSyncFields)) {
					$arrSet['username'] = $dc->activeRecord->username;
				}
				if (in_array('name', $arrSyncFields)) {
					$usernameFormat = $GLOBALS['TL_CONFIG']['userMemberBridgeUsernameFormat'];
					
					if ($usernameFormat == 'lastname_comma_blank_firstname') {
						list($lastname, $firstname) = explode(', ', $dc->activeRecord->name, 2);
						
						$arrSet['firstname'] = $firstname;
						$arrSet['lastname'] = $lastname;
					} else if ($usernameFormat == 'firstname_blank_lastname') {
						list($lastname, $firstname) = explode(' ', strrev($dc->activeRecord->name), 2);
						
						$arrSet['firstname'] = strrev($firstname);
						$arrSet['lastname'] = strrev($lastname);
					} else if ($usernameFormat == 'firstname') {
						$arrSet['firstname'] = $dc->activeRecord->name;
					} else if ($usernameFormat == 'lastname') {
						$arrSet['lastname'] = $dc->activeRecord->name;
					}
				}
				if (in_array('email', $arrSyncFields)) {
					$arrSet['email'] = $dc->activeRecord->email;
				}
				if (in_array('password', $arrSyncFields)) {
					$arrSet['password'] = $dc->activeRecord->password;
				}
				
				$this->Database->prepare("UPDATE tl_member %s WHERE id=?")->set($arrSet)->execute($memberId->assignedMember);
			}
		}
	}
	
	/**
	 * Syncronizes all fields from member to user, when the member was changed in member administration
	 * @param DataContainer
	 */
	public function saveMemberFromBackend ($object) {
		$member = $object;
		if ($object instanceof DataContainer)
		{
			$member = $object->activeRecord;
		}
		if (!$GLOBALS['TL_CONFIG']['userMemberBridgeActivateAdminSecurity']) {
			// admin security not active
			$this->syncMemberWithUser($member);
		} else {
			// admin security active
			$objAssignedUser = $this->Database->prepare("SELECT * FROM tl_user WHERE assignedMember = ?")->execute($member->id);
			
			if ($objAssignedUser->next()) {
				// a user is assigned to the actual member
				// at first synchronize, because fistname, lastname, email are okay
				$this->syncMemberWithUser($member);
				
				$this->import('BackendUser', 'User');
				
				// now check and reset login data, if executin user is a non admin and assigned user is an admin
				if ($objAssignedUser->admin && !$this->User->isAdmin) {
					// a non admin want to change data of an admin ... username and password are not allowed!!!
					// reset login, username and password to the data of the assigned user (if changed or synchronization is enabled)
					$arrSyncFields = deserialize($GLOBALS['TL_CONFIG']['userMemberBridgeSyncFields']);
					if (in_array('username', $arrSyncFields) && $member->username != $objAssignedUser->username) {
						$arrSet['username'] = $objAssignedUser->username;
					}
					if (in_array('password', $arrSyncFields) && $member->password != $objAssignedUser->password) {
						$arrSet['password'] = $objAssignedUser->password;
					}
					
					if (count($arrSet) > 0) {
						$this->Database->prepare("UPDATE tl_user %s WHERE id = ?")
													 ->set($arrSet)
													 ->execute($objAssignedUser->id);

					 $this->Database->prepare("UPDATE tl_member %s WHERE id = ?")
													 ->set($arrSet)
													 ->execute($member->id);
						$this->log('A non administrator (' . $this->User->name . ') tried to change login data of an administrator (' . $objAssignedUser->name . ') via member administration.', 'UserMemberSyncronizer saveMemberFromBackend()', TL_ERROR);
					}
				}
			}
		}
	}
	
	/**
	 * Syncronizes all fields from member to user, when the member was changed in member administration
	 * $varValue The changed value.
	 * $member The member.
	 */
	public function saveMemberFromFronted ($varValue, $member) {
		if (!$member instanceof DataContainer && $member != null) {
			$this->syncMemberWithUser($member);
		}
		return $varValue;
	}
	
	/**
	 * Callback to execute reset the mamberassignement of an user, if the actual assigned member will be deleted
	 */
	public function deleteMember(DataContainer $dc) {
		$arrSet['assignedMember'] = 0;
		$this->Database->prepare("UPDATE tl_user %s WHERE assignedMember=?")->set($arrSet)->execute($dc->activeRecord->id);
	}
	
	/**
	 * Syncronizes all fields from member to user
	 * @param DataContainer
	 */
	private function syncMemberWithUser($user) {
		$userId = $this->Database->prepare("SELECT id FROM tl_user WHERE assignedMember = ?")->execute($user->id);
		if ($userId->next()){
			// we have an assigned member so lets update the data
			$arrSyncFields = deserialize($GLOBALS['TL_CONFIG']['userMemberBridgeSyncFields']);
			
			if ($arrSyncFields) {
				if (in_array('username', $arrSyncFields)) {
					$username = $this->Input->post('username');
					if ($username) {
						$arrSet['username'] = $username;
					}
				}
				if (in_array('name', $arrSyncFields)) {
					$usernameFormat = $GLOBALS['TL_CONFIG']['userMemberBridgeUsernameFormat'];
					
					$firstname = $this->Input->post('firstname');
					if (!$firstname) {
						$firstname = $user->firstname;
					}
					
					$lastname = $this->Input->post('lastname');
					if (!$lastname) {
						$lastname = $user->lastname;
					}
					
					if ($usernameFormat == 'lastname_comma_blank_firstname') {
						$arrSet['name'] = $lastname . ', ' . $firstname;
					} else if ($usernameFormat == 'firstname_blank_lastname') {
						$arrSet['name'] = $firstname . ' ' . $lastname;
					} else if ($usernameFormat == 'firstname') {
						$arrSet['name'] = $firstname;
					} else if ($usernameFormat == 'lastname') {
						$arrSet['name'] = $lastname;
					}
				}
				if (in_array('email', $arrSyncFields)) {
					$email = $this->Input->post('email');
					if ($email) {
						$arrSet['email'] = $email;
					}
				}
				if (in_array('password', $arrSyncFields)) {
					$password = $this->Input->post('password');
					if ($password) {
						$strPassword = "";
						if (version_compare(VERSION, '3.0', '<'))
						{ 
							$strSalt = substr(md5(uniqid(mt_rand(), true)), 0, 23);
							$strPassword = sha1($strSalt . $password) . ':' . $strSalt;
						}
						else
						{
							$strPassword = Encryption::hash($password); 
						}
						$arrSet['password'] = $strPassword;
					}
				}
				
				$this->Database->prepare("UPDATE tl_user %s WHERE id=?")->set($arrSet)->execute($userId->id);
			}
		}
	}
	
	/**
	 * Create a user from an existing member
	 */
	public function createUserForMember()
	{
		if ($this->Input->get('key') != 'createUserForMember')
		{
			$this->redirect(str_replace('&key=createUserForMember', '', $this->Environment->request));
		}

		$this->Template = new BackendTemplate('be_createUserForMember');

		$this->Template->member = $this->getMembersWidget();
		$this->Template->hrefBack = ampersand(str_replace('&key=createUserForMember', '', $this->Environment->request));
		$this->Template->goBack = $GLOBALS['TL_LANG']['MSC']['goBack'];
		$this->Template->headline = $GLOBALS['TL_LANG']['tl_user']['createUserForMember'][1];
		$this->Template->request = ampersand($this->Environment->request, ENCODE_AMPERSANDS);
		$this->Template->submitAndBack = specialchars($GLOBALS['TL_LANG']['MSC']['createUserMemberAndBack']);
		$this->Template->submitAndEdit = specialchars($GLOBALS['TL_LANG']['MSC']['createUserMemberAndEdit']);
		$this->Template->submitAndNew = specialchars($GLOBALS['TL_LANG']['MSC']['createUserMemberAndNew']);
		
		if ($GLOBALS['TL_CONFIG']['userMemberBridgeSyncFields'] == null || $GLOBALS['TL_CONFIG']['userMemberBridgeUsernameFormat'] == null)
		{
			$this->Template->hasError = true;
			$this->Template->errorMessage = $GLOBALS['TL_LANG']['ERR']['settingsNotCorrect'];
		}
		else if (strrpos($this->Template->member->class, "empty") > -1)
		{
			$this->Template->hasError = true;
			$this->Template->errorMessage = $GLOBALS['TL_LANG']['ERR']['noUnassignedMembersFound'];
		}

		// Create user for member
		if ($this->Input->post('FORM_SUBMIT') == 'tl_user_createUserForMember')
		{
			$memberId = $this->Template->member->value;
			$objMember = $this->Database->prepare("SELECT * FROM tl_member WHERE id = ?")->execute($memberId);
			
			$arrSet = $this->getSyncFields($objMember->username, $objMember->firstname, $objMember->lastname, $objMember->email, $objMember->password, true);
			if (count($arrSet) > 0) {
				$arrSet['assignedMember'] = $memberId;
				$arrSet['tstamp'] = time();
				$arrSet['dateAdded'] = time();
				try {
					$insertId = $this->Database->prepare("INSERT INTO tl_user %s")->set($arrSet)->execute()->insertId;
				} catch (Exception $e) {
					$this->log('Error while creating user for member: ' . $e->getMessage(), 'UserMemberSyncronizer createUserForMember', TL_ERROR);
					$this->redirect('contao/main.php?act=error'); 
				}
				
				if (strlen($this->Input->post('saveAndBack')) > 0) {
					$this->redirect(str_replace('&key=createUserForMember', '', $this->Environment->request));
				} else if (strlen($this->Input->post('saveAndEdit')) > 0) {
					$this->redirect(str_replace('&key=createUserForMember', '&act=edit&id=' . $insertId, $this->Environment->request));
				} else {
					$this->redirect($this->Environment->request);
				}
			}
			$this->redirect(str_replace('&key=createUserForMember', '' . $insertId, $this->Environment->request));
		}
		return $this->Template->parse();
	}
	
	/**
	 * Create a member from an existing user
	 */
	public function createMemberForUser()
	{
		if ($this->Input->get('key') != 'createMemberForUser')
		{
			$this->redirect(str_replace('&key=createMemberForUser', '', $this->Environment->request));
		}

		$this->Template = new BackendTemplate('be_createMemberForUser');

		$this->Template->user = $this->getUsersWidget();
		$this->Template->hrefBack = ampersand(str_replace('&key=createMemberForUser', '', $this->Environment->request));
		$this->Template->goBack = $GLOBALS['TL_LANG']['MSC']['goBack'];
		$this->Template->headline = $GLOBALS['TL_LANG']['tl_member']['createMemberForUser'][1];
		$this->Template->request = ampersand($this->Environment->request, ENCODE_AMPERSANDS);
		$this->Template->submitAndBack = specialchars($GLOBALS['TL_LANG']['MSC']['createUserMemberAndBack']);
		$this->Template->submitAndEdit = specialchars($GLOBALS['TL_LANG']['MSC']['createUserMemberAndEdit']);
		$this->Template->submitAndNew = specialchars($GLOBALS['TL_LANG']['MSC']['createUserMemberAndNew']);

		if ($GLOBALS['TL_CONFIG']['userMemberBridgeSyncFields'] == null || $GLOBALS['TL_CONFIG']['userMemberBridgeUsernameFormat'] == null)
		{
			$this->Template->hasError = true;
			$this->Template->errorMessage = $GLOBALS['TL_LANG']['ERR']['settingsNotCorrect'];
		}
		else if (strrpos($this->Template->user->class, "empty") > -1)
		{
			$this->Template->hasError = true;
			$this->Template->errorMessage = $GLOBALS['TL_LANG']['ERR']['noUnassignedUsersFound'];
		}

		// Create member for user
		if ($this->Input->post('FORM_SUBMIT') == 'tl_member_createMemberForUser')
		{
			$userId = $this->Template->user->value;
			$objUser = $this->Database->prepare("SELECT * FROM tl_user WHERE id = ?")->execute($userId);
			
			$arrSet = $this->getSyncFields($objUser->username, $objUser->name, '', $objUser->email, $objUser->password, false);
			if (count($arrSet) > 0) {
				
				//TODO for Buttons "saveAndBack" and "saveAndNew" all mandatory fields musst be set !!!
				
				if (strlen($arrSet['username']) > 0 || strlen($arrSet['password']) > 0) {
					$arrSet['login'] = 1;
				}
				$arrSet['tstamp'] = time();
				$arrSet['dateAdded'] = time();
				$insertId = $this->Database->prepare("INSERT INTO tl_member %s")->set($arrSet)->execute()->insertId;
				
				$this->Database->prepare("UPDATE tl_user set assignedMember = ? WHERE id = ?")->execute($insertId, $userId);
				
				if (strlen($this->Input->post('saveAndBack')) > 0) {
					$this->redirect(str_replace('&key=createMemberForUser', '', $this->Environment->request));
				} else if (strlen($this->Input->post('saveAndEdit')) > 0) {
					$this->redirect(str_replace('&key=createMemberForUser', '&act=edit&id=' . $insertId, $this->Environment->request));
				} else {
					$this->redirect($this->Environment->request);
				}
			}
			$this->redirect(str_replace('&key=createMemberForUser', '' . $insertId, $this->Environment->request));
		}
		return $this->Template->parse();
	}
	
	/**
	 * Return the member widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getMembersWidget($value=null)
	{
		$hasOptions = false;
		
		$widget = new SelectMenu();

		$widget->id = 'member';
		$widget->name = 'member';
		$widget->mandatory = true;
		$widget->required = true;
		$widget->label = $GLOBALS['TL_LANG']['tl_user']['createUserForMember_member'][0];
		$widget->multiple = false;
		$options = array();
		$objMember = $this->Database->prepare("SELECT id, firstname, lastname FROM tl_member WHERE id NOT IN (SELECT assignedMember FROM tl_user WHERE assignedMember > 0) ORDER BY firstname, lastname")->execute();
		while ($objMember->next())
		{
			$hasOptions = true;
			$data = $objMember->row();
			array_push($options, array('value' => $data['id'], 'label' => $data['firstname'] . " " . $data['lastname']));
		}
		$widget->options = $options;
		if (!$hasOptions) {
			$widget->class .= " empty";
		}
		$widget->value = $value;
		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_user']['createUserForMember_member'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_user']['createUserForMember_member'][1];
		}

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_user_createUserForMember')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}

	/**
	 * Return the user widget as object
	 * @param mixed
	 * @return object
	 */
	protected function getUsersWidget($value=null)
	{
		$hasOptions = false;
		
		$widget = new SelectMenu();

		$widget->id = 'user';
		$widget->name = 'user';
		$widget->mandatory = true;
		$widget->required = true;
		$widget->label = $GLOBALS['TL_LANG']['tl_member']['createMemberForUser_user'][0];
		$widget->multiple = false;
		$options = array();
		$objMember = $this->Database->prepare("SELECT id, name FROM tl_user WHERE assignedMember = 0 ORDER BY name")->execute();
		while ($objMember->next())
		{
			$hasOptions = true;
			$data = $objMember->row();
			array_push($options, array('value' => $data['id'], 'label' => $data['name']));
		}
		$widget->options = $options;
		if (!$hasOptions) {
			$widget->class .= " empty";
		}
		$widget->value = $value;
		if ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_member']['createMemberForUser_user'][1]))
		{
			$widget->help = $GLOBALS['TL_LANG']['tl_member']['createMemberForUser_user'][1];
		}

		// Valiate input
		if ($this->Input->post('FORM_SUBMIT') == 'tl_member_createMemberForUser')
		{
			$widget->validate();

			if ($widget->hasErrors())
			{
				$this->blnSave = false;
			}
		}

		return $widget;
	}
	
	/**
	 * Put field vaules into an array, if configured.
	 */
	private function getSyncFields($username, $firstname, $lastname, $email, $password, $isMember) {
		$arrSyncFields = deserialize($GLOBALS['TL_CONFIG']['userMemberBridgeSyncFields']);
		if (count($arrSyncFields) > 0) {
			if (in_array('username', $arrSyncFields) && strlen($username) > 0) {
				$arrSet['username'] = $username;
			}
			if (in_array('name', $arrSyncFields) && (strlen($firstname) > 0 || strlen($lastname) > 0)) {
				$usernameFormat = $GLOBALS['TL_CONFIG']['userMemberBridgeUsernameFormat'];
				if ($isMember) {
					switch ($usernameFormat) {
						case 'lastname_comma_blank_firstname' : $arrSet['name'] = $lastname . ', ' . $firstname; break;
						case 'firstname_blank_lastname' : $arrSet['name'] = $firstname . ' ' . $lastname; break;
						case 'firstname' : $arrSet['name'] = $firstname; break;
						case 'lastname' : $arrSet['name'] = $lastname; break;
					}
				} else {
					switch ($usernameFormat) {
						case 'lastname_comma_blank_firstname' : $arrSet['firstname'] = $parts = trimsplit(', ', $firstname); $arrSet['firstname'] = $parts[1]; $arrSet['lastname'] = $parts[0]; break;
						case 'firstname_blank_lastname' : $arrSet['firstname'] = $parts = trimsplit(' ', $firstname); $arrSet['firstname'] = $parts[0]; $arrSet['lastname'] = $parts[1]; break;
						case 'firstname' : $arrSet['firstname'] = $firstname; break;
						case 'lastname' : $arrSet['lastname'] = $firstname; break;
					}
				}
			}
			if (in_array('email', $arrSyncFields) && strlen($email) > 0) {
				$arrSet['email'] = $email;
			}
			if (in_array('password', $arrSyncFields) && strlen($password) > 0) {
				$arrSet['password'] = $password;
			}
			
			return $arrSet;
		}
		return null;
	}
}

?>