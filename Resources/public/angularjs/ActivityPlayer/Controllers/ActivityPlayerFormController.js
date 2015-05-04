(function () {
    'use strict';

    angular.module('ActivityPlayer').controller('ActivityPlayerFormController', [
        'ActivityPlayerService',
        function (ActivityPlayerService) {
            this.webDir = ActivityEditorApp.webDir;

            this.view = 'properties';

            this.sequence = {};
            this.currentFile = 'edit';
            
            this.iterator = 0;
            
            this.answers = [];
            
            this.inputs = [];
            this.input = null;
            
            this.checkInputs = function() {
                console.log(this.inputs);
                this.answers = [];
                for (var i=0; i<this.sequence.activities[this.iterator].type.choices.length; i++) {
                    this.answers.push({
                        id: this.sequence.activities[this.iterator].type.choices[i].id,
                        checked: this.inputs[i]
                    });
                }
                
                console.log(this.answers);
            };
            
            this.isChecked = function(choiceId) {
                var checked = false;
                for (var i=0; i<this.answers.length; i++) {
                    if (this.answers[i].id === choiceId && this.answers[i].checked) {
                        checked = true;
                    }
                }
                
                return checked;
            };
            
            this.isCorrect = function(correctAnswer, checked) {
                if (correctAnswer === "correct" && checked) {
                    return "success";
                }
                else if (correctAnswer === "correct" && !checked) {
                    return "warning";
                }
                else if (correctAnswer === "wrong" && checked) {
                    return "danger";
                }
                else {
                    return "";
                }
            };
            
            this.next = function () {
                this.iterator = this.iterator + 1;
                this.answers = [];
                this.inputs = [];
                this.currentFile = 'edit';
            };
            
            this.radioInputs = function(choice) {
                console.log(choice);
                this.answers = [];
                this.answers.push({
                    id: choice,
                    checked: true
                });
                console.log(this.answers);
            };
            
            this.randomSort = function(choice) {
                this.value = null;
                if (this.sequence.activities[this.iterator].type.randomlyOrdered) {
                    this.value = Math.random();
                }
                else {
                    this.value = "id";
                }
                return this.value;
            }.bind(this);
            
            this.save = function () {
                for (var i=0; i<this.answers.length; i++) {
                    console.log(this.answers[0].checked);
                    if (this.answers[i].checked === true) {
                        ActivityPlayerService.saveAnswer(this.sequence.activities[this.iterator].id, this.answers[0].id);
                        console.log("save");
                    }
                }
                this.currentFile = 'feedback';
            };
        }
    ]);
})();