(function () {
    'use strict';

    angular.module('ActivityType').factory('ChoiceTypeService', [
        '$http',
        '$q',
        'LoaderService',
        function ($http, $q, LoaderService) {
            return {
                update: function (activityType) {
                    LoaderService.startRequest();

                    function ActivityType (activityType) {
                        var innova_activity_type = {
                            choices: []
                        };
        
                        for (var choice in activityType.choices) {
                            if (activityType.choices.hasOwnProperty(choice)) {
                                innova_activity_type.choices.push({
                                    media:activityType.choices[choice].media
                                });
                            }
                        }
        
                        return innova_activity_type;
                    }
                    var newActivityType = new ActivityType(activityType);

                    var deferred = $q.defer();
                    $http
                        .put(
                            Routing.generate('innova_activity_type_update', {activityTypeId : activityType.id}), 
                            {
                                innova_activity_type: newActivityType 
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
                
                updateChoicesOrder: function (activityType) {
                    var deferred = $q.defer();
                    var order = activityType.choices.map(function (i) {
                        return i.id;
                    });

                    LoaderService.startRequest();

                    $http
                        .put(Routing.generate('innova_activity_type_update_order', { activitySequenceId : activityType.id, order: order  }, activityType))
                        .success(function (response) {
                            LoaderService.endRequest();

                            if (response && response.activities) {
                                // Update activities position
                                for (var i = 0; i < activityType.choices.length; i++) {
                                    var choice = activityType.choices[i];
                                    var updatedChoice = $filter('filter')(response.choices, {id: choice.id })[0];
                                    choice.position = updatedChoice.position;
                                }
                            }

                            deferred.resolve(response);
                        })
                        .error(function(data, status) {
                            AlertFactory.addAlert('danger', 'Error while updating order.');
                            LoaderService.endRequest();
                        });

                    return deferred.promise;
                }
            };
        }
    ]);
})();