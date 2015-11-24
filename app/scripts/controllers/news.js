'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:NewsCtrl
 * @description
 * # NewsCtrl
 * Controller of the de.kombinatdelikat.www
 */
angular
    .module('de.kombinatdelikat.www')
    .controller('NewsCtrl', function ($scope, $log, Posts) {
        $scope.$parent.meta = {
            title: 'Aktuelles - Kombinat Delikat',
            description: ''
        };

        $scope.posts = Posts;
    });
