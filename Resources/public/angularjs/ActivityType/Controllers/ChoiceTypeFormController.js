(function () {
    'use strict';

    angular.module('ActivityType').controller('ChoiceTypeFormController', [
        '$modal',
        'ChoiceTypeService',
        function ($modal, ChoiceTypeService) {
            this.webDir = ActivityEditorApp.webDir;
            this.activityType = {};
            this.mediaTypes = [];

            /**
             * On Media Type change 
             */
            this.handleChoiceTypeChange = function () {

                // reset media resource
                this.activityType.mediaType.resource = null;
                // remove all previous <select> tags

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

            // Resource Picker base config
            this.resourcePickerConfig = {
                isPickerMultiSelectAllowed: false,
                webPath: ActivityEditorApp.webDir,
                appPath: ActivityEditorApp.appDir,
                directoryId: ActivityEditorApp.wsDirectoryId,
                resourceTypes: ActivityEditorApp.resourceTypes,
                typeWhiteList: ['media_resource']
            };

            /**
             * Set the resource to the MediaType
             */
            this.addResource = function (nodes) {
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
                        };
                    }
                    this.activityType.mediaType.resource = resource.id;
                    this.appendElements();
                }
            }.bind(this);

            this.appendElements = function () {

                // here we need to append for each choice li a <select> with all segments available for the media resource selected

                // create a service to get all segments available for the selected media ressource
                var segments = ChoiceTypeService.getMediaResourceSegments(this.activityType.id, this.activityType.mediaType.resource);
                console.log(segments);
                // append the select tag

                // create an audio tag with the right url

                /*var root = this.resourcePickerElement;
                 var next = root.nextSibling;
                 
                 if (next && next.tagName === 'audio') {
                 root.parentNode.removeChild(next);
                 }
                 
                 
                 
                 var tag = document.createElement('audio');
                 tag.setAttribute('src', Routing.generate('activity_get_mediaresource_segments', {activityId: this.activityType.id, nodeId: this.choice.resource}));
                 
                 tag.setAttribute('style', 'width:80%;float:right;');
                 root.parentNode.insertBefore(tag, root.nextSibling);*/
            }.bind(this);




            var my = this;
            // RESOURCE PICKER
            this.activityMediaTypeSegmentResourcePicker = {
                parameters: angular.copy(this.resourcePickerConfig),
                callback: function selectResource(nodes) {
                    my.addResource(nodes);
                    nodes = {};
                }
            };
        }
    ]);
})();