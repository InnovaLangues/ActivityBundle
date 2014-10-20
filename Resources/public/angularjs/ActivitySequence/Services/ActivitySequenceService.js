(function () {
    'use strict';

    angular.module('ActivitySequence').factory('ActivitySequenceService', ['$http', function ($http) {

        return {
            addActivity: function(activitySequenceId) {
                alert("test "+activitySequenceId);
                $http.get(Routing.generate('activity_sequence_add_activity', { activitySequenceId: activitySequenceId }))
                .success(function (data) {
                    alert("ok "+activitySequenceId);
                });
            },
        };  
    }]);
})();