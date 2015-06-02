/**
 * Activity Choice Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';
    angular
        .module('ActivityMediaType')
        .directive('mediaTypeProsodicChoice', [
            function () {
                    return {
                        restrict: 'E',
                        replace: false,
                        controller: 'ActivityMediaTypeProsodicController',
                        controllerAs: 'activityMediaTypeProsodicCtrl',
                        templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityMediaType/Partials/prosodic-choice-form.html',
                        
                        link: function (scope, element, attrs, activityMediaTypeProsodicCtrl) {  
                            //console.log('youpi');
                        }
                    };
            }
        ]);
})();