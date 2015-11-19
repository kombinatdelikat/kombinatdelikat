'use strict';

/**
 * @ngdoc function
 * @name dekombinatdelikatwww.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the dekombinatdelikatwww
 */
angular.module('dekombinatdelikatwww')
  .controller('AboutCtrl', function ($scope) {
      $scope.$parent.meta = {
          title: 'Prädikat - Kombinat Delikat',
          description: ''
      };
  });
