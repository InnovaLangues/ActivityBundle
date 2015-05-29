/**
 * Activity Choice Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';
    angular
        .module('ActivityMediaType')
        .directive('mediaTypeSoundChoice', [
            function () {
                    return {
                        restrict: 'E',
                        replace: false,
                        transclude: true,
                        controller: 'ActivityMediaTypeSoundController',
                        controllerAs: 'activityMediaTypeSndCtrl',
                        scope: {
                            choice: '=',
                            activityType: '=type'
                        },
                        bindToController: true,
                        templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityMediaType/Partials/sound-choice-form.html',
                        
                        link: function (scope, element, attrs, activityMediaTypeSndCtrl) {
                            
                            console.log('directive link function called');
                            /*console.log(activityMediaTypeSndCtrl.choice);
                            console.log(activityMediaTypeSndCtrl.activityType); */                           
                            activityMediaTypeSndCtrl.resourcePickerElement = element[0];
                            activityMediaTypeSndCtrl.appendAudioTagIfNecessary();
                        }
                    };
            }
        ]);
})();