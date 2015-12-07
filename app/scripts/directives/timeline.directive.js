'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:timeline
 * @description
 * # timeline
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('timeline', ['$window', '$timeout', function ($window, $timeout) {
        return {
            restrict: 'A',
            link: function (scope, element) {
                // align timeline items left or right
                var alignItems = function () {
                        // http://stackoverflow.com/a/8191333/1146207
                        var padding_range = 20,
                            left_column_height = 0,
                            right_column_height = 90,
                            last_use = false,
                            items = element.children();
                        for (var i = 1; i < items.length; ++i) {
                            var item = angular
                                .element(items[i])
                                .removeClass('left right spaced');

                            // determine side
                            if (left_column_height > right_column_height) {
                                last_use = false;
                                right_column_height += item.addClass('right').prop('offsetHeight');
                            }
                            else {
                                last_use = true;
                                left_column_height += item.addClass('left').prop('offsetHeight');
                            }

                            // add spacing to prevent overlapping
/*                            if (left_column_height > right_column_height - padding_range / 2
                                && left_column_height < right_column_height + padding_range / 2) {
                                if (last_use) {
                                    left_column_height+= 10;
                                } else {
                                    right_column_height+= 10;
                                }
                                item.addClass('spaced');
                                console.log(item[0].className)
                            }*/
                        }
                    },
                // load event listener to force re-aligning items
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
                // event listener for prepared sources to force re-aligning items
                    checkSourcePrepared = function () {
                        var sources = element[0].querySelectorAll('video');
                        for (var j in sources) {
                            if (angular.isElement(sources[j])) {
                                angular
                                    .element(sources[j])
                                    .bind('canplay', alignItems);
                            }
                        }
                    },
                // window resize event listener to force re-aligning items
                    checkResize = function () {
                        angular
                            .element($window)
                            .bind('resize', alignItems);
                    },
                // wrapper function
                    link = function () {
                        alignItems();
                        checkResize();
                        $timeout(function () {
                            checkImageLoad();
                            checkSourcePrepared();
                        }, 50);
                    };

                $timeout(link, 50);
            }
        };
    }]);
