'use strict';

/**
 * @ngdoc overview
 * @name de.kombinatdelikat.www
 * @description
 * # de.kombinatdelikat.www
 *
 * Run of the application.
 */
angular
    .module('de.kombinatdelikat.www')
    .run(function ($rootScope, $log, ) {
        $rootScope.$on('$stateChangeStart', function(event, toState) {
            $log.info('show spinner');
        });
        $rootScope.$on('$stateChangeSuccess', function(event, toState) {
            $log.info('hide spinner');
        });
    });
