<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
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
