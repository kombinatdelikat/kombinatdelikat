'use strict';

/**
 * @ngdoc directive
 * @name de.kombinatdelikat.www.directive:kdFacebookPost
 * @description
 * # kdFacebookPost
 */
angular
    .module('de.kombinatdelikat.www')
    .directive('kdFacebookPost', function ($sce) {
        return {
            templateUrl: 'scripts/views/kdFacebookPost.directive.html',
            restrict: 'EA',
            scope: {
                kdPost: '='
            },
            link: function (scope) {
                scope.trustSrc = function (src) {
                    return $sce.trustAsResourceUrl(src);
                };
                scope.toggleVideo = function (ev) {
                    var button = ev.currentTarget,
                        video = button.previousElementSibling;

                    if (video.paused) {
                        video.play();
                        angular.element(button).removeClass('play').addClass('pause');
                    } else {
                        video.pause();
                        angular.element(button).removeClass('pause').addClass('play');
                    }
                };

                if (scope.kdPost.full_picture || scope.kdPost.source) {
                    scope.showLikes = true;
                }
            }
        };
    });
