(function () {
    'use strict';

    angular.module('ActivityType').controller('ChoiceTypeFormController', [
        '$modal',
        function ($modal) {
            this.webDir = ActivityEditorApp.webDir;
            this.activityType = {};
            this.mediaTypes = [];

            /**
             * On Media Type change 
             */
            this.handleChoiceTypeChange = function () {

                var type = this.activityType.mediaType.name;
                if (this.activityType.type) {
                    // if we are choosing text type remove html markups from media property
                    if (type === "Text") {
                        for (var i = 0; i < this.activityType.type.choices.length; i++) {
                            if (this.activityType.type.choices[i].media) {
                                this.activityType.type.choices[i].media = this.activityType.type.choices[i].media.replace(/<(?:.|\n)*?>/gm, '');
                            }
                        }
                    }
                    // if not prosodic and not text set media property to emty string
                    else if (type !== "Prosodic") {
                        for (var i = 0; i < this.activityType.type.choices.length; i++) {
                            if (this.activityType.type.choices[i].media) {
                                this.activityType.type.choices[i].media = '';
                            }
                        }
                    }

                    // in any case set resource property to null
                    for (var i = 0; i < this.activityType.type.choices.length; i++) {
                        if (this.activityType.type.choices[i].resource) {
                            this.activityType.type.choices[i].resource = null;
                        }
                    }

                }
            };

            this.sortableOptions = {
                handle: "> .myHandle",
                stop: function (e, ui) {
                    this.updateChoicesOrder();
                }.bind(this)
            };

            this.updateChoicesOrder = function () {
                var j = 1;
                for (var i = 0; i < this.activityType.type.choices.length; i++) {
                    this.activityType.type.choices[i].position = j;
                    j++;
                }
            };

            this.addChoice = function () {
                this.activityType.type.choices.push({
                    id: 1,
                    media: "",
                    correctAnswer: "wrong",
                    position: this.activityType.type.choices.length + 1,
                    resource: null
                });
            };

            this.removeChoice = function (choice) {

                var modalInstance = $modal.open({
                    templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/Confirm/Partials/confirm.html',
                    controller: 'ConfirmModalCtrl',
                    resolve: {
                        title: function () {
                            return "delete_choice"
                        },
                        message: function () {
                            return "confirm_delete_choice"
                        },
                        confirmButton: function () {
                            return "delete"
                        }
                    }
                });

                modalInstance.result.then(function () {
                    this.confirmRemoveChoice(choice);
                }.bind(this));
            };

            this.confirmRemoveChoice = function (choice) {
                for (var i = 0; i < this.activityType.type.choices.length; i++) {
                    if (this.activityType.type.choices[i] === choice) {
                        this.activityType.type.choices.splice(i, 1);
                    }
                }
            };

            this.selectChoice = function (selectedChoice) {
                if (this.activityType.typeAvailable.name !== "MultipleChoiceType") {
                    for (var i = 0; i < this.activityType.type.choices.length; i++) {
                        if (this.activityType.type.choices[i] !== selectedChoice) {
                            this.activityType.type.choices[i].correctAnswer = "wrong";
                        }
                    }
                }
            };
        }
    ]);
})();