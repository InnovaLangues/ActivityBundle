(function () {
    'use strict';

    // activity sequence player module
    angular.module('ActivitySequenceApp', [
        'ngSanitize',
        'ui.bootstrap',
        'ui.tinymce',
        'ui.translation',
        'ui.sortable',

        'Utils',
        'ConfirmModule',
        'ActivitySequence',
        'ActivityPlayer'
    ]);
})();