/**
 * Activity Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';

    angular.module('ActivityPlayer').directive('activityPlayer', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                controller: 'ActivityPlayerController',
                controllerAs: 'activityPlayerCtrl',
                templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityPlayer/Partials/form.html',
                scope: {
                    activity: '@'
                },
                link: function (scope, element, attr, activityPlayerCtrl) {
                    scope.$watch('activity', function (newValue) {
                        if (typeof newValue === 'string') {
                            activityPlayerCtrl.activity = JSON.parse(newValue);
                        } else {
                            activityPlayerCtrl.activity = newValue;
                        }
                    });
                }
            };
        }
    ]);
})();