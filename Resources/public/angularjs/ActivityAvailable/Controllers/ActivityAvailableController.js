/**
 * ActivityAvailable Controller
 * Manages selection of the Activity type into the available types
 */
(function () {
    'use strict';

    angular.module('ActivityAvailable').controller('ActivityAvailableController', [
        '$scope',
        '$modalInstance',
        'availables',
        function ($scope, $modalInstance, availables) {
            /**
             * List of all types available
             */
            this.availables = availables;

            /**
             * Send back selected type and close modal
             */
            this.select = function (selected) {
                $modalInstance.close(selected);
            };

            /**
             * Abort type selection
             */
            this.cancel = function () {
                $modalInstance.dismiss('cancel');
            };
        }
    ]);
})();