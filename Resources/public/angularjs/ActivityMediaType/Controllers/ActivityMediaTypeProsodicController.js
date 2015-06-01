(function () {
    'use strict';

    angular
            .module('ActivityMediaType')
            .controller('ActivityMediaTypeProsodicController', [
                '$window',
                '$document',
                function ($window, $document) {

                    this.index;
                    this.choice;

                    this.getSelectionParentElement = function () {
                        var parentEl = null, sel;
                        if ($window.getSelection) {
                            sel = $window.getSelection();
                            if (sel.rangeCount) {
                                parentEl = sel.getRangeAt(0).commonAncestorContainer;
                                if (parentEl.nodeType !== 1) {
                                    parentEl = parentEl.parentNode;
                                }
                            }
                        } else if ((sel === $document.selection) && sel.type !== "Control") {
                            parentEl = sel.createRange().parentElement();
                        }
                        return parentEl;
                    };

                    this.getSelectedText = function () {
                        var txt = '';
                        if ($window.getSelection) {
                            txt = $window.getSelection();
                        } else if ($window.document.getSelection) {
                            txt = $window.document.getSelection();
                        } else if ($window.document.selection) {
                            txt = $window.document.selection.createRange().text;
                        }
                        return txt;
                    };

                    this.manualTextAnnotation = function (text, css) {
                        if (!css) {
                            $window.document.execCommand('insertHTML', false, css);
                        } else {
                            $window.document.execCommand('insertHTML', false, '<span class="' + css + '">' + text + '</span>');
                        }
                    };

                    this.annotate = function (color) { 
                        console.log('yep');
                        var text = this.getSelectedText();
                        var elem = this.getSelectionParentElement();
                        var id = "choice-" + this.index.toString();
                        while (elem.tagName !== "LI") {
                            elem = elem.parentNode;
                        }
                        if (text !== '' && elem.id === id) {
                            this.manualTextAnnotation(text, 'accent-' + color);
                        }
                    }.bind(this);

                }
            ]);
})();