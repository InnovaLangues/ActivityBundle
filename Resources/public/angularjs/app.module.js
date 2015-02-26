(function () {
    'use strict';

    angular.module('ActivityApp', [
        'ui.bootstrap',
        'ui.tinymce',
        'ui.translation',

        'Activity',
        'Loader',
        'ActivityAvailable',
        'ActivityType'
    ]);
})();