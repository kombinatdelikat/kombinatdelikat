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
    .controller('NewsCtrl', ['$scope', '$log', 'Posts', function ($scope, $log, Posts) {
        $scope.$root.meta = {
            title: 'Aktuelles - Kombinat Delikat',
            description: ''
        };

        //Posts.splice(0, 2);

        $scope.posts = Posts;
    }]);
