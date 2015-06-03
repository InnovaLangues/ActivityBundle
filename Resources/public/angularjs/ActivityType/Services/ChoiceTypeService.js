(function () {
    'use strict';

    angular.module('ActivityType').factory('ChoiceTypeService', [
        '$http',
        '$q',
        'LoaderService',
        function ($http, $q, LoaderService) {
            return {
               
                getMediaResourceSegments: function (activityTypeId, nodeId) {
                    LoaderService.startRequest();
                    var deferred = $q.defer();
                    $http.put(
                            Routing.generate('activity_get_mediaresource_segments', {activityId: activityTypeId, nodeId: nodeId})                            
                    ).success(function (response) {
                        LoaderService.endRequest();
                        deferred.resolve(response.data);
                    }).error(function (response) {
                        LoaderService.endRequest();
                        deferred.reject(response);
                    });

                    return deferred.promise;
                }/*,
                getMediaResourceFile: function (activityTypeId, nodeId) {
                    LoaderService.startRequest();
                    var deferred = $q.defer();
                    $http.put(
                            Routing.generate('activity_get_mediaresource_file', {activityId: activityTypeId, nodeId: nodeId})                            
                    ).success(function (response) {
                        LoaderService.endRequest();
                        deferred.resolve(response.data);
                    }).error(function (response) {
                        LoaderService.endRequest();
                        deferred.reject(response);
                    });

                    return deferred.promise;
                }*/
            };
        }
    ]);
})();