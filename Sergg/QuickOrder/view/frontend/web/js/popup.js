define([
    "jquery",
    'Magento_Customer/js/customer-data',
    "jquery/ui"
], function ($) {
    "use strict";
    $.widget('popup.js', {
        _create: function () {
            this.initFormObserver();
        },

        initFormObserver: function () {
            var formQuickOrder = $(this.element);
            var _self = this;
            formQuickOrder.on('submit', function (e) {
                if (!formQuickOrder.valid()) {
                    return false;
                }
                var formData = formQuickOrder.serialize() + "&" + $("#product_addtocart_form").serialize();
                var formAction = _self.element.attr('action');
                var formMethod = _self.element.attr('method');
                $.ajax({
                    url: formAction,
                    type: formMethod,
                    data: formData,
                    success: function (transport) {
                        _self.onPlaceOrder(transport)
                    },
                    showLoader: true
                });
                e.preventDefault();
                return false;
            });
        },

        onPlaceOrder: function (response) {
            if (response.is_error && !response.is_success) {
                this.showError(response.messages);
            }
            if (!response.is_error && response.is_success) {
                this.successProcess(response);
            }
        },

        successProcess: function (response) {
            this.hideError();
            window.location = response.success_url;
        },

        showError: function (msg) {
            var errorsText = '';
            $.each(msg, function (index, value) {
                errorsText += value + '<br/>';
            });
            $('#quickorder-warning').html(errorsText).show();
        },

        hideError: function () {
            // clean previous error message
            $('#quickorder-warning').html('').hide()
        }

    });
    return $.popup.js;
});
