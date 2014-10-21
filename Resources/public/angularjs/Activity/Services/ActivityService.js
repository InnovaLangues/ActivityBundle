(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
        '$filter', 
        function ($filter) {
            var currentActivity = null;

            return {
                getCurrentActivity: function(){
                    
                    return currentActivity;
                },

                setCurrentActivity: function(activityId) {
                    currentActivity = $filter('filter')(ActivityEditorApp.activitySequence.activities, {
                                                    id: activityId
                                                })[0];
                    
                    return currentActivity;
                },

            };  
    }]);
})();
