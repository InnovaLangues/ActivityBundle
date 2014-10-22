(function () {
    'use strict';

    angular.module('ActivitySequence').controller('ActivitySequenceEditController', [
        '$scope', 
        'LoaderService',
        'ActivitySequenceService',
        'ActivityService',
        function ($scope, LoaderService, ActivitySequenceService, ActivityService) {
            $scope.activitySequence = ActivityEditorApp.activitySequence;
            $scope.requestCount = LoaderService.getRequestCount();
            $scope.currentActivity = ActivityService.getCurrentActivity();

            ActivitySequenceService.setActivitySequence(ActivityEditorApp.activitySequence);

            $scope.addActivity = function () {
                var promiseActivity = ActivitySequenceService.addActivity();
                promiseActivity.then(function(activity) {
                        $scope.showActivity(activity.id); 
                });
            };

            $scope.showActivity = function (activityId) {
                $scope.currentActivity = ActivityService.setCurrentActivity(activityId);
            };

            $scope.deleteActivity = function (activityId) {
                var promiseActivityId = ActivitySequenceService.deleteActivity(activityId);
                promiseActivityId.then(function(activityId) {
                    $scope.currentActivity = ActivityService.setCurrentActivity(null);
                    ActivitySequenceService.spliceActivity(activityId, $scope.activitySequence.activities);
                });
            };
        }
    ]);
})();