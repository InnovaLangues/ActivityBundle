(function () {
    'use strict';

    angular.module('ActivitySequence').controller('ActivitySequenceEditController', [
        '$scope',
        'LoaderService',
        'ActivitySequenceService',

        function ($scope, LoaderService, ActivitySequenceService) {
            $scope.activitySequence = ActivityEditorApp.activitySequence;
            $scope.requestCount = LoaderService.getRequestCount();

            $scope.currentActivity = null;
            if ($scope.activitySequence.activities && $scope.activitySequence.length !== 0) {
                $scope.currentActivity = $scope.activitySequence.activities[0];
            }

            ActivitySequenceService.setActivitySequence(ActivityEditorApp.activitySequence);

            $scope.addActivity = function () {
                var promiseActivity = ActivitySequenceService.addActivity();
                promiseActivity.then(function(activity) {
                    $scope.currentActivity = activity;
                });
            };

            $scope.showActivity = function (activity) {
                $scope.currentActivity = activity;

                console.log($scope.currentActivity);
            };

            $scope.deleteActivity = function (activityId) {
                var promise = ActivitySequenceService.deleteActivity(activityId);
                promise.then(function(activitySequence) {
                    $scope.activitySequence = ActivitySequenceService.setActivitySequence(activitySequence);
                });
            };

            $scope.sortableOptions = {
                stop: function(e, ui) {
                    var id = $scope.activitySequence.id;
                    var order = $scope.activitySequence.activities.map(function(i){return i.id;});

                    var promise = ActivitySequenceService.saveOrder(id, order);
                    promise.then(function(activitySequence) {
                        $scope.activitySequence = ActivitySequenceService.setActivitySequence(activitySequence);
                    });
                }
            };
        }
    ]);
})();

