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
            
            /**
             * On Media Type change 
             */
            this.handleChoiceTypeChange = function () {
               
               var type = this.activityType.mediaType.name;
                // check if we are choosing text remove html markups from text
                if (type === "Text") {
                    for (var i=0; i<this.activityType.type.choices.length; i++) {
                        this.activityType.type.choices[i].media = this.activityType.type.choices[i].media.replace(/<(?:.|\n)*?>/gm, '');
                    }
                }
                // if sound / video / picture -> set media to null
                else if(type === "Sound" || type === "Video" || type === "Picture"){
                    for (var i=0; i<this.activityType.type.choices.length; i++) {
                        this.activityType.type.choices[i].media = null;
                    }
                }
            };
            /*
            this.stripIfText = function () {
                if (this.activityType.mediaType.name !== "Prosodic") {
                    for (var i=0; i<this.activityType.type.choices.length; i++) {
                        this.activityType.type.choices[i].media = this.activityType.type.choices[i].media.replace(/<(?:.|\n)*?>/gm, '');
                    }
                }
            };*/
            
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

/* // update method is called from ActivityFormController -> update
            this.update = function () {
                console.log('choice type form controller ??');
                ChoiceTypeService.update(this.activityType.type);
            };
            */

            this.addChoice = function () {
                console.log('yep 2');
                this.activityType.type.choices.push({
                    id: 1 ,
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

            this.isAudioFile = function (mimeType) {
                var types = ['audio/x-wav', 'audio/mpeg', 'audio/ogg', 'custom/file'];
                return types.indexOf(mimeType) !== -1;
            };

            this.isImageFile = function (mimeType) {
                var types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                return types.indexOf(mimeType) !== -1;
            };
            
            this.isVideoFile = function (mimeType) {
                var types = ['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/webm', 'video/mpeg'];
                return types.indexOf(mimeType) !== -1;
            };


            // Resource Picker base config
            this.resourcePickerConfig = {
                isPickerMultiSelectAllowed: false,
                webPath: ActivityEditorApp.webDir,
                appPath: ActivityEditorApp.appDir,
                directoryId: ActivityEditorApp.wsDirectoryId,
                resourceTypes: ActivityEditorApp.resourceTypes,
                typeWhiteList: ['file']
            };

            var my = this;

            // AUDIO RESOURCE PICKER
            this.activitySequenceAudioResourcePicker = {
                name: 'picker-audio',
                parameters: angular.copy(this.resourcePickerConfig)

            };
            // can not filter the ressource picker on audio files only...
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

                        var next = refNode.nextSibling;
                        if (next && next.tagName === 'AUDIO') {
                            refNode.parentNode.removeChild(next);
                        }

                        var tag = document.createElement('audio');
                        tag.setAttribute('src', Routing.generate('activity_get_resource_content', {activityId: my.activityType.id, nodeId: resource.id}));
                        tag.setAttribute('controls', 'controls');
                        tag.setAttribute('style', 'width:80%;float:right;');
                        refNode.parentNode.insertBefore(tag, refNode.nextSibling);
                    }
                    else {
                        console.log('not audio file ' + resource.mimeType);
                    }
                }
                // Remove checked nodes for next time
                nodes = {};
            };

            // IMAGE RESOURCE PICKER
            this.activitySequenceImageResourcePicker = {
                name: 'picker-image',
                parameters: angular.copy(this.resourcePickerConfig)

            };

            // can not filter the ressource picker on image files only...
            this.activitySequenceImageResourcePicker.parameters.callback = function (nodes) {
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
                    if (my.isImageFile(resource.mimeType)) {
                        var id = this.viewName;
                        var refNode = document.getElementById(id);

                        var next = refNode.nextSibling;
                        if (next && next.tagName === 'IMG') {
                            refNode.parentNode.removeChild(next);
                        }

                        var tag = document.createElement('img');
                        tag.setAttribute('src', Routing.generate('activity_get_resource_content', {activityId: my.activityType.id, nodeId: resource.id}));

                        tag.setAttribute('style', 'width:80%;float:right;');
                        refNode.parentNode.insertBefore(tag, refNode.nextSibling);
                    }
                    else {
                        console.log('not image file ' + resource.mimeType);
                    }
                }
                // Remove checked nodes for next time
                nodes = {};
            };

            // VIDEO RESOURCE PICKER
            this.activitySequenceVideoResourcePicker = {
                name: 'picker-video',
                parameters: angular.copy(this.resourcePickerConfig)

            };

            // can not filter the ressource picker on image files only...
            this.activitySequenceVideoResourcePicker.parameters.callback = function (nodes) {
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
                    // ensure that the selected resource is an video file
                    if (my.isVideoFile(resource.mimeType)) {
                        var id = this.viewName;
                        var refNode = document.getElementById(id);

                        var next = refNode.nextSibling;
                        if (next && next.tagName === 'VIDEO') {
                            refNode.parentNode.removeChild(next);
                        }

                        var tag = document.createElement('video');
                        tag.setAttribute('controls', 'controls');
                        tag.setAttribute('src', Routing.generate('activity_get_resource_content', {activityId: my.activityType.id, nodeId: resource.id}));

                        tag.setAttribute('style', 'width:80%;float:right;');
                        refNode.parentNode.insertBefore(tag, refNode.nextSibling);
                    }
                    else {
                        console.log('not video file ' + resource.mimeType);
                    }
                }
                // Remove checked nodes for next time
                nodes = {};
            };

            // SEGMENT RESOURCE PICKER


        }
    ]);
})();