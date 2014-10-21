(function () {
    'use strict';

    angular.module('ActivitySequence').factory('ActivitySequenceService', ['$http', 'LoaderService', function ($http, LoaderService) {
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
                LoaderService.startRequest();
                $http.get(Routing.generate('activity_sequence_add_activity', { activitySequenceId: activitySequence.id }))
                .success(function (data) {
                    activitySequence.activities.push(data.activity);
                    LoaderService.endRequest();
                });
            }
        };  
    }]);
})();