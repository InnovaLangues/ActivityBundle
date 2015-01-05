/**
 * ActivityTypeSelect Controller
 * Manages selection of the Activity type into the available types
 */
(function () {
    'use strict';

    angular.module('ActivityTypeAvailable').controller('ActivityTypeSelectController', [
        '$scope',
        '$modalInstance',
        function ($scope, $modalInstance) {
            /**
             * List of all selected types available
             */
            $scope.available = [];

            /**
             * Current selected type
             */
            $scope.selected = null;

            /**
             * Send back selected type and close modal
             */
            $scope.select = function () {
                if ($scope.selected) {
                    // A type is selected
                    $modalInstance.close($scope.selected);
                } else {
                    // Error because no type selected
                }
            };

            /**
             * Abort type selection
             */
            $scope.cancel = function () {
                $modalInstance.dismiss('cancel');
            };
        }
    ]);
})();