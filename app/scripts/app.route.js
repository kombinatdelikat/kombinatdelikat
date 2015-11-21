'use strict';

/**
 * @ngdoc overview
 * @name de.kombinatdelikat.www
 * @description
 * # de.kombinatdelikat.www
 *
 * Route of the application.
 */
angular
    .module('de.kombinatdelikat.www')
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
                controller: 'NewsCtrl',
                resolve: {
                    Posts: function (FacebookService) {
                        return FacebookService.getPosts();
                    }
                }
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
