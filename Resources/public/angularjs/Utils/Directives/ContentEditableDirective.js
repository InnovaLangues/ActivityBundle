(function(){
    "use strict";
    
    angular.module("Utils").directive("contenteditable", [
        '$timeout',
        function contentEditableDirective($timeout) {
            
            return {
                restrict: "A",
                require: 'ngModel',
                link: function(scope, element, attrs, ctrl) {
                  // view -> model
                  element.bind('blur keyup paste input', function() {
                        console.log(element.html());
                    $timeout(function() {
                      ctrl.$setViewValue(element.html());
                    });
                  });

                  // model -> view
                  ctrl.$render = function() {
                    element.html(ctrl.$viewValue);
                  };

                  // load init value from DOM
                  ctrl.$render();
                }
            };
        }
    ]);
})();