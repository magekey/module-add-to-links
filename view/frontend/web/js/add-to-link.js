/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery'
], function ($) {
    "use strict";

    $.widget('mage.mgkAddToLink', {

        activeCheck: false,
        options: {
            productId: null,
            addParams: {},
            removeParams: {},
            checkedClass: 'checked'
        },

        _create: function () {
            var self = this;
            self.initItem();
            self.initElement();
            self.initValue();
            self.bindElement();
        },

        initItem: function () {
            return;
        },

        initElement: function () {
            var self = this;
            if (self.element.is(':checkbox')) {
                self.activeCheck = true;
            }
        },

        initValue: function () {
            var self = this;
            if (self.itemId()) {
                self.checkElementState();
                if (self.activeCheck) {
                    self.element.prop('checked', true);
                }
            }
        },

        getElementState: function () {
            var self = this;
            return self.element.hasClass(self.options.checkedClass);
        },

        checkElementState: function () {
            var self = this;
            self.element.addClass(self.options.checkedClass);
        },

        uncheckElementState: function () {
            var self = this;
            self.element.removeClass(self.options.checkedClass);
        },

        triggerElementState: function () {
            if (this.getElementState()) {
                this.uncheckElementState();
            } else {
                this.checkElementState();
            }
        },

        bindElement: function () {
            var self = this;
            self.element.on({
                'click': self.clickAction.bind(self)
            });
        },

        clickAction: function () {
            var self = this;
            self.triggerElementState();
            self.sendAction();
            return self.activeCheck;
        },

        sendAction: function () {
            var self = this;
            if (self.getElementState()) {
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
                data: data
            });
        }
    });

    return $.mage.mgkAddToLink;
});
