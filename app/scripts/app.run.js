'use strict';

/**
 * @ngdoc overview
 * @name de.kombinatdelikat.www
 * @description
 * # de.kombinatdelikat.www
 *
 * Run the application.
 */
angular
    .module('de.kombinatdelikat.www')
    .run(function ($rootScope) {

        $rootScope.$on('cfpLoadingBar:started', function () {
            $rootScope.loading = true;
        });
        $rootScope.$on('cfpLoadingBar:completed', function () {
            $rootScope.loading = false;
        });

    });
