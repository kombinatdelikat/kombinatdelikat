'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:loadImage
 * @description
 * # loadImage
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('loadImage', ['$timeout', function ($timeout) {
        return {
            restrict: 'EA',
            replace: true,
            scope: {
                alt: '=',
                src: '=',
                ngSrc: '@'
            },
            template: '<div class="image-container"><img src="{{src}}" ng-src="{{ngSrc}}" alt="{{alt}}"></div>',
            link: function (scope, element) {
                element
                    .find('img')
                    .bind('load', function () {
                        element.addClass('loaded');
                    });
            }
        }
    }]);
