(function () {
    'use strict';

    angular.module('Activity').controller('ActivityFormController', [
        'ActivityService',
        function (ActivityService) {
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
            
            this.sortableContentsOptions = {
                stop: function (e, ui) {
                    this.updateContentsOrder();
                }.bind(this)
            };
            
            this.updateContentsOrder = function () {
                var j=1;
                for (var i=0; i<this.activity.contents.length; i++) {
                    this.activity.contents[i].position = j;
                    j++;
                }
            };
            
            this.sortableInstructionsOptions = {
                stop: function (e, ui) {
                    this.updateInstructionsOrder();
                }.bind(this)
            };
            
            this.updateInstructionsOrder = function () {
                var j=1;
                for (var i=0; i<this.activity.instructions.length; i++) {
                    this.activity.instructions[i].position = j;
                    j++;
                }
            };

            this.update = function () {
                ActivityService.update(this.activity);
            };

            this.changeView = function (newView) {
                this.view = newView;
            };
            
            this.addInstruction = function () {
                this.activity.instructions.push({
                    id: 1 ,
                    media: ""
                });
            };
            
            this.removeInstruction = function (instruction) {
                for (var i=0; i<this.activity.instructions.length; i++) {
                    if (this.activity.instructions[i] === instruction) {
                        this.activity.instructions.splice(i, 1);
                    }
                }
            };
            
            this.addContent = function () {
                this.activity.contents.push({
                    id: 1 ,
                    media: ""
                });
            };
            
            this.removeContent = function (content) {
                for (var i=0; i<this.activity.contents.length; i++) {
                    if (this.activity.contents[i] === content) {
                        this.activity.contents.splice(i, 1);
                    }
                }
            };
        }
    ]);
})();