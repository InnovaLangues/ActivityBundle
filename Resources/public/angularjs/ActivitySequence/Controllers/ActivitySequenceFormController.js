/**
 * ActivitySequence Form Controller
 * Manages the form for administrating ActivitySequences
 */
(function () {
    'use strict';

    angular.module('ActivitySequence').controller('ActivitySequenceFormController', [
        '$scope',
        '$modal',
        'ActivitySequenceService',
        function ($scope, $modal, ActivitySequenceService) {
            /**
             * The current Activity Sequence
             * @type {{}}
             */
            this.sequence = {};

            /**
             * The current displayed activity
             * @type {{}}
             */
            this.currentActivity = {};

            this.sortableOptions = {
                stop: function (e, ui) {
                    var order = this.sequence.activities.map(function(i){return i.id;});

                    ActivitySequenceService.saveOrder(this.sequence.id, order).then(function(activitySequence) {
                        /*this.sequence = ActivitySequenceService.setActivitySequence(activitySequence);*/
                    });
                }.bind(this)
            };

            /**
             * Add a new Activity to the ActivitySequence
             */
            this.addActivity = function () {
                // Open a modal to ask the user to choose the ActivityType
                /*var modalInstance = $modal.open({
                    templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityTypeAvailable/Partials/activity-type-available-list.html',
                    controller: 'ActivityTypeAvailableController'
                });*/

                // Create the Activity when User has chosen the ActivityType
                /*modalInstance.result.then(function (type) {*/
                    ActivitySequenceService.addActivity(this.sequence).then(function (activity) {
                        // Display the new Activity
                        this.showActivity(activity);
                    }.bind(this));
                /*}.bind(this));*/
            };

            /**
             * Show the form for a specific Activity of the ActivitySequence
             * @param activity
             */
            this.showActivity = function (activity) {
                if (activity) {
                    this.currentActivity = activity;
                } else if (this.sequence.activities && this.sequence.length !== 0) {
                    this.currentActivity = this.sequence.activities[0];
                }
            };

            /**
             * Delete an Activity from the ActivitySequence
             * @param activity
             */
            this.deleteActivity = function (activity) {
                ActivitySequenceService.delete(activity);
            };

            this.nextActivity = function () {

            };

            this.previousActivity = function () {

            };
        }
    ]);
})();

