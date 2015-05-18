(function () {
    'use strict';

    angular.module('ActivityType').controller('ChoiceTypeFormController', [
        '$document',
        '$modal',
        '$window',
        'ChoiceTypeService',
        function ($document, $modal, $window, ChoiceTypeService) {
            this.webDir = ActivityEditorApp.webDir;

            this.activityType = {};
            
            this.mediaTypes = [];
            
            this.getSelectionParentElement = function() {
                var parentEl = null, sel;
                if (window.getSelection) {
                    sel = window.getSelection();
                    if (sel.rangeCount) {
                        parentEl = sel.getRangeAt(0).commonAncestorContainer;
                        if (parentEl.nodeType !== 1) {
                            parentEl = parentEl.parentNode;
                        }
                    }
                } else if ( (sel === document.selection) && sel.type !== "Control") {
                    parentEl = sel.createRange().parentElement();
                }
                return parentEl;
            };
            
            this.getSelectedText = function() {
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

            this.manualTextAnnotation = function(text, css) {
                if (!css) {
                    $window.document.execCommand('insertHTML', false, css);
                } else {
                    $window.document.execCommand('insertHTML', false, '<span class="' + css + '">' + text + '</span>');
                }
            };
            
            this.annotate = function(color, choiceId) {
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
                    for (var i=0; i<this.activityType.type.choices.length; i++) {
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
                var j=1;
                for (var i=0; i<this.activityType.type.choices.length; i++) {
                    this.activityType.type.choices[i].position = j;
                    j++;
                }
            };

            this.update = function () {
                ChoiceTypeService.update(this.activityType.type);
            };

            this.addChoice = function () {
                this.activityType.type.choices.push({
                    id: 1 ,
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
                        title: function () { return "delete_choice" },
                        message: function () { return "confirm_delete_choice" },
                        confirmButton: function () { return "delete" }
                    }
                });
                
                modalInstance.result.then(function () {
                    this.confirmRemoveChoice(choice);
                }.bind(this));
            };
            
            this.confirmRemoveChoice = function (choice) {
                for (var i=0; i<this.activityType.type.choices.length; i++) {
                    if (this.activityType.type.choices[i] === choice) {
                        this.activityType.type.choices.splice(i, 1);
                    }
                }
            };
            
            this.selectChoice = function (selectedChoice) {
                if (this.activityType.typeAvailable.name !== "MultipleChoiceType") {
                    for (var i=0; i<this.activityType.type.choices.length; i++) {
                        if (this.activityType.type.choices[i] !== selectedChoice) {
                            this.activityType.type.choices[i].correctAnswer = "wrong";
                        }
                    }
                }
            };
            
            
              // Resource Picker base config
            this.resourcePickerConfig = {
                isPickerMultiSelectAllowed: false,
                webPath: ActivityEditorApp.webDir,
                appPath: ActivityEditorApp.appDir,
                directoryId: ActivityEditorApp.wsDirectoryId,
                resourceTypes: ActivityEditorApp.resourceTypes
            };
           
            // Activity resource picker config
            this.activitySequenceAudioResourcePicker = {
                name: 'picker-audio',
                parameters: angular.copy(this.resourcePickerConfig)
            };

            //this.activitySequenceAudioResourcePicker.parameters.typeWhiteList = ['media-resource'];
            this.activitySequenceAudioResourcePicker.parameters.callback = function (nodes) {
                if (typeof nodes === 'object' && nodes.length !== 0) {
                    for (var nodeId in nodes) {
                        console.log(nodes[nodeId]);
                        
                    }
                }
            };
        }
    ]);
})();