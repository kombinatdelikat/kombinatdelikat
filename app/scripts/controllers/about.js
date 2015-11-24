'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the de.kombinatdelikat.www
 */
angular
    .module('de.kombinatdelikat.www')
  .controller('AboutCtrl', function ($scope) {
      $scope.$parent.meta = {
          title: 'Prädikat - Kombinat Delikat',
          description: ''
      };
  });
