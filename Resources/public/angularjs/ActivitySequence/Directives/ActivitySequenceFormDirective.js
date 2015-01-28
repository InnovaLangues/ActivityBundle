/**
 * ActivitySequence Form directive
 */
(function () {
    'use strict';

    angular.module('ActivitySequence').directive('activitySequenceForm', [
        '$filter',
        function ($filter) {
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

                    scope.$watch('sequence.activities', function (newValue) {
                        // Show the first activity of the Sequence
                        activitySequenceCtrl.showActivity();
                    });

                    // Watch for child Activities delete event
                    scope.$on('activityDelete', function (event, activity) {
                        console.log('activity deleted');
                        activitySequenceCtrl.removeActivity(activity);
                        activitySequenceCtrl.showActivity();
                    });
                }
            };
        }
    ]);
})();