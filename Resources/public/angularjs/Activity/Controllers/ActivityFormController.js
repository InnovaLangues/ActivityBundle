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
                browser_spellcheck: true,
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
                var j = 1;
                for (var i = 0; i < this.activity.contents.length; i++) {
                    this.activity.contents[i].position = j;
                    j++;
                }
            };

            this.sortableComplementaryInfosOptions = {
                stop: function (e, ui) {
                    this.updateComplementaryInfosOrder();
                }.bind(this)
            };

            this.updateComplementaryInfosOrder = function () {
                var j = 1;
                for (var i = 0; i < this.activity.complementaryInfos.length; i++) {
                    this.activity.complementaryInfos[i].position = j;
                    j++;
                }
            };

            this.sortableFunctionalInstructionsOptions = {
                stop: function (e, ui) {
                    this.updateFunctionalInstructionsOrder();
                }.bind(this)
            };

            this.updateFunctionalInstructionsOrder = function () {
                var j = 1;
                for (var i = 0; i < this.activity.functionalInstructions.length; i++) {
                    this.activity.functionalInstructions[i].position = j;
                    j++;
                }
            };

            this.sortableInstructionsOptions = {
                stop: function (e, ui) {
                    this.updateInstructionsOrder();
                }.bind(this)
            };

            this.updateInstructionsOrder = function () {
                var j = 1;
                for (var i = 0; i < this.activity.instructions.length; i++) {
                    this.activity.instructions[i].position = j;
                    j++;
                }
            };

            this.sortableQuestionsOptions = {
                stop: function (e, ui) {
                    this.updateQuestionsOrder();
                }.bind(this)
            };

            this.updateQuestionsOrder = function () {
                var j = 1;
                for (var i = 0; i < this.activity.questions.length; i++) {
                    this.activity.questions[i].position = j;
                    j++;
                }
            };

            /**
             * Save the activity
             */
            this.update = function () {
                ActivityService.update(this.activity);
            };

            this.changeView = function (newView) {
                this.view = newView;
            };

            this.addQuestion = function () {
                this.activity.questions.push({
                    id: 1,
                    media: "",
                    position: this.activity.questions.length + 1
                });
            };

            this.removeQuestion = function (question) {
                for (var i = 0; i < this.activity.questions.length; i++) {
                    if (this.activity.questions[i] === question) {
                        this.activity.questions.splice(i, 1);
                    }
                }
            };

            this.addComplementaryInfo = function () {
                this.activity.complementaryInfos.push({
                    id: 1,
                    media: "",
                    position: this.activity.complementaryInfos.length + 1
                });
            };

            this.removeComplementaryInfo = function (complementaryInfo) {
                for (var i = 0; i < this.activity.complementaryInfos.length; i++) {
                    if (this.activity.complementaryInfos[i] === complementaryInfo) {
                        this.activity.complementaryInfos.splice(i, 1);
                    }
                }
            };

            this.addInstruction = function () {
                this.activity.instructions.push({
                    id: 1,
                    media: "",
                    position: this.activity.instructions.length + 1
                });
            };

            this.removeInstruction = function (instruction) {
                for (var i = 0; i < this.activity.instructions.length; i++) {
                    if (this.activity.instructions[i] === instruction) {
                        this.activity.instructions.splice(i, 1);
                    }
                }
            };

            this.addFunctionalInstruction = function () {
                this.activity.functionalInstructions.push({
                    id: 1,
                    media: "",
                    position: this.activity.functionalInstructions.length + 1
                });
            };

            this.removeFunctionalInstruction = function (functionalInstruction) {
                for (var i = 0; i < this.activity.functionalInstructions.length; i++) {
                    if (this.activity.functionalInstructions[i] === functionalInstruction) {
                        this.activity.functionalInstructions.splice(i, 1);
                    }
                }
            };

            this.addContent = function () {
                this.activity.contents.push({
                    id: 1,
                    media: "",
                    position: this.activity.contents.length + 1
                });
            };

            this.removeContent = function (content) {
                for (var i = 0; i < this.activity.contents.length; i++) {
                    if (this.activity.contents[i] === content) {
                        this.activity.contents.splice(i, 1);
                    }
                }
            };
        }
    ]);
})();