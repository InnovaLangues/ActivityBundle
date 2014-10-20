(function () {
    'use strict';

    angular.module('ActivitySequence').controller('ActivitySequenceEditController', ['$scope', 'ActivitySequenceService', function ($scope, ActivitySequenceService) {
        $scope.activitySequence = ActivityEditorApp.activitySequence;

        $scope.addActivity = function () {
            ActivitySequenceService.addActivity($scope.activitySequence.id);
        };

    }]);
})();