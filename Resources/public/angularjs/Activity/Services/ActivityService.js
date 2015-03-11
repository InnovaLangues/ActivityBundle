(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
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
                },
                update: function (activity) {
                    LoaderService.startRequest();

                    function Activity (activity) {
                        var innova_activity = {
                            name:activity.name,
                            description:activity.description,
                            instructions: [],
                            type: {
                                choices: []
                            }
                        };
        
                        for (var instruction in activity.instructions) {
                            if (activity.instructions.hasOwnProperty(instruction)) {
                                innova_activity.instructions.push({
                                    media:activity.instructions[instruction].media
                                });
                            }
                        }
        
                        for (var choice in activity.type.choices) {
                            if (activity.type.choices.hasOwnProperty(choice)) {
                                innova_activity.type.choices.push({
                                    media: activity.type.choices[choice].media,
                                    correctAnswer: activity.type.choices[choice].correctAnswer,
                                    position: activity.type.choices[choice].position
                                });
                            }
                        }
        
                        return innova_activity;
                    }
                    var newActivity = new Activity(activity);
                        
                    console.log(newActivity);

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
                }
            };
        }
    ]);
})();