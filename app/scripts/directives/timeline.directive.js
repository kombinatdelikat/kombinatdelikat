'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:timeline
 * @description
 * # timeline
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('timeline', function ($timeout) {
        return {
            restrict: 'A',
            link: function (scope, element) {
                $timeout(function () {
                    // http://stackoverflow.com/a/8191333/1146207
                    var left_column_height = 0;
                    var right_column_height = 0;
                    var items = element.children();
                    for (var i = 0; i < items.length; ++i) {
                        var item = items[i];
                        if (left_column_height > right_column_height) {
                            right_column_height += angular.element(item).addClass('right').prop('offsetHeight')
                        } else {
                            left_column_height += angular.element(item).addClass('left').prop('offsetHeight');
                        }
                    }
                });
            }
        };
    });
