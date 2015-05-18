/**
 * Activity Form directive
 * Directive Documentation : https://docs.angularjs.org/guide/directive
 */
(function () {
    'use strict';

    angular.module('ActivityPlayer').directive('activityPlayerForm', [
        'LoaderService',
        '$http',
        '$q',
        function (LoaderService, $http, $q) {
            return {
                restrict: 'E',
                replace: true,
                controller: 'ActivityPlayerFormController',
                controllerAs: 'activityPlayerCtrl',
                templateUrl: ActivityEditorApp.webDir + 'bundles/innovaactivity/angularjs/ActivityPlayer/Partials/form.html',
                scope: {
                    sequence: '@'
                },
                link: function (scope, element, attr, activityPlayerCtrl) {
                    scope.$watch('sequence', function (newValue) {
                        if (typeof newValue === 'string') {
                            activityPlayerCtrl.sequence = JSON.parse(newValue);
                        } else {
                            activityPlayerCtrl.sequence = newValue;
                        }
                    });
                    
                    var deferred = $q.defer();
                    
                    $http
                        .get(Routing.generate('innova_users_answers_get'))
                        .success(function (response) {
                            LoaderService.endRequest();
                    
                            activityPlayerCtrl.previousAnswers = response;

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