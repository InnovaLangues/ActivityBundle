(function () {
    'use strict';

    angular.module('ActivityPlayer').factory('ActivityPlayerService', [
        '$http',
        '$q',
        'LoaderService',
        function ($http, $q, LoaderService) {
            return {
                saveAnswer: function (activityId, answerId) {
                    LoaderService.startRequest();
                    
                    var deferred = $q.defer();
                    
                    $http
                        .post(Routing.generate('innova_answer_create', { 
                            activityId: activityId,
                            answerId: answerId
                        }))
                        .success(function (response) {
                            LoaderService.endRequest();

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