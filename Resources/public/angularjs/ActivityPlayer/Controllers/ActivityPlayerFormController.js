(function () {
    'use strict';

    angular.module('ActivityPlayer').controller('ActivityPlayerFormController', [
        '$modal',
        'ActivityPlayerService',
        function ($modal, ActivityPlayerService) {
            this.webDir = ActivityEditorApp.webDir;

            this.view = 'properties';

            this.sequence = {};
            this.previousAnswers = [];
            
            this.currentFile = 'intro';
            this.currentAction = '';
            
            this.iterator = 0;
            this.trial = 1;
            this.triesByActivity = [];
            
            this.answers = [];
            this.correctAnswers = [];
            
            this.inputElements = [];
            
            this.inputsUnique = [];
            this.inputsMultiple = [];
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
            
            this.canPlayActivityAgain = function() {
                if (this.triesByActivity[this.iterator] < this.sequence.activities[this.iterator].numTries && this.currentAction === 'feedback') {
                    return true;
                }
                else {
                    return false;
                }
            };
            
            this.checkInputs = function(choice) {
                this.answers = [];
                if (this.sequence.activities[this.iterator].typeAvailable.name === 'MultipleChoiceType') {
                    for (var i=0; i<this.sequence.activities[this.iterator].type.choices.length; i++) {
                        this.answers.push({
                            id: this.sequence.activities[this.iterator].type.choices[i].id,
                            checked: this.inputsMultiple[i]
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
            
            this.formatDate = function(number) {
                if (number < 10) {
                    return "0" + number;
                }
                else {
                    return number;
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
            
            this.getDate = function(index, order) {
                var datetime = "";
                var previousDate;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id && this.previousAnswers[i].numTrial === index) {
                        previousDate = this.previousAnswers[i].dateCreated.date;
                        if (previousDate.localeCompare(datetime.date) === order || datetime === "") {
                            datetime = this.previousAnswers[i].dateCreated.date;
                        }
                    }
                }
                var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]).[0-9]*)?$/;
                var parts=datetime.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
                var date = new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
                var formated_date = this.formatDate(date.getDate()) + "/" + this.formatDate(date.getMonth() + 1) + "/" + date.getFullYear();
                var formated_hour = "(" + date.getHours() + ":" + this.formatDate(date.getMinutes()) + ":" + this.formatDate(date.getSeconds()) + ")";
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
            
            this.getModalInstance = function(name) {
                var modalInstance = $modal.open({
                    templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/Confirm/Partials/confirm.html',
                    controller: 'ConfirmModalCtrl',
                    resolve: {
                        title: function () { return name },
                        message: function () { return "confirm_" + name },
                        confirmButton: function () { return "yes" }
                    }
                });
                
                return modalInstance;
            };
            
            this.getRightAnswersGiven = function(index, right) {
                var correct = 0;
                var wrong = 0;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id && this.previousAnswers[i].numTrial === index) {
                        if (this.previousAnswers[i].choiceProperties[0].correctAnswer === "correct") {
                            correct++;
                        }
                        else if (this.previousAnswers[i].choiceProperties[0].correctAnswer === "wrong") {
                            wrong++;
                        }
                    }
                }
                
                if (right) {
                    return correct;
                }
                else {
                    return wrong;
                }
            };
            
            this.getUsersPreviousAnswers = function() {
                var usersPreviousAnswers = [];
                var alreadySaved;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id) {
                        alreadySaved = false;
                        for (var j=0; j<usersPreviousAnswers.length;j++) {
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
            
            this.getUsersPreviousAnswersLength = function() {
                return this.getUsersPreviousAnswers().length;
            };
            
            this.inputType = function() {
                if (this.sequence.activities[this.iterator].typeAvailable.name === 'MultipleChoiceType') {
                    return "checkbox";
                }
                else {
                    return "radio";
                }
            };
            
            this.isAuthorizedStart = function() {
                if (this.getUsersPreviousAnswersLength() < this.sequence.numAttempts || this.sequence.numAttempts === 0) {
                    return true;
                }
                else {
                    return false;
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
            
            this.isExecutedActivity = function (id) {
                var isExecuted = false;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.id === id) {
                        isExecuted = true;
                    }
                }
                
                return isExecuted;
            };
            
            this.isSelectedDot = function (index, id) {
                var cssClass = "";
                
                if (index === -1) {
                    cssClass = "fa-square-o";
                    if (this.currentFile === "intro") {
                        cssClass += " dot-selected";
                    }
                    else {
                        cssClass += " dot-unselected";
                    }
                }
                else if (index === "end") {
                    cssClass = "fa-square-o";
                    if (this.currentFile === "end") {
                        cssClass += " dot-selected";
                    }
                    else {
                        cssClass += " dot-unselected";
                    }
                }
                else {
                    cssClass = "fa-circle";
                    if (!this.isExecutedActivity(id)) {
                        cssClass += "-thin";
                        
                        if (index === this.iterator && this.currentFile === "edit") {
                            cssClass += " dot-selected";
                        }
                        else {
                            cssClass += " dot-not-executed";
                        }
                    }
                    else {
                        if (index === this.iterator && this.currentFile === "edit") {
                            cssClass += " dot-selected";
                        }
                        else {
                            cssClass += " dot-executed";
                        }
                    }
                    
                    if (!(index === this.iterator && this.currentFile === "edit")) {
                        cssClass += " dot-unselected";
                    }
                }
                
                return cssClass;
            };
            
            this.jumpTo = function (index) {
                if (this.currentAction === 'edit') {
                    var modalInstance = this.getModalInstance("jump_to");
                    modalInstance.result.then(function () {
                        this.confirmJumpTo(index);
                    }.bind(this));
                }
                else {
                    this.confirmJumpTo(index);
                }
            };
            
            this.confirmJumpTo = function (index) {
                if (index === "intro") {
                    this.currentFile = 'intro';
                    this.iterator = 0;
                    this.currentAction = '';
                }
                else if (index === "end") {
                    this.currentFile = 'end';
                    this.currentAction = '';
                }
                else {
                    if (this.currentFile === 'intro') {
                        for (var i=0; i<this.sequence.activities.length; i++) {
                            this.triesByActivity.push(0);
                        }
                        this.setTrialValue();
                    }
                    this.iterator = index;
                    this.currentFile = 'edit';
                    this.currentAction = 'edit';
                }
                this.answers = [];
                this.inputsMultiple = [];
                this.inputsUnique = [];
            };
            
            this.next = function () {
                this.iterator = this.iterator + 1;
                this.answers = [];
                this.inputsMultiple = [];
                this.inputsUnique = [];
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
            
            this.nextActivity = function () {
                if (this.currentAction === 'edit') {
                    var modalInstance = this.getModalInstance("next_activity");
                    modalInstance.result.then(function () {
                        this.confirmNextActivity();
                    }.bind(this));
                }
                else {
                    this.confirmNextActivity();
                }
            };
            
            this.confirmNextActivity = function () {
                if (this.currentFile !== "end") {
                    if (this.currentFile === "intro") {
                        this.start();
                    }
                    else {
                        this.next();
                    }
                }
            };
            
            this.playActivityAgain = function () {
                this.triesByActivity[this.iterator] = this.triesByActivity[this.iterator] + 1;
                this.answers = [];
                this.inputsMultiple = [];
                this.inputsUnique = [];
                this.correctAnswers = [];
                this.currentAction = 'edit';
                var inputs = document.getElementsByName('choices[]');
                for (var i=0; i<inputs.length; i++) {
                    inputs[i].removeAttribute('disabled');
                }
            };
            
            this.previousActivity = function () {
                if (this.currentAction === "edit") {
                    var modalInstance = this.getModalInstance("previous_activity");
                    modalInstance.result.then(function () {
                        this.confirmPreviousActivity();
                    }.bind(this));
                }
                else {
                    this.confirmPreviousActivity();
                }
            };
            
            this.confirmPreviousActivity = function () {
                if (this.currentFile !== "intro" && this.iterator !== 0) {
                    this.iterator = this.iterator - 1;
                    this.answers = [];
                    this.inputsMultiple = [];
                    this.inputsUnique = [];
                    this.correctAnswers = [];
                    this.currentAction = 'edit';
                    var inputs = document.getElementsByName('choices[]');
                    for (var i=0; i<inputs.length; i++) {
                        inputs[i].removeAttribute('disabled');
                    }
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
            
            this.setTrialValue = function () {
                this.trial = 1;
                for (var i=0; i<this.previousAnswers.length; i++) {
                    if (this.previousAnswers[i].activity.activitySequenceId === this.sequence.id) {
                        if (this.trial <= this.previousAnswers[i].numTrial) {
                            this.trial = this.previousAnswers[i].numTrial + 1;
                        }
                    }
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
                for (var i=0; i<this.sequence.activities.length; i++) {
                    this.triesByActivity.push(0);
                }
                this.setTrialValue();
            };
        }
    ]);
})();