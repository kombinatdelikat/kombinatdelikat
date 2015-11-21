'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:kdFacebookPost
 * @description
 * # kdFacebookPost
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('kdFacebookPost', function () {
        return {
            templateUrl: 'scripts/views/kdFacebookPost.directive.html',
            restrict: 'EA',
            scope: {
                kdPostTime: '@',
                kdPostMessage: '@',
                kdPostImage: '@',
                kdPostLikes: '@'
            },
            link: function (scope, element, attrs) {

            }
        };
    });
