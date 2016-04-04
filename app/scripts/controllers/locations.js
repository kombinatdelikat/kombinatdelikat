'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:LocationsCtrl
 * @description
 * # LocationsCtrl
 * Controller of the de.kombinatdelikat.www
 */
angular
    .module('de.kombinatdelikat.www')
    .controller('LocationsCtrl', [
        '$scope', '$timeout', 'cfpLoadingBar', 'config',
        function ($scope, $timeout, cfpLoadingBar, config) {
            // fixes lodash error by angular google maps
            _.contains = _.includes;

            var _resetLoader = function () {
                    cfpLoadingBar.start();
                },
                _assignModel = function () {
                    // set maps data
                    $scope.model = {
                        center: {
                            latitude: 51.071,
                            longitude: 13.75537
                        },
                        bounds: {
                            northeast: {
                                latitude: 51.071,
                                longitude: 13.75537
                            },
                            southwest: {
                                latitude: 51.071,
                                longitude: 13.75537
                            }
                        },
                        zoom: 15,
                        options: config.googlemaps,
                        markers: config.markers,
                        events: {
                            tilesloaded: function () {
                                cfpLoadingBar.set(0.5);
                            },
                            idle: function () {
                                cfpLoadingBar.set(1);
                                $timeout(function () {
                                    cfpLoadingBar.complete();
                                    _openMarker(null, null, {id: 1});
                                }, 2 * 1000);
                            }
                        }
                    };
                },
                _openMarker = function (marker, eventType, model) {
                    var elems = angular.element(document.querySelectorAll('.marker:not(#marker-' + model.id + ')')),
                        elem = angular.element(document.getElementById('marker-' + model.id));

                    elems.removeClass('active');
                    elem.toggleClass('active');

                    // nothing active, reopen 'uber'
                    if (!document.querySelectorAll('.marker.active').length) {
                        angular.element(document.querySelector('.marker.uber')).addClass('active');
                    }
                },

                _init = function () {

                    // set page meta
                    $scope.$root.meta = {
                        title: 'Probieren - Kombinat Delikat',
                        description: ''
                    };

                    _resetLoader();
                    _assignModel();

                    $scope.openMarker = _openMarker;
                };

            _resetLoader();
            $timeout(_init, 500);
        }
    ]);
