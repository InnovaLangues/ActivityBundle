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
        'ActivityService',
        function ($scope, $modal, ActivitySequenceService, ActivityService) {
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
                   this.updateActivitiesOrder();
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

            this.updateActivitiesOrder = function () {
                ActivitySequenceService.updateActivitiesOrder(this.sequence);
            };

            /**
             * Add a new Activity to the ActivitySequence
             */
            this.addActivity = function () {
                // Open a modal to ask the user to choose the ActivityType
                // Create the Activity when User has chosen the ActivityType
                var modalInstance = $modal.open({
                    templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityAvailable/Partials/list.html',
                    controller: 'ActivityAvailableController as activityAvailableCtrl',
                    resolve: {
                        availables: [
                            'ActivityAvailableService',
                            function (ActivityAvailableService) {
                                return ActivityAvailableService.all();
                            }
                        ]
                    }
                });

                modalInstance.result.then(function (type) {
                    console.log(this.sequence);
                    console.log(type);
                    ActivityService.create(this.sequence, type).then(function (activity) {
                        this.sequence.activities.push(activity);

                        this.showActivity(activity); // Display the new Activity
                    }.bind(this))
                }.bind(this));
            };

            this.removeActivity = function (activity) {
                if (false !== this.sequence.activities.indexOf(activity)) {
                    this.sequence.activities.splice(this.sequence.activities.indexOf(activity), 1);
                    this.updateActivitiesOrder();
                }
                // Recalculate order of activities
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

