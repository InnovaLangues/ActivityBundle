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
                /**
                 * Update the ActivitySequence
                 * @param sequence
                 */
                update: function (sequence) {
                    var deferred = $q.defer();

                    LoaderService.startRequest();

                    $http
                        .put(Routing.generate('innova_activity_sequence_update', { activitySequenceId : sequence.id }, sequence))
                        .success(function (response) {
                            deferred.resolve(response);
                        })
                        .error(function(data, status) {
                            AlertFactory.addAlert('danger', 'Error while adding activity.');
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
                        })
                        .error(function (response) {
                            LoaderService.endRequest();

                            deferred.reject(response);
                        });

                    return deferred.promise;
                },

                updateActivity: function (sequence, activity) {
                    // new url = innova_activity_sequence_update_activity
                    $http
                        .put(Routing.generate('update_activity', {
                            activitySequenceId: sequence.id,
                            activityId : activity.id
                        }, activity))
                        .success(function (response) {
                            // Réinjecter les données Angular/SF
                        })
                        .error(function(response) {
                            // AlertFactory.addAlert('danger', 'Error while adding activity.');
                        });
                },

                removeActivity: function (sequence, activity) {
                    var deferred = $q.defer();

                    LoaderService.startRequest();

                    $http
                        .delete(Routing.generate('innova_activity_sequence_remove_activity', {
                            activitySequenceId: sequence.id,
                            activityId:         activity.id
                        }))
                        .success(function (response) {
                            if (response.status && 'OK' === response.status) {
                                // Remove activity from sequence
                                if (false !== sequence.activities.indexOf(activity)) {
                                    sequence.activities.splice(sequence.activities.indexOf(activity), 1);
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