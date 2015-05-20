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
            
            
            this.limitedNumTries = false;

            // Tiny MCE options
            this.tinymceOptions = {
                relative_urls: false,
                theme: 'modern',
                browser_spellcheck : true,
                autoresize_min_height: 100,
                autoresize_max_height: 500,
                plugins: [
                    'autoresize advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars fullscreen',
                    'insertdatetime media nonbreaking save table directionality',
                    'template paste textcolor emoticons code'
                ],
                toolbar1: 'undo redo | styleselect | bold italic underline | forecolor | alignleft aligncenter alignright | preview fullscreen',
                paste_preprocess: function (plugin, args) {
                    var link = $('<div>' + args.content + '</div>').text().trim(); //inside div because a bug of jquery
                    var url = link.match(/^(((ftp|https?):\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})$/);

                    if (url) {
                        args.content = '<a href="' + link + '">' + link + '</a>';
                        window.Claroline.Home.generatedContent(link, function (data) {
                            insertContent(data);
                        }, false);
                    }
                }
            };
            
            
            this.areLimitedNumTries = function() {
                var input = document.getElementById('sequence_numTries');
                if (this.limitedNumTries) {
                    input.setAttribute('disabled', 'disabled');
                }
                else {
                    input.removeAttribute('disabled');
                }
            };

            this.sortableOptions = {
                placeholder: "placeholder",
                stop: function (e, ui) {
                   this.updateActivitiesOrder();
                }.bind(this),
                cancel: ".unsortable",
                items: "li:not(.unsortable)"
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
            
            this.update = function() {
                ActivitySequenceService.update(this.sequence);
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
                    ActivityService.create(this.sequence, type).then(function (activity) {
                        this.sequence.activities.push(activity);

                        this.showActivity(activity); // Display the new Activity
                    }.bind(this));
                }.bind(this));
            };

            this.removeActivity = function (activity) {
                if (false !== this.sequence.activities.indexOf(activity)) {
                //    this.sequence.activities.splice(this.sequence.activities.indexOf(activity), 1);
                    ActivitySequenceService.removeActivity(this.sequence, activity);
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

