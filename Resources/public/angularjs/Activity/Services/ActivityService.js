(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
        '$scope',
        '$http',
        function ($http) {
            return {
                save: function (activity) {
                    console.log($scope.activity);
                    // AJAX request
                }
            };
        }
    ]);
})();