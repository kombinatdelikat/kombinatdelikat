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
                url: '/orte',
                templateUrl: 'views/locations.html',
                controller: 'LocationsCtrl'
            })
            .state('about', {
                url: '/ueber',
                templateUrl: 'views/about.html',
                controller: 'AboutCtrl'
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
            });
    });
