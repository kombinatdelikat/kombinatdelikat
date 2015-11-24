'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:MainCtrl
 * @description
 * # NewsCtrl
 * Main controller of the de.kombinatdelikat.www app
 */
angular
    .module('de.kombinatdelikat.www')
    .controller('MainCtrl', function ($timeout, cfpLoadingBar) {
        $timeout(function () {
            cfpLoadingBar.start();
            cfpLoadingBar.set(.3);
            $timeout(function () {
                cfpLoadingBar.set(.7);
            }, 2000);
        }, 2000);
    });
