/**
 * Doc sur les promise et autre defer : http://www.frangular.com/2012/12/api-promise-angularjs.html
 */
(function () {
    'use strict';

    angular.module('ActivitySequence').factory('ActivitySequenceService', [
        '$http',
        '$q',
        '$filter',
        'LoaderService',
        function ($http, $q, $filter, LoaderService) {
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
                    deferred.notify();
                    LoaderService.startRequest();
                    $http.get(Routing.generate('create_activity_sequence', { activitySequenceId: activitySequence.id }))
                    .success(function (data) {
                        deferred.resolve(data.activity);
                        activitySequence.activities.push(data.activity);
                        LoaderService.endRequest();
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
                    var deferred = $q.defer();
                    deferred.notify();
                    LoaderService.startRequest();

                    $http.delete(Routing.generate('delete_activity_sequence', { activityId: activityId }))
                    .success(function (data) {
                        deferred.resolve(JSON.parse(data.activitySequence));
                        LoaderService.endRequest();
                    });

                    return deferred.promise;
                },

                // TODO : remove when create() is ok
                addActivity: function() {
                    var deferred = $q.defer();
                    deferred.notify();
                    LoaderService.startRequest();
                    $http.get(Routing.generate('cativity_sequence_add_activity', { activitySequenceId: activitySequence.id }))
                    .success(function (data) {
                        deferred.resolve(data.activity);
                        activitySequence.activities.push(data.activity);
                        LoaderService.endRequest();
                    });

                    return deferred.promise;
                },

                saveOrder: function(id, order){
                   LoaderService.startRequest();
                   var deferred = $q.defer();
                    deferred.notify();

                   $http.post(Routing.generate('order_activities', { activitySequenceId: id, order: JSON.stringify(order) }))
                    .success(function (data) {
                        deferred.resolve(JSON.parse(data.activitySequence));
                        LoaderService.endRequest();
                    });

                   return deferred.promise;
                }
        };
    }]);
})();