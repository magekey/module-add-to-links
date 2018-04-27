/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'ko'
], function ($, ko) {
    "use strict";

    $.widget('mage.mgkAddToLink', {

        actionReturn: false,
        actionElement: null,
        options: {
            productId: null,
            addParams: {},
            removeParams: {},
            checkedClass: 'checked',
            actionSelector: null
        },

        _create: function () {
            var self = this;

            self.checked = ko.observable(false);
            self.itemId = ko.observable(false);

            self._initOptions();
            self._subscribeEvents();
            self._initItem();
            self._bindElement();
        },

        _initOptions: function () {
            var self = this;
            if (self.options.actionSelector) {
                self.actionElement = self.element.find(self.options.actionSelector);
            } else {
                self.actionElement = self.element;
            }
            if (self.actionElement.is(':checkbox')) {
                self.actionReturn = true;
            }
        },

        _subscribeEvents: function () {
            var self = this;
            self.checked.subscribe(function (val) {
                self.updateElementState();
            });
            self.itemId.subscribe(function (val) {
                self.checked(val ? true : false);
            });
        },

        _initItem: function () {
        },

        _bindElement: function () {
            var self = this;

            self.actionElement.on({
                'click': self.clickAction.bind(self)
            });
        },

        updateElementState: function () {
            var self = this;
            if (this.checked()) {
                self.element.addClass(self.options.checkedClass);
                if (self.actionElement.is(':checkbox')) {
                    self.actionElement.prop('checked', true);
                }
            } else {
                self.element.removeClass(self.options.checkedClass);
                if (self.actionElement.is(':checkbox')) {
                    self.actionElement.prop('checked', false);
                }
            }
        },

        triggerElementState: function () {
            this.checked(!this.checked());
        },

        clickAction: function () {
            this.triggerElementState();
            this._sendAction();
            return this.actionReturn;
        },

        _sendAction: function (callback) {
            var self = this;
            if (self.checked()) {
                var data = self.options.addParams.data;
                var action = self.options.addParams.action;
            } else {
                var data = self.options.removeParams.data;
                var action = self.options.removeParams.action;
                data.item = self.itemId();
            }
            data.form_key = $.mage.cookies.get('form_key');
            $.ajax({
                url: action,
                type: 'POST',
                data: data,
                success: function (response) {
                    if (callback) {
                        callback(response);
                    }
                }
            });
        }
    });

    return $.mage.mgkAddToLink;
});
