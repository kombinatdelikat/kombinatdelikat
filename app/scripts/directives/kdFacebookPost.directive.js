'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:kdFacebookPost
 * @description
 * # kdFacebookPost
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('kdFacebookPost', ['$sce', '$window', '$timeout', function ($sce, $window, $timeout) {
        return {
            templateUrl: 'scripts/views/kdFacebookPost.directive.html',
            restrict: 'EA',
            scope: {
                post: '=kdFacebookPost'
            },
            link: function (scope, elem, attrs) {

                // trust video source
                scope.trustSrc = function (src) {
                    return $sce.trustAsResourceUrl(src);
                };

                // google maps
                scope.openMaps = function (place) {
                    var address = ''; //place.name + ', ';
                    // find by address
                    if (place.location) {
                        if (place.location.street) {
                            address += place.location.street + ', ';
                        }
                        if (place.location.zip) {
                            address += place.location.zip + ' ';
                        }
                        if (place.location.city) {
                            address += place.location.city;
                        }
                    }
                    // find by name
                    else {
                        address = place.name;
                    }
                    $window.open(
                        'https://www.google.de/maps/place/' +
                        encodeURI(address.replace(/\s/gi, '+').replace(/^\+|\+$/gi, '')) +
                        (place.location && place.location.latitude ? '/@' + place.location.latitude + ',' + place.location.longitude + ',16z' : ''),
                        '_blank'
                    );
                };

                // video controls
                scope.toggleVideo = function (ev) {
                    var button = ev.currentTarget,
                        video = button.previousElementSibling || button.previousSibling;

                    if (video.paused) {
                        video.play();
                        angular
                            .element(button)
                            .removeClass('play')
                            .addClass('pause');
                    } else {
                        video.pause();
                        angular
                            .element(button)
                            .removeClass('pause')
                            .addClass('play');
                    }
                };

                // show likes on video and image elements
                if (scope.post.full_picture || scope.post.source) {
                    scope.showLikes = true;
                }

                // is hero?
                $timeout(function () {
                    scope.isHero = elem.hasClass('hero');
                    //console.log(elem.hasClass('hero'), elem[0].className, attrs.class)
                });

                // preload image to determine if it's still existent
                if (scope.post.full_picture) {
                    scope.hideImage = false;
                    var url = scope.post.full_picture.match(/safe_image\.php.*url=(.*)/i),
                        cache = new Image();
                    if (url && url.length > 1) {
                        cache.onerror= function () {
                            scope.hideImage = true;
                        };
                        cache.src = decodeURIComponent(url[1]);
                    }
                }
            }
        };
    }]);
