'use strict';

/**
 * @ngdoc function
 * @name dekombinatdelikatwww.controller:LocationsCtrl
 * @description
 * # LocationsCtrl
 * Controller of the dekombinatdelikatwww
 */
angular.module('dekombinatdelikatwww')
    .controller('LocationsCtrl', function ($scope) {
        $scope.$parent.meta = {
            title: 'Orte - Kombinat Delikat',
            description: ''
        };
        $scope.model = {
            center: {
                latitude: 51.06879,
                longitude: 13.74312
            },
            zoom: 16,
            options: {
                disableDefaultUI: true,
                disableDoubleClickZoom: true,
                draggable: false,
                scrollwheel: false
            }
        };
    });
