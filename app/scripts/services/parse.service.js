'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.service:ParseService
 * @description
 * # ParseService
 * Parse API service interface
 */
angular
    .module('de.kombinatdelikat.www')
    .factory('ParseFactory', function ($q, $http, $log, config) {
        return {
            getPosts: function () {
                var deferred = $q.defer();

                $http
                    .get(config.parse.url + '/locations')
                    .then(
                        function (res) {
                            deferred.resolve(res.data.data);
                        },
                        function (res) {
                            deferred.reject(res.data.error);
                        }
                    );

                return deferred.promise;
            }
        };
    })
    .service('ParseService', function (ParseFactory) {
        return ParseFactory;
    });
