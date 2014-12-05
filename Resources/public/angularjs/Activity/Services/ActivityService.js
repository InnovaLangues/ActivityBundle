(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
        '$http',
        '$filter',
        'LoaderService',
        function ($http, $filter, LoaderService) {
            return {
                /*create: function (activity) {
                    $http({
                        method: 'POST',
                        url: Routing.generate('create_activity'),
                        data: activity
                    })
                    .success(function (response) {
                        // data == activity
                        activity.id = response.id;
                    })
                    .error(function(response, status) {
//                        AlertFactory.addAlert('danger', 'Error while adding activity.');
                    });
                },*/

                update: function (activity) {

                    $http.put(Routing.generate('update_activity', { activityId : activity.id }, activity))
                    .success(function (response) {

                    })
                    .error(function(response, status) {
//                        AlertFactory.addAlert('danger', 'Error while adding activity.');
                    });
                },

                delete: function (activity) {
                    LoaderService.startRequest();

                    $http.delete(Routing.generate('delete_activity', { activityId: activity.id }))
                    .success(function (response) {
                        LoaderService.endRequest();
                    });
                }
            };
        }
    ]);
})();