'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:LocationsCtrl
 * @description
 * # LocationsCtrl
 * Controller of the de.kombinatdelikat.www
 */
angular.module('de.kombinatdelikat.www')
    .controller('LocationsCtrl', function ($scope) {
        $scope.$parent.meta = {
            title: 'Orte - Kombinat Delikat',
            description: ''
        };
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
            }
        };
    });
