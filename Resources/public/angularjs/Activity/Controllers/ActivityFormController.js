(function () {
    'use strict';

    angular.module('Activity').controller('ActivityFormController', [
        '$scope',
        '$modal',
        'ActivityService',
        function ($scope, $modal, ActivityService) {
            this.webDir = ActivityEditorApp.webDir;

            this.view = 'properties';

            this.activity = {};

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

            this.update = function () {
                ActivityService.update(this.activity);

                // Emit event for the parent Activity
                $scope.$emit('activityUpdate', this.activity);
            };

            this.changeView = function (newView) {
                this.view = newView;
            };
            
            this.addInstruction = function () {
                this.activity.instructions.push({
                    id:1 , 
                    title: "instruction1" ,
                    media: "media1"
                });
            };
            
            this.removeInstruction = function (instruction) {
                for (var i=0; i<this.activity.instructions.length; i++) {
                    if (this.activity.instructions[i] === instruction) {
                        this.activity.instructions.splice(i, 1);
                    }
                }
            };
            
            this.type = function () {
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
                    ActivityService.type(this.activity.id, type);
                }.bind(this));
            };
        }
    ]);
})();