(function(){
    "use strict";
    
    angular.module("Utils").directive("contenteditable", [
        function contentEditableDirective() {
            
            return {
                restrict: "A",
                require: 'ngModel',
                link: function(scope, element, attrs, ctrl) {
                  // view -> model
                  element.bind('focusout hashchange', function() {
                        console.log(element.html());
                    scope.$apply(function() {
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