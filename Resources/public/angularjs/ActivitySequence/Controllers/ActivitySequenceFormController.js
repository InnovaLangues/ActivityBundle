/**
 * ActivitySequence Controller
 */
(function () {
    'use strict';

    angular.module('ActivitySequence').controller('ActivitySequenceFormController', [
        '$scope',
        '$modal',
        'ActivitySequenceService',
        function ($scope, $modal, ActivitySequenceService) {
            this.sequence = {};
            this.currentActivity = null;

            /**
             * Add a new Activity to the ActivitySequence
             */
            this.addActivity = function () {
                // Open a modal to ask the user to choose the ActivityType
                /*var modalInstance = $modal.open({
                    templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityTypeAvailable/Partial/activity-type-available-list.html',
                    controller: 'ActivityTypeAvailableController'
                });

                // Create the Activity when User has choosen the ActivityType
                modalInstance.result.then(function (type) {

                });*/

                var promiseActivity = ActivitySequenceService.addActivity(this.sequence);
                promiseActivity.then(function (activity) {
                    this.showActivity(activity);
                }.bind(this));
            };

            this.showActivity = function (activity) {
                if (activity) {
                    this.currentActivity = activity;
                } else if (this.sequence.activities && this.sequence.length !== 0) {
                    this.currentActivity = this.sequence.activities[0];
                }
            };

            this.deleteActivity = function (activity) {
                ActivitySequenceService.delete(activity);
            };

            this.sortableOptions = {
                stop: function (e, ui) {
                    var id = this.sequence.id;
                    var order = this.sequence.activities.map(function(i){return i.id;});

                    var promise = ActivitySequenceService.saveOrder(id, order);
                    promise.then(function(activitySequence) {
                        /*this.sequence = ActivitySequenceService.setActivitySequence(activitySequence);*/
                    });
                }.bind(this)
            };
        }
    ]);
})();

