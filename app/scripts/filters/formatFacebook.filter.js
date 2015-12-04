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
        return function (text, deep) {
            if (angular.isDefined(text)) {
                var html = text
                    // asterisks mark list items
                    .replace(/^\*+\s+(.*)[\r?\n|\r]*/gm, "<li>$1</li>")

                    // line breaks to break tags
                    .replace(/\r?\n|\r/g, "\r<br>")

                    // facebook links
                    .replace(/@\[\d+\:\d+:(.*?)\]/gim, "$1")

                    // wrap list items with ul
                    .replace(/^(.*?)(<li>.*<\/li>)(.*?)$/gim, "$1<ul>$2</ul>$3");

                // deep argument
                if (deep) {
                    html = html
                        // first line to dot or colon (up to 90 signs) as headline
                        .replace(/^(.{0,90})(\.|\:|\!|\?)+\s+/gi, "<h3>$1$2</h3>")

                        // remove leading breaks after headlines
                        .replace(/<\/h3>\s*<br>/gim, "</h3>")

                        // prevent single headlines
                        .replace(/^<h3>(.*)<\/h3>$/gi, '$1');
                }

                return html;
            }
        };
    });
