'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.filter:formatFacebook
 * @description
 * # formatFacebook
 * Filter to format Facebook posts to html
 */
angular
    .module('de.kombinatdelikat.www')
    .filter('formatFacebook', function () {
        return function(text) {
            if (angular.isDefined(text)) {
                return text
                    .replace(/\*+\s*(.*)[\r?\n|\r]*/gm, "<li>$1</li>")
                    .replace(/\r?\n|\r/g, "\r<br>");
            }
        };
    });
