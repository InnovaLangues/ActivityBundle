/**
 * Activity Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';

    angular.module('Activity').directive('activityForm', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                controller: 'ActivityFormController',
                controllerAs: 'activityCtrl',
                templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/Activity/Partials/form.html',
                scope: {
                    activity: '@'
                },
                link: function (scope, element, attr, activityCtrl) {
                    scope.$watch('activity', function (newValue) {
                        if (typeof newValue === 'string') {
                            activityCtrl.activity = JSON.parse(newValue);
                        } else {
                            activityCtrl.activity = newValue;
                        }
                    });
                }
            };
        }
    ]);
})();