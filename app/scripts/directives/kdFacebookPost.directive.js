'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:kdFacebookPost
 * @description
 * # kdFacebookPost
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('kdFacebookPost', ['$sce', '$http', function ($sce, $http) {
        return {
            templateUrl: 'scripts/views/kdFacebookPost.directive.html',
            restrict: 'EA',
            scope: {
                kdPost: '='
            },
            link: function (scope, elem, attrs) {

                // trust video source
                scope.trustSrc = function (src) {
                    return $sce.trustAsResourceUrl(src);
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
                if (scope.kdPost.full_picture || scope.kdPost.source) {
                    scope.showLikes = true;
                }

                // preload image to determine if it's still existent
                if (scope.kdPost.full_picture) {
                    scope.hideImage = false;
                    var url = scope.kdPost.full_picture.match(/safe_image\.php.*url=(.*)/i),
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
