/**
 * Activity Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';

    angular.module('ActivityPlayer').directive('activityPlayerForm', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                controller: 'ActivityPlayerFormController',
                controllerAs: 'activityPlayerCtrl',
                templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityPlayer/Partials/form.html',
                scope: {
                    sequence: '@'
                },
                link: function (scope, element, attr, activityPlayerCtrl) {
                    scope.$watch('sequence', function (newValue) {
                        if (typeof newValue === 'string') {
                            activityPlayerCtrl.sequence = JSON.parse(newValue);
                        } else {
                            activityPlayerCtrl.sequence = newValue;
                        }
                    });
                }
            };
        }
    ]);
})();