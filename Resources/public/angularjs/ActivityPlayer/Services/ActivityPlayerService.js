(function () {
    'use strict';

    angular.module('ActivityPlayer').factory('ActivityPlayerService', [
        '$http',
        '$q',
        'LoaderService',
        function ($http, $q, LoaderService) {
            return {
                type: function (activityId, type) {
                    LoaderService.startRequest();
                    
                    var deferred = $q.defer();
                    $http
                        .post(Routing.generate('innova_activity_type', {
                            activityId: activityId,
                            typeAvailableId: type.id
                        }))
                        .success(function (response) {
                            LoaderService.endRequest();

                            deferred.resolve(response.data);
                        })
                        .error(function(response) {
                            LoaderService.endRequest();

                            deferred.reject(response);
                        });

                    return deferred.promise;
                }
            };
        }
    ]);
})();