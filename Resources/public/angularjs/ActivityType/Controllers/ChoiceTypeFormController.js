(function () {
    'use strict';

    angular.module('ActivityType').controller('ChoiceTypeFormController', [
        '$scope',
        '$document',
        '$modal',
        '$window',
        'ChoiceTypeService',
        function ($scope, $document, $modal, $window, ChoiceTypeService) {
            this.webDir = ActivityEditorApp.webDir;

            this.activityType = {};

            this.mediaTypes = [];

            this.audio = null;
            this.audioIsPlaying = false;
            this.audioContext = new AudioContext();

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
            };

            this.stripIfText = function () {
                if (this.activityType.mediaType.name !== "Prosodic") {
                    for (var i = 0; i < this.activityType.type.choices.length; i++) {
                        this.activityType.type.choices[i].media = this.activityType.type.choices[i].media.replace(/<(?:.|\n)*?>/gm, '');
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

            this.update = function () {
                ChoiceTypeService.update(this.activityType.type);
            };

            this.addChoice = function () {
                this.activityType.type.choices.push({
                    id: 1,
                    media: "",
                    correctAnswer: "wrong",
                    position: this.activityType.type.choices.length + 1
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

            this.isAudioFile = function (mimeType) {
                var types = ['audio/x-wav', 'audio/mpeg', 'audio/ogg', 'custom/file'];
                return types.indexOf(mimeType) !== -1;
            };




            // Resource Picker base config
            this.resourcePickerConfig = {
                isPickerMultiSelectAllowed: false,
                webPath: ActivityEditorApp.webDir,
                appPath: ActivityEditorApp.appDir,
                directoryId: ActivityEditorApp.wsDirectoryId,
                resourceTypes: ActivityEditorApp.resourceTypes
            };

            // AUDIO RESOURCE PICKER
            this.activitySequenceAudioResourcePicker = {
                name: 'picker-audio',
                parameters: angular.copy(this.resourcePickerConfig)

            };

            // can not filter the ressource picker on audio files only...
            this.activitySequenceAudioResourcePicker.parameters.typeWhiteList = ['file'];

            var my = this;

            this.playSound = function (url) {
                console.log('play called');
                if (!this.audioIsPlaying) {
                    my.audio = new Audio(ActivityEditorApp.webDir + '../files/' + url);
                    my.audio.play();
                    my.audioIsPlaying = true;
                }
                else {
                    my.audio.pause();
                    my.audio = null;
                }
            }

            this.activitySequenceAudioResourcePicker.parameters.callback = function (nodes) {
                if (typeof nodes === 'object' && nodes.length !== 0) {
                    var resource = {};
                    for (var nodeId in nodes) {
                        // just one node to handle
                        var node = nodes[nodeId];
                        resource = {
                            name: node[0],
                            type: node[1],
                            mimeType: node[2],
                            id: nodeId
                        }
                    }
                    // ensure that the selected resource is an audio file
                    if (my.isAudioFile(resource.mimeType)) {
                        var id = this.viewName;
                        var refNode = document.getElementById(id);
                        var tag = document.createElement('audio');
                        tag.setAttribute('src', Routing.generate('activity_get_resource_content', {activityId: my.activityType.id, nodeId: resource.id}));
                        tag.setAttribute('controls', 'controls');
                        tag.setAttribute('style', 'width:80%;float:right;');
                        refNode.parentNode.insertBefore(tag, refNode.nextSibling);
                    }
                    else {
                        console.log('not audio file' + resource.mimeType);
                    }
                }
            };





            // IMAGE RESOURCE PICKER

            // VIDEO RESOURCE PICKER

            // SEGMENT RESOURCE PICKER


        }
    ]);
})();