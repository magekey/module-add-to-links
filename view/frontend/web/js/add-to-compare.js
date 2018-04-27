/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'jquery',
    'ko',
    'underscore',
    "Magento_Customer/js/customer-data",
    "MageKey_AddToLinks/js/add-to-link"
], function ($, ko, _, customerData) {
    "use strict";

    var compareProductsIds = ko.observable({});
    customerData.get('compare-products').subscribe(function (data) {
        var ids = {};
        _.each(data.items, function (item) {
            ids[item.id] = true;
        });
        compareProductsIds(ids);
    });

    $.widget('mage.mgkAddToCompare', $.mage.mgkAddToLink, {

        _initItem: function () {
            var self = this;
            compareProductsIds.subscribe(function (ids) {
                if (typeof ids[self.options.productId] != 'undefined') {
                    self.itemId(self.options.productId);
                } else {
                    self.itemId(false);
                }
            });
        }
    });

    return $.mage.mgkAddToCompare;
});
