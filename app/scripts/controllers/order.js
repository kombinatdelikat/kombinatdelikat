'use strict';

/**
 * @ngdoc function
 * @name dekombinatdelikatwww.controller:OrderCtrl
 * @description
 * # OrderCtrl
 * Controller of the dekombinatdelikatwww
 */
angular.module('dekombinatdelikatwww')
  .controller('OrderCtrl', function ($scope) {
      $scope.$parent.meta = {
          title: 'Bestellen - Kombinat Delikat',
          description: ''
      };
  });
