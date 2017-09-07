/**
 * Copyright © MageKey. All rights reserved.
 */
define([
    'ko',
    'jquery',
    'Magento_Customer/js/customer-data',
    'Magento_Customer/js/model/authentication-popup',
    'MageKey_AddToLinks/js/add-to-link'
], function (ko, $, customerData, authenticationPopup) {
    "use strict";

    var wishlistItems = ko.pureComputed(function () {
        var wishlist = customerData.get('wishlist_items')();
        if (wishlist && wishlist.items) {
            return wishlist.items;
        }
        return [];
    });

    $.widget('mage.mgkAddToWishlist', $.mage.mgkAddToLink, {

        options: {
            showAuthPopupIfAvailable: true,
            loginUrl: null
        },

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
                return self._super();
            } else {
                if (self.options.showAuthPopupIfAvailable && authenticationPopup.modalWindow != null) {
                    authenticationPopup.showModal();
                } else if(self.options.loginUrl) {
                    window.location.href = self.options.loginUrl;
                }
            }
            return false;
        }
    });

    return $.mage.mgkAddToWishlist;
});
