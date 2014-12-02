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

                addActivity: function() {
                    var deferred = $q.defer();
                    deferred.notify();
                    LoaderService.startRequest();
                    $http.get(Routing.generate('activity_sequence_add_activity', { activitySequenceId: activitySequence.id }))
                    .success(function (data) {
                        deferred.resolve(data.activity);
                        activitySequence.activities.push(data.activity);
                        LoaderService.endRequest();
                    });

                    return deferred.promise;
                },

                deleteActivity: function(activityId) {
                    var deferred = $q.defer();
                    deferred.notify();
                    LoaderService.startRequest();

                    $http.delete(Routing.generate('delete_activity', { activityId: activityId }))
                    .success(function (data) {
                        deferred.resolve(JSON.parse(data.activitySequence));
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