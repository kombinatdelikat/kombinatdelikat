'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:kdFacebookPost
 * @description
 * # kdFacebookPost
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('kdFacebookPost', function ($log) {
        return {
            templateUrl: 'scripts/views/kdFacebookPost.directive.html',
            restrict: 'EA',
            scope: {
                kdPost: '='
            },
            link: function (scope, elem, attrs) {
                if (scope.kdPost.full_picture) {
                    scope.showLikes = true;
                }
            }
        };
    });
