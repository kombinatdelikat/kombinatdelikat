'use strict';

/**
 * @ngdoc overview
 * @name dekombinatdelikatwww
 * @description
 * # dekombinatdelikatwww
 *
 * Route of the application.
 */
angular
    .module('dekombinatdelikatwww')
    .config(function ($locationProvider, $stateProvider, $urlRouterProvider) {
        // Disable hash in url
        $locationProvider.html5Mode(true);

        // For any unmatched url, redirect to /main
        $urlRouterProvider.otherwise('/aktuelles');

        // Now set up the states
        $stateProvider
            .state('news', {
                url: '/aktuelles',
                templateUrl: 'views/news.html',
                controller: 'NewsCtrl'
            })
            .state('locations', {
                url: '/probieren',
                templateUrl: 'views/locations.html',
                controller: 'LocationsCtrl'
            })
            .state('about', {
                url: '/praedikat',
                templateUrl: 'views/about.html',
                controller: 'AboutCtrl'
            })
            .state('order', {
                url: '/bestellung',
                templateUrl: 'views/order.html',
                controller: 'OrderCtrl'
            })
            .state('contact', {
                url: '/kontakt',
                templateUrl: 'views/contact.html',
                controller: 'ContactCtrl'
            })
            .state('imprint', {
                url: '/impressum',
                templateUrl: 'views/imprint.html',
                controller: 'ImprintCtrl'
            })
            .state('privacy', {
                url: '/datenschutz',
                templateUrl: 'views/privacy.html',
                controller: 'PrivacyCtrl'
            });
    });
