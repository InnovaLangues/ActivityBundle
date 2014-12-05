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
                        url: Routing.generate('update_activity_sequence', { activitySequenceId : activity.id }),
                        data: data
                    })
                    .success(function (data) {

                    })
                    .error(function(data, status) {
//                        AlertFactory.addAlert('danger', 'Error while adding activity.');
                    });
                },

                addActivity: function (sequence) {
                    console.log(sequence.id);

                    /* Move code into Activity service and then call Activity.create();*/

                    var deferred = $q.defer();

                    LoaderService.startRequest();
                    $http
                        .post(Routing.generate('innova_activity_sequence_add_activity', {
                            workspaceId: ActivityEditorApp.workspaceId,
                            activitySequenceId: sequence.id
                        }))
                        .success(function (activity) {
                            sequence.activities.push(activity);
                            LoaderService.endRequest();

                            deferred.resolve(activity);
                        });

                    return deferred.promise;
                },

                saveOrder: function (id, order){
                   LoaderService.startRequest();

                   $http.post(Routing.generate('order_activities', { activitySequenceId: id, order: JSON.stringify(order) }))
                   .success(function (data) {
                       LoaderService.endRequest();
                   });
                }
            };
        }
    ]);
})();