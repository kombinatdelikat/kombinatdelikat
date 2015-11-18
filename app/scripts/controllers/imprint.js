'use strict';

/**
 * @ngdoc function
 * @name dekombinatdelikatwww.controller:ImprintCtrl
 * @description
 * # ImprintCtrl
 * Controller of the dekombinatdelikatwww
 */
angular.module('dekombinatdelikatwww')
  .controller('ImprintCtrl', function ($scope) {
      $scope.$parent.meta = {
          title: 'Impressum - Kombinat Delikat',
          description: ''
      };
  });
