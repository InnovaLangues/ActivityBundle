(function () {
    'use strict';

    angular.module('ActivityPlayer').controller('ActivityPlayerFormController', [
        'ActivityPlayerService',
        function (ActivityPlayerService) {
            this.webDir = ActivityEditorApp.webDir;

            this.view = 'properties';

            this.sequence = {};
            
            this.iterator = 0;
            
            this.next = function () {
                this.iterator = this.iterator + 1;
            };
        }
    ]);
})();