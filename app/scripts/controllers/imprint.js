'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:ImprintCtrl
 * @description
 * # ImprintCtrl
 * Controller of the de.kombinatdelikat.www
 */
angular.module('de.kombinatdelikat.www')
  .controller('ImprintCtrl', function ($scope) {
      $scope.$parent.meta = {
          title: 'Impressum - Kombinat Delikat',
          description: ''
      };
  });
