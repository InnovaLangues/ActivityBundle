/**
 * Doc sur les promise et autre defer : http://www.frangular.com/2012/12/api-promise-angularjs.html
 * workspaceId : variable définie dans le main.htlm.twig que l'on peut utiliser dans tout le code
 */
(function () {
    'use strict';

    angular.module('ActivitySequence').factory('ActivitySequenceService', [
        '$http',
        '$filter',
        '$q',
        'LoaderService',
        function ($http, $filter, $q, LoaderService) {
            return {
                update: function (activity) {
                    $http({
                        method: 'PUT',
                        url: Routing.generate('innova_activity_sequence_update', { activitySequenceId : activity.id }),
                        data: data
                    })
                    .success(function (data) {

                    })
                    .error(function(data, status) {
//                        AlertFactory.addAlert('danger', 'Error while adding activity.');
                    });
                },

                addActivity: function (sequence) {
                    var deferred = $q.defer();

                    LoaderService.startRequest();

                    $http
                        .post(Routing.generate('innova_activity_sequence_add_activity', {
                            activitySequenceId: sequence.id
                        }))
                        .success(function (activity) {
                            sequence.activities.push(activity);
                            LoaderService.endRequest();

                            deferred.resolve(activity);
                        });

                    return deferred.promise;
                },

                removeActivity: function (sequence, activity) {
                    var deferred = $q.defer();

                    LoaderService.startRequest();

                    $http
                        .post(Routing.generate('innova_activity_sequence_remove_activity', {
                            activitySequenceId: sequence.id,
                            activityId:         activity.id
                        }))
                        .success(function (response) {
                            if (response.status && 'OK' === status) {
                                // Remove activity from sequence
                                if (false !== sequence.activities.indexOf(activity)) {
                                    sequence.activities.slice(sequence.activities.indexOf(activity), 1);
                                }
                            }

                            LoaderService.endRequest();

                            deferred.resolve(response);
                        });

                    return deferred.promise;
                }
            };
        }
    ]);
})();