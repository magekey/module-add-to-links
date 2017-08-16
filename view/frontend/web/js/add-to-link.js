/**
 * Copyright © MageKey. All rights reserved.
 */
define([
    'jquery'
], function ($) {
    "use strict";

    $.widget('mage.mgkAddToLink', {

        options: {
            productId: null,
            addParams: {},
            removeParams: {},
            checkedClass: 'checked'
        },

        _create: function () {
            var self = this;
            self.initItem();
            self.initValue();
            self.bindElement();
        },

        initItem: function () {
            return;
        },

        initValue: function () {
            var self = this;
            if (self.itemId()) {
                self.triggerCheck(true);
            }
        },

        triggerCheck: function (checked) {
            var self = this;
            if (typeof checked == 'undefined') {
                checked = !self.element.hasClass(self.options.checkedClass);
            }
            if (checked) {
                self.element.addClass(self.options.checkedClass);
            } else {
                self.element.removeClass(self.options.checkedClass);
            }
            return checked;
        },

        bindElement: function () {
            var self = this;
            self.element.on({
                'click': self.clickAction.bind(self)
            });
        },

        clickAction: function () {
            this.sendAction();
            return false;
        },

        sendAction: function () {
            var self = this,
                checked = self.triggerCheck();
            if (checked) {
                var data = self.options.addParams.data;
                var action = self.options.addParams.action;
            } else {
                var data = self.options.removeParams.data;
                var action = self.options.removeParams.action;
                data.item = self.itemId();
            }
            data.form_key = $('input[name="form_key"]').val();
            $.ajax({
                url: action,
                type: 'POST',
                data: data
            });
        }
    });

    return $.mage.mgkAddToLink;
});
