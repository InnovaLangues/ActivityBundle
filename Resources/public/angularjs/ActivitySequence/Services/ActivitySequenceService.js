(function () {
    'use strict';

    angular.module('ActivitySequence').factory('ActivitySequenceService', [
        '$http',
        '$q',
        '$filter',
        'LoaderService',
        function ($http, $q, $filter, LoaderService) {
            var activitySequence = null;
            var currentActivity = null;

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
                        var activitySequence = JSON.parse(data.activitySequence);
                        LoaderService.endRequest();
                    });
                    
                    return deferred.promise;
                },

                getCurrentActivity: function(){
                    
                    return currentActivity;
                },

                setCurrentActivity: function(activityId) {
                    currentActivity = $filter('filter')(activitySequence.activities, {id: activityId})[0];
                    
                    return currentActivity;
                },

                clearCurrentActivity: function(){
                    currentActivity = null;

                    return currentActivity;
                }
        };  
    }]);
})();