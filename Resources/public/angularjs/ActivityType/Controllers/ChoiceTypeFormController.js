(function () {
    'use strict';

    angular.module('ActivityType').controller('ChoiceTypeFormController', [
        'ChoiceTypeService', 
        function (ChoiceTypeService) {
            this.webDir = ActivityEditorApp.webDir;

            this.activityType = {};

            this.update = function () {
                ChoiceTypeService.update(this.activityType.type);
            };

            this.addChoice = function () {
                this.activityType.type.choices.push({
                    id: 1 ,
                    media: "",
                    correctAnswer: false
                });
            };

            this.removeChoice = function (choice) {
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
                            this.activityType.type.choices[i].correctAnswer = false;
                        }
                    }
                }
            };
        }
    ]);
})();