(function () {
    'use strict';

    angular.module('Activity').controller('ActivityEditController', [
        '$scope',
        'ActivityService',
        function ($scope, ActivityService) {
            $scope.activity = {};

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

            $scope.save = function () {
                console.log($scope.activity);

                // Init
                var method = null;
                var route = null;
                var data = '';

                // Data affectationS
                data += 'activity_sequence_template[typology]=' + $scope.activity.typology;
                data += '&activity_sequence_template[description]=' + scope.activity.description;
                // TODO : à faire pour le reste des datas.

                // Create new path
                method = 'POST';
                route = Routing.generate('activity_sequence_add_activity'); // ActivitySequenceController

                $http({
                    method: method,
                    url: route,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: data
                })

                .success(function (data) {
                    if ('error' != data) {
                        // No error
                        formTemplate.id = data;
                        TemplateFactory.replaceTemplate(formTemplate);

                        AlertFactory.addAlert('success', Translator.get('path_editor:path_template_save_success'));
                    }
                    else {
                        // Server error while saving
                        AlertFactory.addAlert('danger', Translator.get('path_editor:path_template_save_error'));
                    }

                    $modalInstance.close();
                })
                .error(function(data, status) {
                    AlertFactory.addAlert('danger', Translator.get('path_editor:path_template_save_error'));
                });

                // Redirection vers le service : ActivityService.js
                // ActivityService.save($scope.activity);
            };
        }
    ]);
})();