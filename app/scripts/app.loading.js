'use strict';

/**
 * @ngdoc overview
 * @name de.kombinatdelikat.www
 * @description
 * # de.kombinatdelikat.www
 *
 * Route of the application.
 */
angular
    .module('de.kombinatdelikat.www')
    .config(function (cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = false;
        cfpLoadingBarProvider.latencyThreshold = 100;
    });
