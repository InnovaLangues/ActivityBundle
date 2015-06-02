(function () {
    'use strict';

    angular.module('ActivityType').factory('ChoiceTypeService', [
        '$http',
        '$q',
        'LoaderService',
        function ($http, $q, LoaderService) {
            return {
                // UNUSED ??
                update: function (activityType) {
                    LoaderService.startRequest();

                    function ActivityType(activityType) {
                        var innova_activity_type = {
                            choices: []
                        };

                        for (var choice in activityType.choices) {
                            if (activityType.choices.hasOwnProperty(choice)) {
                                innova_activity_type.choices.push({
                                    media: activityType.choices[choice].media
                                });
                            }
                        }

                        return innova_activity_type;
                    }
                    var newActivityType = new ActivityType(activityType);

                    var deferred = $q.defer();
                    $http
                            .put(
                                    Routing.generate('innova_activity_type_update', {activityTypeId: activityType.id}),
                                    {
                                        innova_activity_type: newActivityType
                                    }
                            )
                            .success(function (response) {
                                LoaderService.endRequest();

                                deferred.resolve(response.data);
                            })
                            .error(function (response) {
                                LoaderService.endRequest();

                                deferred.reject(response);
                            });

                    return deferred.promise;
                }
            };
        }
    ]);
})();