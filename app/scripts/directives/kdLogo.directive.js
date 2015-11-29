'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:kdLogo
 * @description
 * # kdLogo
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('kdLogo', ['$window', function ($window) {
        return {
            restrict: 'A',
            link: function (scope, elem) {
                var e = elem,
                    w = angular.element($window),
                    o_big = angular.element(elem[0].querySelector('path.big')),
                    o_small = angular.element(elem[0].querySelector('path.small')),
                    l = 49,
                    p = 51,
                    c = 255,
                    q = 3.5;

                w.bind('scroll', function () {
                    var y = this.pageYOffset,
                        eq = y <= l * q,
                        top = eq ? l - y / q : 0,
                        padding = eq ? y / q / l * p : p,
                        rgb = Math.round(eq ? y / q / l * c : c),
                        opacity = eq ? y / q / l : 1;

                    e.css({
                        'top': top + 'px',
                        //'fill': 'rgb(' + rgb + ',' + rgb + ',' + rgb + ')',
                        'padding': '11px ' + padding + 'px 0'
                    });
                    o_big.css('opacity', 1 - opacity);
                    o_small.css('opacity', opacity);
                });
            }
        };
    }]);
