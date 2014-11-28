/**
 * Activity Form directive
 */
(function () {
    'use strict';

    angular.module('Activity').directive('activityForm', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                controller: 'ActivityEditController',
                controllerAs: 'ctrl',
                templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/Activity/Partials/edit.html',
                scope: {
                    activity: '='
                },
                link: function (scope, element, attr, ctrl) {
                    scope.$watch('activity', function (newValue) {
                        ctrl.activity = newValue;
                    });
                }
            };
        }
    ]);
})();