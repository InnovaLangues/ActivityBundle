/**
 * Activity Choice Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';
    angular
        .module('ActivityMediaType')
        .directive('mediaTypeTextChoice', [
            function () {
                    return {
                        restrict: 'E',
                        replace: false,
                        templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityMediaType/Partials/text-choice-form.html',
                        
                        link: function (scope, element, attrs) { 
                            
                        }
                    };
            }
        ]);
})();