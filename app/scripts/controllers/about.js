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
  .controller('AboutCtrl', ['$scope', function ($scope) {
      $scope.$root.meta = {
          title: 'Prädikat - Kombinat Delikat',
          description: ''
      };
  }]);
