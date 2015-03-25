/**
 * Activity Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';

    angular.module('ActivityType').directive('choiceTypeForm', [
        'LoaderService',
        '$http',
        '$q',
        function (LoaderService, $http, $q) {
            return {
                restrict: 'E',
                replace: true,
                controller: 'ChoiceTypeFormController',
                controllerAs: 'choiceTypeCtrl',
                templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityType/Partials/choice-type.html',
                scope: {
                    activityType: '='
                },
                link: function (scope, element, attr, choiceTypeCtrl) {
                    scope.$watch('activityType', function (newValue) {
                        if (typeof newValue === 'string') {
                            choiceTypeCtrl.activityType = JSON.parse(newValue);
                        } else {
                            choiceTypeCtrl.activityType = newValue;
                        }
                    });
                    
                    var deferred = $q.defer();
                    
                    $http
                        .get(Routing.generate('innova_media_type_get'))
                        .success(function (response) {
                            LoaderService.endRequest();
                    
                            choiceTypeCtrl.mediaTypes = response;

                            deferred.resolve(response.data);
                        })
                        .error(function(response) {
                            LoaderService.endRequest();

                            deferred.reject(response);
                        });

                    return deferred.promise;
                    
                }
            };
        }
    ]);
})();