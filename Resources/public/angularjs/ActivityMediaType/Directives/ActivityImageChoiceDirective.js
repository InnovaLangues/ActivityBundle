/**
 * Activity Choice Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';
    angular
        .module('ActivityMediaType')
        .directive('mediaTypeImageChoice', [
            function () {
                    return {
                        restrict: 'E',
                        replace: false,
                        //transclude: true,
                        controller: 'ActivityMediaTypeImageController',
                        controllerAs: 'activityMediaTypeImgCtrl',
                        scope: {
                            choice: '=',
                            activityType: '=type'
                        },
                        bindToController: true,
                        templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityMediaType/Partials/image-choice-form.html',
                        
                        link: function (scope, element, attrs, activityMediaTypeImgCtrl) {  
                            activityMediaTypeImgCtrl.resourcePickerElement = element[0];
                            activityMediaTypeImgCtrl.appendTagIfNecessary();
                        }
                    };
            }
        ]);
})();