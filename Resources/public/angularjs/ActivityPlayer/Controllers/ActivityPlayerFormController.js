(function () {
    'use strict';

    angular.module('ActivityPlayer').controller('ActivityPlayerFormController', [
        'ActivityPlayerService',
        function (ActivityPlayerService) {
            this.webDir = ActivityEditorApp.webDir;

            this.view = 'properties';

            this.sequence = {};
            
            this.iterator = 0;
            
            this.randomSort = function(choice) {
                this.value = null;
                if (this.sequence.activities[this.iterator].type.randomlyOrdered) {
                    this.value = Math.random();
                }
                else {
                    this.value = "id";
                }
                return this.value;
            }.bind(this);
            
            this.next = function () {
                this.iterator = this.iterator + 1;
            };
        }
    ]);
})();