define(
    [
        'jquery',
        'ko'
    ], function (
        $,
        ko
    ) {
        'use strict';

        return function (target) {
            return target.extend({
            setShippingInformation: function () {
                    window.location.href = window.location.origin+"/index.php/default/checkout/cart/";
                    this._super();
                }
            });
        }
    }
);
