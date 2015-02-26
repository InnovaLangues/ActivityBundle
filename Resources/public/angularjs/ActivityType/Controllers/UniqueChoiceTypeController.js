(function () {
    'use strict';

    angular.module('ActivityType').controller('UniqueChoiceTypeController', [
        '$scope',

        function ($scope) {
            
            this.webDir = ActivityEditorApp.webDir;
            
            this.choice = {};
            
            $scope.addChoice = function () {
                console.log("test");
                /*
                this.uniqueChoiceType.choices.push({
                    id:1 , 
                    media: "media1"
                });
                */
            };

            $scope.removeChoice = function () {

            };
        }
    ]);
})();