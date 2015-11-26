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
    .controller('LocationsCtrl', ['$scope', '$timeout', 'cfpLoadingBar', function ($scope, $timeout, cfpLoadingBar) {
        var _resetLoader = function () {
                cfpLoadingBar.start();
                cfpLoadingBar.set(0.02);
            },
            _init = function () {
                _resetLoader();

                // set page meta
                $scope.$parent.meta = {
                    title: 'Orte - Kombinat Delikat',
                    description: ''
                };

                // set maps data
                $scope.model = {
                    center: {
                        latitude: 51.06879,
                        longitude: 13.74312
                    },
                    zoom: 16,
                    options: {
                        disableDefaultUI: true,
                        disableDoubleClickZoom: true,
                        draggable: false,
                        scrollwheel: false,
                        backgroundColor: 'none',
                        styles: [
                            {
                                "featureType": "all",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "geometry.stroke",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#000000"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "lightness": -20
                                    }
                                ]
                            }
                        ]
                    },
                    events: {
                        tilesloaded: function () {
                            cfpLoadingBar.set(0.5);
                        },
                        idle: function () {
                            cfpLoadingBar.set(1);
                            $timeout(cfpLoadingBar.complete, 350);
                        }
                    },

                    markers: [
                        {
                            id: 1,
                            title: 'test',
                            latitude: 51.06879,
                            longitude: 13.74312,
                            options: {
                                labelContent: 'Test',
                                labelAnchor: '36 61',
                                labelClass: 'label',
                                labelInBackground: false
                            }
                        }
                    ]
                };
            };

        _resetLoader();
        $timeout(_init, 500);
    }]);
