(function () {
    'use strict';

    angular.module('Activity').controller('ActivityEditController', [
        '$scope',
        'ActivityService',
        function ($scope, ActivityService) {
            $scope.activity = {};

            $scope.save = function () {
                console.log($scope.activity);
                ActivityService.save($scope.activity);
            };
        }
    ]);
})();