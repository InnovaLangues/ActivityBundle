(function () {
    'use strict';

    angular.module('ActivitySequence').controller('ActivitySequenceEditController', [
        '$scope',
        'LoaderService',
        'ActivitySequenceService',

        function ($scope, LoaderService, ActivitySequenceService) {
            $scope.activitySequence = ActivityEditorApp.activitySequence;
            $scope.requestCount = LoaderService.getRequestCount();
            $scope.currentActivity = ActivitySequenceService.getCurrentActivity();

            ActivitySequenceService.setActivitySequence(ActivityEditorApp.activitySequence);

            $scope.addActivity = function () {
                var promiseActivity = ActivitySequenceService.addActivity();
                promiseActivity.then(function(activity) {
                        $scope.currentActivity = ActivitySequenceService.setCurrentActivity(activity.id);
                });
            };

            $scope.showActivity = function (activityId) {
                $scope.currentActivity = ActivitySequenceService.setCurrentActivity(activityId);
            };

            $scope.deleteActivity = function (activityId) {
                var promise = ActivitySequenceService.deleteActivity(activityId);
                promise.then(function(activitySequence) {
                    $scope.activitySequence = ActivitySequenceService.setActivitySequence(activitySequence);
                    $scope.currentActivity = ActivitySequenceService.clearCurrentActivity();
                });
            };

            $scope.sortableOptions = {
                stop: function(e, ui) {
                    var id = $scope.activitySequence.id;
                    var order = $scope.activitySequence.activities.map(function(i){return i.id;});

                    var promise = ActivitySequenceService.saveOrder(id, order);
                    promise.then(function(activitySequence) {
                        $scope.activitySequence = ActivitySequenceService.setActivitySequence(activitySequence);
                        $scope.currentActivity = ActivitySequenceService.setCurrentActivity(ActivitySequenceService.getCurrentActivity().id);
                    });
                }
            };
        }
    ]);
})();

