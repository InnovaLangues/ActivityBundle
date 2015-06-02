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
                            numTries:activity.numTries,
                            questions: [],
                            mediaType:activity.mediaType.id,
                            contents: [],
                            instructions: [],
                            complementaryInfos: [],
                            functionalInstructions: [],
                            type: {
                                choices: [],
                                randomlyOrdered: activity.type.randomlyOrdered
                            }
                        };
        
                        for (var question in activity.questions) {
                            if (activity.questions.hasOwnProperty(question)) {
                                innova_activity.questions.push({
                                    media:activity.questions[question].media,
                                    position: activity.questions[question].position
                                });
                            }
                        }
        
                        for (var complementaryInfo in activity.complementaryInfos) {
                            if (activity.complementaryInfos.hasOwnProperty(complementaryInfo)) {
                                innova_activity.complementaryInfos.push({
                                    media:activity.complementaryInfos[complementaryInfo].media,
                                    position: activity.complementaryInfos[complementaryInfo].position
                                });
                            }
                        }
        
                        for (var instruction in activity.instructions) {
                            if (activity.instructions.hasOwnProperty(instruction)) {
                                innova_activity.instructions.push({
                                    media:activity.instructions[instruction].media,
                                    position: activity.instructions[instruction].position
                                });
                            }
                        }
        
                        for (var functionalInstruction in activity.functionalInstructions) {
                            if (activity.functionalInstructions.hasOwnProperty(functionalInstruction)) {
                                innova_activity.functionalInstructions.push({
                                    media:activity.functionalInstructions[functionalInstruction].media,
                                    position: activity.functionalInstructions[functionalInstruction].position
                                });
                            }
                        }
        
                        for (var content in activity.contents) {
                            if (activity.contents.hasOwnProperty(content)) {
                                innova_activity.contents.push({
                                    media:activity.contents[content].media,
                                    position: activity.contents[content].position
                                });
                            }
                        }
        
                        for (var choice in activity.type.choices) {
                            if (activity.type.choices.hasOwnProperty(choice)) {
                                
                                var c = {
                                    media: activity.type.choices[choice].media,
                                    correctAnswer: activity.type.choices[choice].correctAnswer,
                                    position: activity.type.choices[choice].position
                                };
                                
                                if(activity.type.choices[choice].resource && Object.keys(activity.type.choices[choice].resource).length !== 0){
                                    c.resource = activity.type.choices[choice].resource;
                                }
                                innova_activity.type.choices.push(c);
                            }
                        }
        
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
                }
            };
        }
    ]);
})();