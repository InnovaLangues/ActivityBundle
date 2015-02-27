(function () {
    'use strict';

    angular.module('ActivityType').controller('ChoiceTypeFormController', [
        function () {
            this.webDir = ActivityEditorApp.webDir;

            this.activityType = {};

            this.addChoice = function () {
                this.activityType.choices.push({
                    id: 1 ,
                    media: "media1"
                });
            };

            this.removeChoice = function () {

            };
        }
    ]);
})();