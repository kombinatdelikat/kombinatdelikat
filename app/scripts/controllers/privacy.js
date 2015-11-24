'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:PrivacyCtrl
 * @description
 * # PrivacyCtrl
 * Controller of the de.kombinatdelikat.www
 */
angular
    .module('de.kombinatdelikat.www')
    .controller('PrivacyCtrl', function ($scope) {
        $scope.$parent.meta = {
            title: 'Datenschutz - Kombinat Delikat',
            description: ''
        };
    });
