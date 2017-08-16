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

    var wishlistItems = ko.pureComputed(function () {
        var wishlist = customerData.get('wishlist_items')();
        if (wishlist && wishlist.items) {
            return wishlist.items;
        }
        return [];
    });

    $.widget('mage.mgkAddToWishlist', $.mage.mgkAddToLink, {

        initItem: function () {
            var self = this;
            self.itemId = ko.pureComputed(function () {
                var value = null;
                wishlistItems().forEach(function (item) {
                    if (item.product_id == self.options.productId) {
                        value = item.item_id;
                    }
                });
                return value;
            });
        },

        clickAction: function () {
            var self = this,
                customer = customerData.get('customer');
            if (customer && customer().firstname) {
                self.sendAction();
            } else {

            }
            return false;
        }
    });

    return $.mage.mgkAddToWishlist;
});
