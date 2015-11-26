'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:ContactCtrl
 * @description
 * # ContactCtrl
 * Controller of the de.kombinatdelikat.www
 */
angular
    .module('de.kombinatdelikat.www')
    .controller('ContactCtrl', ['$scope', function ($scope) {
        $scope.$root.meta = {
            title: 'Kontakt - Kombinat Delikat',
            description: ''
        };
    }]);
