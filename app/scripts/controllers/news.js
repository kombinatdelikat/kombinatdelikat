'use strict';

/**
 * @ngdoc function
 * @name dekombinatdelikatwww.controller:NewsCtrl
 * @description
 * # NewsCtrl
 * Controller of the dekombinatdelikatwww
 */
angular.module('dekombinatdelikatwww')
  .controller('NewsCtrl', function ($scope) {
      $scope.$parent.meta = {
          title: 'Aktuelles - Kombinat Delikat',
          description: ''
      };
  });
