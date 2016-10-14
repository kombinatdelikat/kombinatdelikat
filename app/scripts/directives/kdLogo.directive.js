'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:kdLogo
 * @description
 * # kdLogo
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('kdLogo', ['$window', '$timeout', function ($window, $timeout) {
        return {
            restrict: 'A',
            link: function (scope, element) {
                var l = 49,
                    p = 51,
                    //c = 255,
                    q = 3.5,
                    html = angular.element($window.document.querySelector('html')),
                    timeout;

                angular.element($window).bind('scroll', function () {
                    var y = this.pageYOffset,
                        eq = y <= l * q,
                        top = eq ? l - y / q : 0,
                        padding = eq ? y / q / l * p : p,
                        //rgb = Math.round(eq ? y / q / l * c : c),
                        opacity = eq ? y / q / l : 1;

                    // apply styles
                    element.css({
                        'top': top + 'px',
                        //'fill': 'rgb(' + rgb + ',' + rgb + ',' + rgb + ')',
                        'padding': '11px ' + padding + 'px 0'
                    });
                    angular.element(element[0].querySelector('path.big')).css('opacity', 1 - opacity);
                    angular.element(element[0].querySelector('path.small')).css('opacity', opacity);

                    // set scroll class
                    html.addClass('scrolling');
                    if (timeout) $timeout.cancel(timeout);
                    timeout = $timeout(function() {
                        html.removeClass('scrolling');
                    }, 100);
                });
            }
        };
    }]);
