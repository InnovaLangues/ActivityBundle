(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
        '$http',
        function ($http) {
            return {
                save: function (activity) {
                    // AJAX request
                }
            };
        }
    ]);
})();