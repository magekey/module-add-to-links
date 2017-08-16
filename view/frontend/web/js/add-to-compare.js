/**
 * Copyright © MageKey. All rights reserved.
 */
define([
    'ko',
    'jquery',
    "Magento_Customer/js/customer-data",
    "MageKey_AddToLinks/js/add-to-link"
], function (ko, $, customerData) {
    "use strict";

    var compareItems = ko.pureComputed(function () {
        var compareProducts = customerData.get('compare-products')();
        if (compareProducts && compareProducts.items) {
            return compareProducts.items;
        }
        return [];
    });

    $.widget('mage.mgkAddToCompare', $.mage.mgkAddToLink, {

        initItem: function () {
            var self = this;
            self.itemId = ko.pureComputed(function () {
                var value = null;
                compareItems().forEach(function (item) {
                    if (item.id == self.options.productId) {
                        value = item.id;
                    }
                });
                return value;
            });
        }
    });

    return $.mage.mgkAddToCompare;
});
