/**
 * Activity Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';

    angular.module('ActivityType').directive('UniqueChoiceType', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                controller: 'UniqueChoiceTypeController',
                controllerAs: 'uniqueChoiceCtrl',
                templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityType/Partials/UniqueChoiceType-edit.html',
                scope: {
                    choice: '@'
                }
            };
        }
    ]);
})();