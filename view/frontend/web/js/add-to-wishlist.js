/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
define([
    'ko',
    'jquery',
    'Magento_Customer/js/customer-data',
    'Magento_Customer/js/model/authentication-popup',
    'MageKey_AddToLinks/js/add-to-link'
], function (ko, $, customerData, authenticationPopup) {
    "use strict";

    var wishlistItemsIds = ko.observable({});
    customerData.get('wishlist-items').subscribe(function (data) {
        var ids = {};
        _.each(data.items, function (item) {
            ids[item.product_id] = item.item_id;
        });
        wishlistItemsIds(ids);
    });

    $.widget('mage.mgkAddToWishlist', $.mage.mgkAddToLink, {

        options: {
            showAuthPopupIfAvailable: true,
            loginUrl: null
        },

        _initItem: function () {
            var self = this;
            wishlistItemsIds.subscribe(function (ids) {
                if (typeof ids[self.options.productId] != 'undefined') {
                    self.itemId(ids[self.options.productId]);
                } else {
                    self.itemId(false);
                }
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
                } else if (self.options.loginUrl) {
                    window.location.href = self.options.loginUrl;
                }
            }
            return false;
        }
    });

    return $.mage.mgkAddToWishlist;
});