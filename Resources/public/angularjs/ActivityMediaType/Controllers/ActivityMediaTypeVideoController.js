(function () {
    'use strict';

    angular
            .module('ActivityMediaType')
            .controller('ActivityMediaTypeVideoController', [
                function () {
                    this.resourcePickerElement;
                    this.type;
                    this.choice;

                    this.checkFile = function (mimeType) {
                        var types = ['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/webm', 'video/mpeg', 'video/ogg'];
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
                            // ensure that the selected resource is a video file
                            if (this.checkFile(resource.mimeType)) {
                                this.choice.resource = resource.id;
                                this.appendElement();
                            }
                            else {
                                console.log('not video file ' + resource.mimeType);
                            }
                        }
                    }.bind(this);

                    this.appendElement = function () {
                        var root = this.resourcePickerElement;
                        var next = root.nextSibling;

                        if (next && next.tagName === 'VIDEO') {
                            root.parentNode.removeChild(next);
                        }

                        var tag = document.createElement('video');
                        tag.setAttribute('controls', 'controls');
                        tag.setAttribute('src', Routing.generate('activity_get_resource_content', {activityId: this.activityType.id, nodeId: this.choice.resource}));

                        tag.setAttribute('style', 'width:80%;float:right;');
                        root.parentNode.insertBefore(tag, root.nextSibling);

                    }.bind(this);

                    /**
                     * Called by ActivityImageChoice directive when link is done
                     * Each ressource picker is not created first so this method tells us it's ok to add video tag if needed          
                     */
                    this.appendTagIfNecessary = function () {
                        if (this.choice.resource) {
                            this.appendElement();
                        }
                    }


                    var my = this;
                    // RESOURCE PICKER
                    this.activitySequenceVideoResourcePicker = {
                        parameters: angular.copy(this.resourcePickerConfig),
                        callback: function selectResource(nodes) {
                            my.addResource(nodes);
                            nodes = {};
                        }
                    };
                }
            ]);
})();