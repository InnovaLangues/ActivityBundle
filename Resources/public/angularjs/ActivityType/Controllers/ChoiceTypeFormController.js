(function () {
    'use strict';

    angular.module('ActivityType').controller('ChoiceTypeFormController', [
        '$modal',
        function ($modal) {
            this.webDir = ActivityEditorApp.webDir;

            this.activityType = {};

            this.mediaTypes = [];
            /*
             this.getSelectionParentElement = function () {
             var parentEl = null, sel;
             if (window.getSelection) {
             sel = window.getSelection();
             if (sel.rangeCount) {
             parentEl = sel.getRangeAt(0).commonAncestorContainer;
             if (parentEl.nodeType !== 1) {
             parentEl = parentEl.parentNode;
             }
             }
             } else if ((sel === document.selection) && sel.type !== "Control") {
             parentEl = sel.createRange().parentElement();
             }
             return parentEl;
             };
             
             this.getSelectedText = function () {
             var txt = '';
             if ($window.getSelection) {
             txt = $window.getSelection();
             } else if ($window.document.getSelection) {
             txt = $window.document.getSelection();
             } else if ($window.document.selection) {
             txt = $window.document.selection.createRange().text;
             }
             return txt;
             };
             
             this.manualTextAnnotation = function (text, css) {
             if (!css) {
             $window.document.execCommand('insertHTML', false, css);
             } else {
             $window.document.execCommand('insertHTML', false, '<span class="' + css + '">' + text + '</span>');
             }
             };
             
             this.annotate = function (color, choiceId) {
             var text = this.getSelectedText();
             var elem = this.getSelectionParentElement();
             var id = "choice-" + choiceId;
             while (elem.tagName !== "LI") {
             elem = elem.parentNode;
             }
             if (text !== '' && elem.id === id) {
             this.manualTextAnnotation(text, 'accent-' + color);
             }
             };*/

            /**
             * On Media Type change 
             */
            this.handleChoiceTypeChange = function () {

                var type = this.activityType.mediaType.name;
                console.log('handle');
                if (this.activityType.type) {
                    //console.log(type);
                    // if we are choosing text type remove html markups from media property
                    if (type === "Text") {
                        for (var i = 0; i < this.activityType.type.choices.length; i++) {
                            //console.log(this.activityType.type.choices[i].media);
                            if (this.activityType.type.choices[i].media) {
                                this.activityType.type.choices[i].media = this.activityType.type.choices[i].media.replace(/<(?:.|\n)*?>/gm, '');
                            }
                        }
                    }
                    // if sound / video / picture -> set media to null
                    else if (type === "Sound" || type === "Video" || type === "Picture") {
                        for (var i = 0; i < this.activityType.type.choices.length; i++) {
                            if (this.activityType.type.choices[i].resource) {
                                this.activityType.type.choices[i].resource = null;
                            }
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