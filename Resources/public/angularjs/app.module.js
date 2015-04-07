(function () {
    'use strict';

    angular.module('ActivitySequenceApp', [
        'ngSanitize',
        'ui.bootstrap',
        'ui.tinymce',
        'ui.translation',
        'ui.sortable',

        'Utils',
        'ConfirmModule',
        'ActivitySequence',
        'Loader'
    ]);
})();