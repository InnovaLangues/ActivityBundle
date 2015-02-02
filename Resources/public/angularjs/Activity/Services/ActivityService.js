(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
        '$http',
        '$q',
        'LoaderService',
        function ($http, $q, LoaderService) {
            return {
                create: function (sequence, type) {
                    LoaderService.startRequest();

                    var deferred = $q.defer();
                    $http
                        .post(Routing.generate('innova_activity_create', {
                            activitySequenceId: sequence.id,
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
                },

                update: function (activity) {
                    LoaderService.startRequest();

                    function Activity (activity) {
                        var innova_activity = {
                            name:activity.name,
                            description:activity.description
                        };
        
                        return innova_activity;
                    }
                    var newActivity = new Activity(activity);

                    var deferred = $q.defer();
                    $http
                        .put(
                            Routing.generate('innova_activity_update', {activityId : activity.id}), 
                            {
                                innova_activity: newActivity 
                            }
                        )
                        .success(function (response) {
                            LoaderService.endRequest();

                            deferred.resolve(response.data);
                        })
                        .error(function(response) {
                            LoaderService.endRequest();

                            deferred.reject(response);
                        });

                    return deferred.promise;
                },

                delete: function (activity) {
                    LoaderService.startRequest();

                    var deferred = $q.defer();
                    $http
                        .delete(Routing.generate('innova_activity_delete', {
                            activityId: activity.id
                        }))
                        .success(function (response) {
                            LoaderService.endRequest();

                            deferred.resolve(response);
                        });

                    return deferred.promise;
                }
            };
        }
    ]);
})();