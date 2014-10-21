(function () {
    'use strict';

    angular.module('ActivitySequence').controller('ActivitySequenceEditController', [
        '$scope', 
        'LoaderService',
        'ActivitySequenceService', 
        function ($scope, LoaderService, ActivitySequenceService) {
            $scope.activitySequence = ActivityEditorApp.activitySequence;
            $scope.requestCount = LoaderService.getRequestCount();

            ActivitySequenceService.setActivitySequence(ActivityEditorApp.activitySequence);

            $scope.addActivity = function () {
                ActivitySequenceService.addActivity();
            };

        }
    ]);
})();