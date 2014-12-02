(function () {
    'use strict';

    angular.module('Activity').factory('ActivityService', [
        '$http',
        '$filter',
        'LoaderService',
        function ($http, $filter, LoaderService) {
            return {
                /*add: function() {
                    LoaderService.startRequest();
                    $http.get(Routing.generate('activity_add_activity', { activityId: activity.id }))
                    .success(function (data) {
                        activitySequence.activities.push(data.activity);
                        LoaderService.endRequest();
                    });
                },*/

                delete: function(activityId) {
                    LoaderService.startRequest();

                    $http.delete(Routing.generate('delete_activity', { activityId: activityId }))
                    .success(function (data) {
                        LoaderService.endRequest();
                    });
                },

                create: function (activity) {
                    $http({
                        method: 'POST',
                        // TODO : use correct URL
                        url: Routing.generate('activity_add_activity'),
                        data: data
                    })
                    .success(function (data) {
                        // data == activity

                        activity.id = data.id;
                    })
                    .error(function(data, status) {
//                        AlertFactory.addAlert('danger', 'Error while adding activity.');
                    });
                },

                update: function (activity) {
                    $http({
                        method: 'PUT',
                        // TODO : use correct URL
                        url: Routing.generate('activity_sequence_add_activity', {activitySequenceId : activity.id}),
                        data: data
                    })
                    .success(function (data) {

                    })
                    .error(function(data, status) {
//                        AlertFactory.addAlert('danger', 'Error while adding activity.');
                    });
                },

                // TODO : to remove when create() and save() method have been developed
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