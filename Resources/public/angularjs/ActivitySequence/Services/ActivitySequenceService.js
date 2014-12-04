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
            var activitySequence = null;

            return {
                setActivitySequence: function(data) {
                    activitySequence = data;

                    return activitySequence;
                },

                getActivitySequence: function() {

                    return activitySequence;
                },

                create: function() {
                    var deferred = $q.defer();

                    console.log('create activity via service');
                    LoaderService.startRequest();
                    $http.get(Routing.generate('create_activity_sequence', { workspaceId: ActivityEditorApp.workspaceId, activitySequenceId: activitySequence.id }))
                    .success(function (data) {
                        activitySequence.activities.push(data.activity);

                        deferred.resolve(data);

                        LoaderService.endRequest();
                    })
                    .error(function () {
                        deferred.reject('error');
                    });

                    return deferred.promise;
                },

                update: function (activity) {
                    $http({
                        method: 'PUT',
                        url: Routing.generate('update_activity_sequence', {activitySequenceId : activity.id}),
                        data: data
                    })
                    .success(function (data) {

                    })
                    .error(function(data, status) {
//                        AlertFactory.addAlert('danger', 'Error while adding activity.');
                    });
                },

                delete: function(activityId) {
                    LoaderService.startRequest();

                    $http.delete(Routing.generate('delete_activity_sequence', { activityId: activityId }))
                    .success(function (data) {
                        LoaderService.endRequest();
                    });
                },

                // TODO : remove when create() is ok
                addActivity: function() {
                    /*Activity.create();*/

                    console.log('add activity via addActivity');
                    LoaderService.startRequest();
                    $http.get(Routing.generate('create_activity', { activitySequenceId: activitySequence.id }))
                    .success(function (data) {
                        activitySequence.activities.push(data.activity);
                        LoaderService.endRequest();
                    });
                },

                saveOrder: function(id, order){
                   LoaderService.startRequest();

                   $http.post(Routing.generate('order_activities', { activitySequenceId: id, order: JSON.stringify(order) }))
                   .success(function (data) {
                       LoaderService.endRequest();
                   });
                }
        };
    }]);
})();