/**
 * ActivityAvailable service
 */
(function () {
    'use strict';

    angular.module('ActivityType').factory('ActivityAvailableService', [
        '$http',
        '$q',
        'LoaderService',
        function ($http, $q, LoaderService) {
            var availableTypes = [];

            return {
                all: function () {
                    if (availableTypes.length === 0) {
                        // List of available types have not been loaded
                        LoaderService.startRequest();

                        var deferred = $q.defer();
                        $http
                            .get(Routing.generate('innova_activity_available_list'))
                            .then(function (response) {
                                availableTypes = response.data;

                                LoaderService.endRequest();

                                deferred.resolve(availableTypes);
                            },
                            function (response) {
                                deferred.reject([]);
                            });

                        return deferred.promise;
                    } else {
                        // Types already loaded once, return the local list
                        return availableTypes;
                    }
                }
            }
        }
    ]);
})();