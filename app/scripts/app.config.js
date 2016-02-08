'use strict';

/**
 * @ngdoc overview
 * @name de.kombinatdelikat.www
 * @description
 * # de.kombinatdelikat.www
 *
 * Config of the application.
 */
angular
    .module('de.kombinatdelikat.www')
    .constant('config', {
        facebook: {
            url: 'http://api.kombinatdelikat.de/facebook'
        },
        parse: {
            url: 'http://api.kombinatdelikat.de/parse'
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
                    content: '<div id="marker-1" class="marker uber"><div><h2>Fensterverkauf</h2><h3>Sebnitzer Str. 11,<br>01099 Dresden</h3><p>Nach Angebot,<br>immer Freitags<br><strong>18:00 - 20:00 Uhr</strong></p></div></div>',
                    shadow: false,
                    flat: true
                }
            },
            {
                id: 2,
                title: 'Sankt Pauli Tagesbar und Restaurant',
                coords: {
                    latitude: 51.075027,
                    longitude: 13.750089
                },
                options: {
                    content: '<div id="marker-2" class="marker"><div><h2>Sankt Pauli</h2><h3>Tannenstraße 56,<br>01097 Dresden</h3><p>Pastrami-Sandwich</p></div></div>',
                    shadow: false,
                    flat: true
                }
            },
            {
                id: 3,
                title: 'Kochbox',
                coords: {
                    latitude: 51.066749,
                    longitude: 13.754184
                },
                options: {
                    content: '<div id="marker-3" class="marker"><div><h2>Kochbox</h2><h3>Görlitzer Straße 4,<br>01099 Dresden</h3><p>Wechselnde Auswahl an Bratwurst</p></div></div>',
                    shadow: false,
                    flat: true
                }
            },
            {
                id: 4,
                title: 'Little Creatures',
                coords: {
                    latitude: 51.066681,
                    longitude: 13.752910
                },
                options: {
                    content: '<div id="marker-4" class="marker"><div><h2>Little Creatures</h2><h3>Louisenstraße 45,<br>01099 Dresden</h3><p>Soleier</p></div></div>',
                    shadow: false,
                    flat: true
                }
            },
            {
                id: 5,
                title: 'Bar Holda',
                coords: {
                    latitude: 51.064006,
                    longitude: 13.756392
                },
                options: {
                    content: '<div id="marker-5" class="marker"><div><h2>Bar Holda</h2><h3>Martin-Luther-Platz 4,<br>01099 Dresden</h3><p>Königsberger Wurst</p></div></div>',
                    shadow: false,
                    flat: true
                }
            }
        ],
        googlemaps: {
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
                            "color": "#ffffff"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#333333"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]
        }
    });
