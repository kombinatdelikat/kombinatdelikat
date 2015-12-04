<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'KombinatDelikat',
	'Facebook',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'KombinatDelikat\Classes\Helper'                => 'system/modules/kd/classes/Helper.php',

	// Models
	'Contao\KdCorrespondenceModel'                  => 'system/modules/kd/models/KdCorrespondenceModel.php',
	'Contao\KdFormulasModel'                        => 'system/modules/kd/models/KdFormulasModel.php',
	'Contao\KdLabelsModel'                          => 'system/modules/kd/models/KdLabelsModel.php',
	'Contao\KdProductChargesModel'                  => 'system/modules/kd/models/KdProductChargesModel.php',
	'Contao\KdProductsModel'                        => 'system/modules/kd/models/KdProductsModel.php',
	'Contao\KdStockModel'                           => 'system/modules/kd/models/KdStockModel.php',

	// Modules
	'KombinatDelikat\Modules\ModuleFacebookPage'    => 'system/modules/kd/modules/ModuleFacebookPage.php',

	// Vendor
	'Facebook\Entities\AccessToken'                 => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/Entities/AccessToken.php',
	'Facebook\Entities\SignedRequest'               => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/Entities/SignedRequest.php',
	'Facebook\FacebookAuthorizationException'       => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookAuthorizationException.php',
	'Facebook\FacebookCanvasLoginHelper'            => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookCanvasLoginHelper.php',
	'Facebook\FacebookClientException'              => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookClientException.php',
	'Facebook\FacebookJavaScriptLoginHelper'        => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookJavaScriptLoginHelper.php',
	'Facebook\FacebookOtherException'               => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookOtherException.php',
	'Facebook\FacebookPageTabHelper'                => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookPageTabHelper.php',
	'Facebook\FacebookPermissionException'          => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookPermissionException.php',
	'Facebook\FacebookPermissions'                  => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookPermissions.php',
	'Facebook\FacebookRedirectLoginHelper'          => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookRedirectLoginHelper.php',
	'Facebook\FacebookRequest'                      => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookRequest.php',
	'Facebook\FacebookRequestException'             => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookRequestException.php',
	'Facebook\FacebookResponse'                     => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookResponse.php',
	'Facebook\FacebookSDKException'                 => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookSDKException.php',
	'Facebook\FacebookServerException'              => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookServerException.php',
	'Facebook\FacebookSession'                      => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookSession.php',
	'Facebook\FacebookSignedRequestFromInputHelper' => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookSignedRequestFromInputHelper.php',
	'Facebook\FacebookThrottleException'            => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookThrottleException.php',
	'Facebook\GraphAlbum'                           => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphAlbum.php',
	'Facebook\GraphLocation'                        => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphLocation.php',
	'Facebook\GraphObject'                          => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphObject.php',
	'Facebook\GraphPage'                            => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphPage.php',
	'Facebook\GraphSessionInfo'                     => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphSessionInfo.php',
	'Facebook\GraphUser'                            => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphUser.php',
	'Facebook\GraphUserPage'                        => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphUserPage.php',
	'Facebook\HttpClients\FacebookCurl'             => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/HttpClients/FacebookCurl.php',
	'Facebook\HttpClients\FacebookCurlHttpClient'   => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/HttpClients/FacebookCurlHttpClient.php',
	'Facebook\HttpClients\FacebookGuzzleHttpClient' => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/HttpClients/FacebookGuzzleHttpClient.php',
	'Facebook\HttpClients\FacebookHttpable'         => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/HttpClients/FacebookHttpable.php',
	'Facebook\HttpClients\FacebookStream'           => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/HttpClients/FacebookStream.php',
	'Facebook\HttpClients\FacebookStreamHttpClient' => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/src/Facebook/HttpClients/FacebookStreamHttpClient.php',
	'AccessTokenTest'                               => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/Entities/AccessTokenTest.php',
	'SignedRequestTest'                             => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/Entities/SignedRequestTest.php',
	'FacebookCanvasLoginHelperTest'                 => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookCanvasLoginHelperTest.php',
	'FacebookJavaScriptLoginHelperTest'             => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookJavaScriptLoginHelperTest.php',
	'FacebookPageTabHelperTest'                     => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookPageTabHelperTest.php',
	'FacebookRedirectLoginHelperTest'               => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookRedirectLoginHelperTest.php',
	'FacebookRequestExceptionTest'                  => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookRequestExceptionTest.php',
	'FacebookRequestTest'                           => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookRequestTest.php',
	'FacebookSessionTest'                           => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookSessionTest.php',
	'FacebookSignedRequestFromInputHelperTest'      => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookSignedRequestFromInputHelperTest.php',
	'FacebookTestHelper'                            => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/FacebookTestHelper.php',
	'GraphAlbumTest'                                => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/GraphAlbumTest.php',
	'GraphLocationTest'                             => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/GraphLocationTest.php',
	'GraphObjectTest'                               => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/GraphObjectTest.php',
	'GraphSessionInfoTest'                          => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/GraphSessionInfoTest.php',
	'GraphUserTest'                                 => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/GraphUserTest.php',
	'AbstractTestHttpClient'                        => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/HttpClients/AbstractTestHttpClient.php',
	'FacebookCurlHttpClientTest'                    => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/HttpClients/FacebookCurlHttpClientTest.php',
	'FacebookGuzzleHttpClientTest'                  => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/HttpClients/FacebookGuzzleHttpClientTest.php',
	'FacebookStreamHttpClientTest'                  => 'system/modules/kd/vendor/facebook-php-sdk-v4-4.0-dev/tests/HttpClients/FacebookStreamHttpClientTest.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_'                => 'system/modules/kd/templates/elements',
	'mod_facebook_page'  => 'system/modules/kd/templates/modules',
	'pdf_correspondence' => 'system/modules/kd/templates/pdf',
	'pdf_labels'         => 'system/modules/kd/templates/pdf',
));
