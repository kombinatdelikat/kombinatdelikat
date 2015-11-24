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
        $urlRouterProvider.otherwise('/aktuelles.html');

        // Now set up the states
        $stateProvider
            .state('news', {
                url: '/aktuelles.html',
                templateUrl: 'views/news.html',
                controller: 'NewsCtrl',
                resolve: {
                    Posts: function (FacebookService) {
                        return FacebookService.getPosts();
                    }
                }
            })
            .state('locations', {
                url: '/probieren.html',
                templateUrl: 'views/locations.html',
                controller: 'LocationsCtrl'
            })
            .state('about', {
                url: '/praedikat.html',
                templateUrl: 'views/about.html',
                controller: 'AboutCtrl'
            })
            .state('order', {
                url: '/bestellung.html',
                templateUrl: 'views/order.html',
                controller: 'OrderCtrl'
            })
            .state('contact', {
                url: '/kontakt.html',
                templateUrl: 'views/contact.html',
                controller: 'ContactCtrl'
            })
            .state('imprint', {
                url: '/impressum.html',
                templateUrl: 'views/imprint.html',
                controller: 'ImprintCtrl'
            })
            .state('privacy', {
                url: '/datenschutz.html',
                templateUrl: 'views/privacy.html',
                controller: 'PrivacyCtrl'
            });
    });
