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
    .config(['$locationProvider', '$stateProvider', '$urlRouterProvider', function ($locationProvider, $stateProvider, $urlRouterProvider) {
        // Disable hash in url
        $locationProvider.html5Mode(true);

        // For any unmatched url, redirect to /main
        $urlRouterProvider.otherwise('/aktuelles');

        // Now set up the states
        $stateProvider
            .state('main', {
                abstract: true,
                templateUrl: 'views/main.html',
                controller: 'MainCtrl'
            })
            .state('news', {
                parent: 'main',
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
                parent: 'main',
                url: '/probieren',
                templateUrl: 'views/locations.html',
                controller: 'LocationsCtrl'
            })
            .state('about', {
                parent: 'main',
                url: '/praedikat',
                templateUrl: 'views/about.html',
                controller: 'AboutCtrl'
            })
            .state('order', {
                parent: 'main',
                url: '/bestellung',
                templateUrl: 'views/order.html',
                controller: 'OrderCtrl'
            })
            .state('contact', {
                parent: 'main',
                url: '/kontakt',
                templateUrl: 'views/contact.html',
                controller: 'ContactCtrl'
            })
            .state('imprint', {
                parent: 'main',
                url: '/impressum',
                templateUrl: 'views/imprint.html',
                controller: 'ImprintCtrl'
            })
            .state('privacy', {
                parent: 'main',
                url: '/datenschutz',
                templateUrl: 'views/privacy.html',
                controller: 'PrivacyCtrl'
            });
    }]);
