/**
 * ActivitySequence Form directive
 */
(function () {
    'use strict';

    angular.module('ActivitySequence').directive('activitySequenceForm', [
        function () {
            return {
                restrict: 'E',
                replace: true,
                controller: 'ActivitySequenceFormController',
                controllerAs: 'activitySequenceCtrl',
                templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivitySequence/Partials/form.html',
                scope: {
                    sequence: '@'
                },
                link: function (scope, element, attr, activitySequenceCtrl) {
                    scope.$watch('sequence', function (newValue) {
                        if (typeof newValue === 'string') {
                            activitySequenceCtrl.sequence = JSON.parse(newValue);
                        } else {
                            activitySequenceCtrl.sequence = newValue;
                        }
                    });
                }
            };
        }
    ]);
})();