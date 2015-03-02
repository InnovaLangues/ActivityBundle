(function () {
    'use strict';

    angular.module('ActivityType').controller('ChoiceTypeFormController', [
        'ChoiceTypeService', 
        function (ChoiceTypeService) {
            this.webDir = ActivityEditorApp.webDir;

            this.activityType = {};

            this.update = function () {
                ChoiceTypeService.update(this.activityType);
            };

            this.addChoice = function () {
                this.activityType.choices.push({
                    id: 1 ,
                    media: ""
                });
            };

            this.removeChoice = function (choice) {
                for (var i=0; i<this.activityType.choices.length; i++) {
                    if (this.activityType.choices[i] === choice) {
                        this.activityType.choices.splice(i, 1);
                    }
                }
            };
        }
    ]);
})();