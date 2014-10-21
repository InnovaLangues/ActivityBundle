(function () {
    'use strict';

    angular.module('Loader').factory('LoaderService', [function () {
        var requestCount = { count: 0};

        return {
            getRequestCount: function(){
                return requestCount;
            },

            startRequest: function() {
                requestCount.count++;

                return this;
            },

            endRequest: function() {
                requestCount.count--;

                return this;
            },

        };  
    }]);
})();