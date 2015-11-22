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
                var alignItems = function () {
                        // http://stackoverflow.com/a/8191333/1146207
                        var left_column_height = 0;
                        var right_column_height = 0;
                        var items = element.children();
                        for (var i = 0; i < items.length; ++i) {
                            var item = angular
                                .element(items[i])
                                .removeClass('left right');

                            if (left_column_height > right_column_height) {
                                right_column_height += item.addClass('right').prop('offsetHeight');
                            } else {
                                left_column_height += item.addClass('left').prop('offsetHeight');
                            }
                        }
                    },
                    checkImageLoad = function () {
                        var images = element[0].querySelectorAll('img');
                        for (var i in images) {
                            if (angular.isElement(images[i])) {
                                angular
                                    .element(images[i])
                                    .bind('load error', alignItems);
                            }
                        }
                    },
                    link = function () {
                        alignItems();
                        checkImageLoad();
                    };

                $timeout(link);
            }
        };
    });
