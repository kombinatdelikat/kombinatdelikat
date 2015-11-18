'use strict';

/**
 * @ngdoc function
 * @name dekombinatdelikatwww.controller:ContactCtrl
 * @description
 * # ContactCtrl
 * Controller of the dekombinatdelikatwww
 */
angular.module('dekombinatdelikatwww')
  .controller('ContactCtrl', function ($scope) {
      $scope.$parent.meta = {
          title: 'Kontakt - Kombinat Delikat',
          description: ''
      };
  });
