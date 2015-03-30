(function () {
    'use strict';

    angular.module('ActivityApp', [
        'ngSanitize',
        'ui.bootstrap',
        'ui.tinymce',
        'ui.translation',
        'ui.sortable',

        'Utils',
        'ConfirmModule',
        'Activity',
        'Loader'
    ]);
})();