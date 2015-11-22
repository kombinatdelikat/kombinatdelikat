'use strict';

/**
 * @ngdoc function
 * @name de.kombinatdelikat.www.service:FacebookService
 * @description
 * # FacebookService
 * Facebook API service interface
 */
angular
    .module('de.kombinatdelikat.www')
    .factory('FacebookFactory', function ($q, $http, $log, config) {
        return {
            getPosts: function () {
                var deferred = $q.defer();

                $http
                    .get(config.facebook.url + '/facebook/posts')
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
    .service('FacebookService', function (FacebookFactory) {
        return FacebookFactory;
    });
