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
                    c = 255;

                w.bind('scroll', function () {
                    var y = this.pageYOffset,
                        eq = y <= l,
                        top = eq ? l - y : 0,
                        padding = eq ? y / l * p : p,
                        rgb = Math.round(eq ? y / l * c : c),
                        opacity = eq ? y / l : 1;

                    e.css({
                        'top': top + 'px',
                        'padding': '11px ' + padding + 'px 0',
                        'fill': 'rgb(' + rgb + ',' + rgb + ',' + rgb + ')'
                    });
                    o_big.css('opacity', 1 - opacity);
                    o_small.css('opacity', opacity);
                });
            }
        };
    }]);
