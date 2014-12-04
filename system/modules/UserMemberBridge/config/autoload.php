<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package UserMemberBridge
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'UserMemberSyncronizer' => 'system/modules/UserMemberBridge/UserMemberSyncronizer.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_createMemberForUser' => 'system/modules/UserMemberBridge/templates',
	'be_createUserForMember' => 'system/modules/UserMemberBridge/templates',
));
