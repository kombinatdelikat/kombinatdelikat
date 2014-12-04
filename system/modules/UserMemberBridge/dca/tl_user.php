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
 * Extending paletts
 */
foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $key => $row)
{
    if ($key == '__selector__' || $key == 'login')
    {    
        continue;
    }

    $arrPalettes = explode(";", $row);
    $arrPalettes[] = '{userMemberBridge_legend:hide},assignedMember';
    
    $GLOBALS['TL_DCA']['tl_user']['palettes'][$key] = implode(";", $arrPalettes);
}

/**
 * Add field
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['assignedMember'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['assignedMember'],
	'filter'                  => true,
	'search'                  => true,
	'inputType'               => 'select',
	'foreignKey'            => 'tl_member.CONCAT(firstname, " ", lastname, " (", id, ")")',
	'save_callback'           => array(array('tl_user_assignedMemeber', 'checkMemberIsAssignable')),
	'eval'                    => array('tl_class'=>'w50', 'includeBlankOption'=>true)
);

/**
 * Add submit callback
 */
$GLOBALS['TL_DCA']['tl_user']['config']['onsubmit_callback'][] = array('UserMemberSyncronizer', 'syncUserWithMember');

/**
 * Add global operation "createUserForMember"
 */
array_insert
(
	$GLOBALS['TL_DCA']['tl_user']['list']['global_operations'],
	0,
	array
	(
		'createUserForMember' => array
		(
			'label'      => &$GLOBALS['TL_LANG']['tl_user']['createUserForMember'],
			'href'       => 'key=createUserForMember',
			'attributes' => 'onclick="Backend.getScrollOffset();" style="background: url(system/modules/UserMemberBridge/html/createUserForMember.png) no-repeat scroll left center transparent; padding: 2px 0 3px 20px;"'
		)
	)
);

/**
 * Class tl_user_assignedMemeber
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2011-2014
 * @author     Cliff Parnitzky
 * @package    UserMemberBridge
 * @license    LGPL
*/
class tl_user_assignedMemeber extends Backend
{
	/**
	 * Returns all members that are not assigned to an user
	 */
	public function checkMemberIsAssignable($varValue, DataContainer $dc)
	{
		$memberList = $this->Database->prepare("SELECT id FROM tl_user WHERE assignedMember = ?")->execute($varValue);
		if ($varValue > 0 && $memberList->next() && $memberList->id != $dc->id)
		{
			throw new Exception($GLOBALS['TL_LANG']['tl_user']['assignedMember']['allreadyAssignedError']);
		}
		
		return $varValue;
	}
}

?>