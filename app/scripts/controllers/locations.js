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
                        zoom: 16,
                        options: config.googlemaps,
                        events: {
                            tilesloaded: function () {
                                cfpLoadingBar.set(0.5);
                            },
                            idle: function () {
                                cfpLoadingBar.set(1);
                                $timeout(cfpLoadingBar.complete, 350);
                                _openMarker(null, null, {id: 1});
                            }
                        },

                        markers: [
                            {
                                id: 1,
                                title: 'Kombinat Delikat Fensterverkauf',
                                coords: {
                                    latitude: 51.06908,
                                    longitude: 13.75537
                                },
                                options: {
                                    content: '<div id="marker-1" class="marker uber"><div><h2>Fensterverkauf</h2><p>Nach Angebot,<br>immer Freitags<br><strong>18:00 - 20:00 Uhr</strong></p></div></div>',
                                    shadow: false,
                                    flat: true
                                }
                            },
                            {
                                id: 2,
                                title: 'Sankt Pauli Tagesbar und Restaurant',
                                coords: {
                                    latitude: 51.07512,
                                    longitude: 13.75033
                                },
                                options: {
                                    content: '<div id="marker-2" class="marker"><div><h2>Sankt Pauli</h2><p>Pastrami-Sandwich</p></div></div>',
                                    shadow: false,
                                    flat: true
                                }
                            },
                            {
                                id: 3,
                                title: 'Kochbox',
                                coords: {
                                    latitude: 51.066709,
                                    longitude: 13.754139
                                },
                                options: {
                                    content: '<div id="marker-3" class="marker"><div><h2>Kochbox</h2><p>Wechselnde Auswahl an Bratwurst</p></div></div>',
                                    shadow: false,
                                    flat: true
                                }
                            }
                        ]
                    }
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
