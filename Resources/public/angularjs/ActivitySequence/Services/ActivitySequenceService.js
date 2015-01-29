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
                            LoaderService.endRequest();

                            deferred.resolve(response);
                        })
                        .error(function(data, status) {
                            AlertFactory.addAlert('danger', 'Error while adding activity.');

                            LoaderService.endRequest();
                        });

                    return deferred.promise;
                },

                addActivity: function (sequence) {
                    var deferred = $q.defer();

                    LoaderService.startRequest();

                    $http
                        .post(Routing.generate('innova_activity_sequence_add_activity', {
                            activitySequenceId: sequence.id
                        }))
                        .success(function (response) {
                            sequence.activities.push(response.data);
                            LoaderService.endRequest();

                            deferred.resolve(response.data);
                        })
                        .error(function (response) {
                            LoaderService.endRequest();

                            deferred.reject(response);
                        });

                    return deferred.promise;
                },

                updateActivitiesOrder: function (sequence) {
                    var deferred = $q.defer();
                    var order = sequence.activities.map(function (i) {
                        return i.id;
                    });

                    LoaderService.startRequest();

                    $http
                        .put(Routing.generate('innova_activity_sequence_update_order', { activitySequenceId : sequence.id, order: order  }, sequence))
                        .success(function (response) {
                            LoaderService.endRequest();

                            if (response && response.activities) {
                                // Update activities position
                                for (var i = 0; i < sequence.activities.length; i++) {
                                    var activity = sequence.activities[i];
                                    var updatedActivity = $filter('filter')(response.activities, {id: activity.id })[0];
                                    activity.position = updatedActivity.position;
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