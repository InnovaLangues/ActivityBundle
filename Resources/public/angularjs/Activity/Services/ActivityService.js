(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
        '$http',
        function ($http) {
            return {
                save: function (activity) {
                    // Init
                    var data = {
                        id          : activity.id,
                        typology    : activity.typology,
                        description : activity.description
                    };

                    $http({
                        method: 'GET',
                        url: Routing.generate('activity_sequence_add_activity', {activitySequenceId : activity.id}),
                        data: data
                    })
                    .success(function (data) {
                    })
                    .error(function(data, status) {
//                        AlertFactory.addAlert('danger', 'Error while adding activity.');
                    });
                }
            };
        }
    ]);
})();