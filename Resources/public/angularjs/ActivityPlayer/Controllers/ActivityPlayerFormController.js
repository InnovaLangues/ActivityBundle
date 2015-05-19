(function () {
    'use strict';

    angular.module('ActivityPlayer').controller('ActivityPlayerFormController', [
        'ActivityPlayerService',
        function (ActivityPlayerService) {
            this.webDir = ActivityEditorApp.webDir;

            this.view = 'properties';

            this.sequence = {};
            this.previousAnswers = [];
            
            this.currentFile = 'intro';
            this.currentAction = '';
            
            this.iterator = 0;
            this.trial = 1;
            
            this.answers = [];
            this.correctAnswers = [];
            
            this.inputs = [];
            this.input = null;
            
            this.answersGiven = function() {
                var numAnswers=0;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id) {
                        numAnswers++;
                    }
                }
                return !(numAnswers === 0);
            };
            
            this.checkInputs = function(choice) {
                this.answers = [];
                if (this.sequence.activities[this.iterator].typeAvailable.name === 'MultipleChoiceType') {
                    for (var i=0; i<this.sequence.activities[this.iterator].type.choices.length; i++) {
                        this.answers.push({
                            id: this.sequence.activities[this.iterator].type.choices[i].id,
                            checked: this.inputs[i]
                        });
                    }
                }
                else {
                    this.answers.push({
                        id: choice,
                        checked: true
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
            
            this.getDate = function(order) {
                var datetime = "";
                var previousDate;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id) {
                        previousDate = this.previousAnswers[i].dateCreated;
                        console.log(previousDate.date);console.log("-");console.log(datetime.date);
                        console.log(previousDate.date.localeCompare(datetime.date));
                        if (previousDate.date.localeCompare(datetime.date) === order || datetime === "") {
                            datetime = this.previousAnswers[i].dateCreated;
                        }
                    }
                }
                var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
                var parts=datetime.date.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
                var date = new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
                var formated_date = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
                var formated_hour = "(" + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds() + ")";
                var formated_date_hour = formated_date + " " + formated_hour;
                
                return formated_date_hour;
            };
            
            this.getExecutedActivities = function(index) {
                var j=0;
                var activities = [];
                var alreadySaved;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id && this.previousAnswers[i].numTrial === index) {
                        alreadySaved = false;
                        for (var k=0; k<activities.length; k++) {
                            if (activities[k] === this.previousAnswers[i].activity.id) {
                                alreadySaved = true;
                            }
                        }
                        if (!alreadySaved) {
                            activities.push(this.previousAnswers[i].activity.id);
                            j++;
                        }
                    }
                }
                if (this.sequence.activities.length === j) {
                    return j + " (terminé)";
                }
                else {
                    return j;
                }
            };
            
            this.getUsersPreviousAnswers = function() {
                var usersPreviousAnswers = [];
                var alreadySaved;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id) {
                        alreadySaved = false;
                        for (var j=0; j<usersPreviousAnswers;j++) {
                            if (usersPreviousAnswers[j] === this.previousAnswers[i].numTrial) {
                                alreadySaved = true;
                            }
                        }
                        if (!alreadySaved) {
                            usersPreviousAnswers.push(this.previousAnswers[i].numTrial);
                        }
                    }
                }
                return usersPreviousAnswers;
            };
            
            this.inputType = function() {
                if (this.sequence.activities[this.iterator].typeAvailable.name === 'MultipleChoiceType') {
                    return "checkbox";
                }
                else {
                    return "radio";
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
                this.correctAnswers = [];
                if (this.iterator >= this.sequence.activities.length) {
                    this.currentFile = 'end';
                }
                else {
                    this.currentAction = 'edit';
                }
                var inputs = document.getElementsByName('choices[]');
                for (var i=0; i<inputs.length; i++) {
                    inputs[i].removeAttribute('disabled');
                }
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
                    console.log(this.trial);
                for (var i=0; i<this.answers.length; i++) {
                    if (this.answers[i].checked === true) {
                        ActivityPlayerService.saveAnswer(this.sequence.activities[this.iterator].id, this.answers[0].id, this.trial);
                    }
                }
                this.currentAction = 'feedback';
                var inputs = document.getElementsByName('choices[]');
                for (var i=0; i<inputs.length; i++) {
                    inputs[i].setAttribute('disabled', 'disabled');
                }
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
                this.trial = 1;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id) {
                        if (this.trial <= this.previousAnswers[i].numTrial) {
                            this.trial = this.previousAnswers[i].numTrial + 1;
                        }
                    }
                }
            };
            
            this.test = function () {
                console.log(this.previousAnswers);
            };
        }
    ]);
})();