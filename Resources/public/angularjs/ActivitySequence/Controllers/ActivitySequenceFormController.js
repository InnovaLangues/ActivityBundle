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

                }.bind(this)
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
             * Add a new Activity to the ActivitySequence
             */
            this.addActivity = function () {
                // Open a modal to ask the user to choose the ActivityType
                // Create the Activity when User has chosen the ActivityType
                var modalInstance = $modal.open({
                    templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityTypeAvailable/Partials/activity-type-select.html',
                    controller: 'ActivityTypeSelectController'
                });

                modalInstance.result.then(function (type) {
                    ActivitySequenceService.addActivity(this.sequence).then(function (activity) {
                        // Display the new Activity
                        this.showActivity(activity);
                    }.bind(this));
                }.bind(this));
            };

            /**
             * Update an Activity of the Sequence
             * @param activity
             */
            this.updateActivity = function (activity) {
                ActivitySequenceService.updateActivity(this.sequence, activity);
            };

            /**
             * Delete an Activity from the ActivitySequence
             * @param activity
             */
            this.removeActivity = function (activity) {
                ActivitySequenceService.removeActivity(this.sequence, activity);

                // Update current Activity
                this.showActivity();
            };

            /**
             * Jump to next Activity in the Sequence
             * @param activity
             */
            this.nextActivity = function (activity) {
                var index = this.sequence.activities.indexOf(activity);

                if (false !== index && this.sequence.activities[index + 1]) {
                    this.showActivity(this.sequence.activities[index + 1]);
                }
            };

            /**
             * Jump to previous activity in the Sequence
             * @param activity
             */
            this.previousActivity = function (activity) {
                var index = this.sequence.activities.indexOf(activity);

                if (false !== index && this.sequence.activities[index - 1]) {
                    this.showActivity(this.sequence.activities[index - 1]);
                }
            };
        }
    ]);
})();

