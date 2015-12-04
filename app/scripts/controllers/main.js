'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.controller:MainCtrl
 * @description
 * # NewsCtrl
 * Main controller of the de.kombinatdelikat.www app
 */
angular
    .module('de.kombinatdelikat.www')
    .controller('MainCtrl', ['$rootScope', '$state', function ($rootScope, $state) {
        var setBodyClass = function (name) {
            angular
                .element(document.querySelector('body'))
                .attr('data-state', name);
        };

        $rootScope.$on('$stateChangeSuccess', function (event, toState) {
            setBodyClass(toState.name);
        });

        setBodyClass($state.current.name);
    }]);
