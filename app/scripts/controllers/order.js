'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:OrderCtrl
 * @description
 * # OrderCtrl
 * Controller of the de.kombinatdelikat.www
 */
angular
    .module('de.kombinatdelikat.www')
    .controller('OrderCtrl', ['$scope', function ($scope) {
        $scope.$root.meta = {
            title: 'Bestellen - Kombinat Delikat',
            description: ''
        };
    }]);
