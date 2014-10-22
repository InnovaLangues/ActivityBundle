(function () {
    'use strict';

    angular.module('ActivitySequence').factory('ActivitySequenceService', [
        '$http',
        '$q',
        'LoaderService',
        'ActivityService',
        function ($http, $q, LoaderService, ActivityService) {
            var activitySequence = null;

            return {
                setActivitySequence: function(data) {
                    activitySequence = data;

                    return this;
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
                        deferred.resolve(activityId);
                        LoaderService.endRequest();
                    });
                    
                    return deferred.promise;
                },  

                spliceActivity: function(activityId, activities) {
                    for (var i = activities.length - 1; i >= 0; i--) {
                        if (activities[i].id == activityId) {
                            activities.splice(i,1);
                            return activities;
                        };
                    };
                }

        };  
    }]);
})();