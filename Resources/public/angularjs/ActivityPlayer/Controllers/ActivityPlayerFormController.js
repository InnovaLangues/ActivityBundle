(function () {
    'use strict';

    angular.module('ActivityPlayer').controller('ActivityPlayerFormController', [
        'ActivityPlayerService',
        function (ActivityPlayerService) {
            this.webDir = ActivityEditorApp.webDir;

            this.view = 'properties';

            this.sequence = {};
            this.currentFile = 'intro';
            this.currentAction = '';
            
            this.iterator = 0;
            
            this.answers = [];
            this.correctAnswers = [];
            
            this.inputs = [];
            this.input = null;
            
            this.checkInputs = function() {
                this.answers = [];
                for (var i=0; i<this.sequence.activities[this.iterator].type.choices.length; i++) {
                    this.answers.push({
                        id: this.sequence.activities[this.iterator].type.choices[i].id,
                        checked: this.inputs[i]
                    });
                }
            };
            
            this.genericFeedback = function() {
                var correct = false;
                var wrong = false;
                for (var i=0; i<this.correctAnswers.length; i++) {
                    if (this.correctAnswers[i] === "correct") {
                        correct = true;
                    }
                    else if (this.correctAnswers[i] === "wrong") {
                        wrong = true;
                    }
                }
                if (correct && !wrong) {
                    return "answer_is_correct";
                }
                else if (correct && wrong) {
                    return "answer_is_partially_correct";
                }
                else {
                    return "answer_is_incorrect";
                }
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
            
            this.isCorrect = function(correctAnswer, choiceId) {
                var checked = false;
                for (var i=0; i<this.answers.length; i++) {
                    if (this.answers[i].id === choiceId) {
                        checked = this.answers[i].checked;
                    }
                }
                
                if (correctAnswer === "correct") {
                    if (checked) {
                        this.correctAnswers.push("correct");
                        return "fa fa-check answer_spe_is_correct";
                    }
                    else {
                        this.correctAnswers.push("wrong");
                        return "";
                    }
                }
                else if (checked && correctAnswer === "neutral") {
                    this.correctAnswers.push("correct");
                    return "fa fa-check answer_spe_is_neutral";
                }
                else if (checked && correctAnswer === "wrong") {
                        this.correctAnswers.push("wrong");
                    return "fa fa-close answer_spe_is_wrong";
                }
                else {
                    return "";
                }
            };
            
            this.isSelectedDot = function (index) {
                if (index === -1) {
                    if (this.currentFile === "intro") {
                        return "fa-square dot-selected";
                    }
                    else {
                        return "fa-square-o dot-unselected";
                    }
                }
                else if (index === "end") {
                    if (this.currentFile === "end") {
                        return "fa-square dot-selected";
                    }
                    else {
                        return "fa-square-o dot-unselected";
                    }
                }
                else if (index === this.iterator && this.currentFile === "edit") {
                    return "fa-circle dot-selected";
                }
                else {
                    return "fa-circle-thin dot-unselected";
                }
            };
            
            this.jumpTo = function (index) {
                if (index === "intro") {
                    this.currentFile = 'intro';
                    this.iterator = 0;
                    this.currentAction = '';
                }
                else {
                    this.iterator = index;
                    this.currentFile = 'edit';
                    this.currentAction = 'edit';
                }
            };
            
            this.next = function () {
                this.iterator = this.iterator + 1;
                this.answers = [];
                this.inputs = [];
                if (this.iterator >= this.sequence.activities.length) {
                    this.currentFile = 'end';
                }
                else {
                    this.currentAction = 'edit';
                }
            };
            
            this.radioInputs = function(choice) {
                this.answers = [];
                this.answers.push({
                    id: choice,
                    checked: true
                });
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
                    if (this.answers[i].checked === true) {
                        ActivityPlayerService.saveAnswer(this.sequence.activities[this.iterator].id, this.answers[0].id);
                    }
                }
                this.currentAction = 'feedback';
            };
            
            this.specificFeedback = function(correctAnswer, choiceId) {
                var checked = false;
                for (var i=0; i<this.answers.length; i++) {
                    if (this.answers[i].id === choiceId) {
                        checked = this.answers[i].checked;
                    }
                }
                
                if (correctAnswer === "correct") {
                    if (checked) {
                        this.correctAnswers.push("correct");
                        return "answer_spe_is_correct";
                    }
                    else {
                        this.correctAnswers.push("wrong");
                        return "";
                    }
                }
                else if (checked && correctAnswer === "neutral") {
                    this.correctAnswers.push("correct");
                    return "answer_spe_is_neutral";
                }
                else if (checked && correctAnswer === "wrong") {
                        this.correctAnswers.push("wrong");
                    return "answer_spe_is_incorrect";
                }
                else {
                    return "";
                }
            };
            
            this.start = function () {
                this.currentAction = 'edit';
                this.currentFile = 'edit';
            };
        }
    ]);
})();