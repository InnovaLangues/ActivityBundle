(function () {
    'use strict';

    angular.module('Activity').controller('ActivityEditController', [
        '$scope',
        'ActivitySequenceService',
        'ActivityService',
        function ($scope, ActivitySequenceService, ActivityService) {
            $scope.currentActivity = ActivitySequenceService.getCurrentActivity();

            // Tiny MCE options
            $scope.tinymceOptions = {
                relative_urls: false,
                theme: 'modern',
                browser_spellcheck : true,
                autoresize_min_height: 100,
                autoresize_max_height: 500,
                plugins: [
                    'autoresize advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars fullscreen',
                    'insertdatetime media nonbreaking save table directionality',
                    'template paste textcolor emoticons code'
                ],
                toolbar1: 'undo redo | styleselect | bold italic underline | forecolor | alignleft aligncenter alignright | preview fullscreen',
                paste_preprocess: function (plugin, args) {
                    var link = $('<div>' + args.content + '</div>').text().trim(); //inside div because a bug of jquery
                    var url = link.match(/^(((ftp|https?):\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})$/);

                    if (url) {
                        args.content = '<a href="' + link + '">' + link + '</a>';
                        window.Claroline.Home.generatedContent(link, function (data) {
                            insertContent(data);
                        }, false);
                    }
                }
            };

            // Save function : datas and call Symfony Root controller
            $scope.save = function () {
                ActivityService.save($scope.currentActivity);
                console.log($scope.currentActivity);
            };
        }
    ]);
})();