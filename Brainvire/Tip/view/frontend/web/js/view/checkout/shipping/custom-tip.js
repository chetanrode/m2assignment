/*global define*/
define([
    'Magento_Ui/js/form/form',
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Catalog/js/price-utils',
    'Brainvire/Tip/Helper/Data'

], function(Component) {
    'use strict';
    return Component.extend({
        initialize: function () {
            this._super();
            // component initialization logic
            return this;
        },

        defaults: {
            template: 'Brainvire_Tip/checkout/shipping/custom-tip'
        },
        /**
         * Form submit handler
         *
         * This method can have any name.
         */
        onSubmit: function() {


            // trigger form validation
            this.source.set('params.invalid', false);
            this.source.trigger('customCheckoutForm.data.validate');

            // verify that form data is valid
            if (!this.source.get('params.invalid')) {
                // data is retrieved from data provider by value of the customScope property
                var formData = this.source.get('customCheckoutForm');
                // do something with form data
                console.dir(formData);

            }
        }
    });
});
