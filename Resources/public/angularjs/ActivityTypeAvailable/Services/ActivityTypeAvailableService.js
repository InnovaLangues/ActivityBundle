/**
 * ActivityTypeAvailable service
 */
(function () {
    'use strict';

    angular.module('ActivityType').factory('ActivityTypeAvailableService', [
        '$http',
        'LoaderService',
        function ($http, LoaderService) {
            var availableTypes = [];

            return {
                getAvailable: function () {
                    if (availableTypes.length === 0) {
                        // List of available types have not been loaded
                        LoaderService.startRequest();
                        $http
                            .get(Routing.generate('innova_activity_type_available_list'))
                            .success(function (loadedTypes) {
                                availableTypes = loadedTypes;

                                LoaderService.endRequest();
                            });
                    } else {
                        // Types already loaded once, return the local list
                        return availableTypes;
                    }
                }
            }
        }
    ]);
})();