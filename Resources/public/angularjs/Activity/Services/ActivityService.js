(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
        '$http',
        function ($http) {
            return {
                save: function (activity) {
                    // Init
                    var data = {
                        typology   : activity.typology,
                        description: activity.description
                    };

                    $http({
                        method: 'POST',
                        url: Routing.generate('activity_sequence_add_activity'),
                        data: data
                    })
                    .success(function (data) {

                    })
                    .error(function(data, status) {

                    });
                }
            };
        }
    ]);
})();