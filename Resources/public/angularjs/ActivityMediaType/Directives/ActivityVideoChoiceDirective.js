/**
 * Activity Choice Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';
    angular
        .module('ActivityMediaType')
        .directive('mediaTypeVideoChoice', [
            function () {
                    return {
                        restrict: 'E',
                        replace: false,
                        //transclude: true,
                        controller: 'ActivityMediaTypeVideoController',
                        controllerAs: 'activityMediaTypeVideoCtrl',
                        scope: {
                            choice: '=',
                            activityType: '=type'
                        },
                        bindToController: true,
                        templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityMediaType/Partials/video-choice-form.html',
                        
                        link: function (scope, element, attrs, activityMediaTypeVideoCtrl) { 
                            activityMediaTypeVideoCtrl.resourcePickerElement = element[0];
                            activityMediaTypeVideoCtrl.appendTagIfNecessary();
                        }
                    };
            }
        ]);
})();