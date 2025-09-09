<?php
//==============================================================================
// Braintree Payment Gateway v303.6
// 
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
// 
// All code within this file is copyright Clear Thinking, LLC.
// You may not copy or reuse code within this file without written permission.
//==============================================================================

$version = 'v303.6';

//------------------------------------------------------------------------------
// Heading
//------------------------------------------------------------------------------
$_['heading_title']						= 'Braintree Payment Gateway';
$_['text_braintree']					= '<a target="_blank" href="https://www.braintreepayments.com/contact-us?source=ClearThinking"><img src="//braintree-badges.s3.amazonaws.com/07.png" alt="Braintree" title="Braintree" /></a>';

//------------------------------------------------------------------------------
// Extension Settings
//------------------------------------------------------------------------------
$_['tab_extension_settings']			= 'Extension Settings';
$_['heading_extension_settings']		= 'Extension Settings';

$_['entry_status']						= 'Status: <div class="help-text">Set the status for the extension as a whole.</div>';
$_['entry_sort_order']					= 'Sort Order: <div class="help-text">Enter the sort order for the extension, relative to other payment methods.</div>';
$_['entry_title']						= 'Title: <div class="help-text">Enter the title for the payment method displayed to the customer. HTML is supported.</div>';

$_['entry_badge_type']					= 'Braintree Badge Type: <div class="help-text">Choose whether to show a <a target="_blank" href="https://www.braintreepayments.com/badge">Braintree badge</a> under the credit card inputs, and if enabled, which style of the badge. You can see examples of the four options on the Braintree badge page. This can cause issues with quick checkouts, so do not use a badge if you are using a quick checkout.</div>';
$_['text_dark']							= 'Dark';
$_['text_light']						= 'Light';
$_['text_wide_dark']					= 'Wide Dark';
$_['text_wide_light']					= 'Wide Light';

$_['entry_button_text']					= 'Button Text: <div class="help-text">Enter the text for the order confirmation button.</div>';
$_['entry_button_class']				= 'Button Class: <div class="help-text">Enter the CSS class for buttons in your theme.</div>';
$_['entry_button_styling']				= 'Button Styling: <div class="help-text">Optionally enter extra CSS styling for the button.</div>';

// Payment Page Text
$_['heading_payment_page_text']			= 'Payment Page Text';
$_['entry_text_loading']				= 'Loading: <div class="help-text">HTML is supported.</div>';
$_['entry_text_please_wait']			= 'Please Wait: <div class="help-text">HTML is supported.</div>';
$_['entry_dropin_locale']				= 'Drop-in UI Locale: <div class="help-text">The Braintree Drop-in UI currently supports 23 languages. The extension will use the following language codes when setting up the Drop-in UI, to translate all text into the customer\'s language. Make sure to use a supported language code for each language in your OpenCart installation:<br><br><table style="float: right; font-family: monospace; text-align: left;"><tr><td style="padding: 0 15px; vertical-align: top">da_DK<br>de_DE<br>en_AU<br>en_GB<br>en_US<br>es_ES<br>fr_CA<br>fr_FR</td><td style="padding: 0 15px; vertical-align: top">id_ID<br>it_IT<br>ja_JP<br>ko_KR<br>nl_NL<br>no_NO<br>pl_PL<br>pt_BR</td><td style="padding: 0 15px; vertical-align: top">pt_PT<br>ru_RU<br>sv_SE<br>th_TH<br>zh_CN<br>zh_HK<br>zh_TW</td></tr></table></div>';
$_['entry_translation_overrides']		= 'Translation Overrides: <div class="help-text">If you want to override any of the default text translations in the Drop-in UI, you can do by entering the values in this field. You can find a full list of the strings you can override <a target="_blank" href="https://github.com/braintree/braintree-web-drop-in/blob/master/src/translations/en_US.js">on this page</a>. For example, to change the "CVV" text to "CVC" and the "Please fill out a CVV" text to "Please fill out a CVC", you would enter this:<br><br><code>cvvLabel: \'CVC\',&nbsp;<br>fieldEmptyForCvv: \'Please fill out a CVC.\',</code></div>';
$_['entry_error_overrides']				= 'Error Overrides: <div class="help-text">If you want to override any of the error messages passed back from Braintree, you can do that by entering the original text, an equals sign, and then the replacement text. Enter each override on a new line. For example:<br><br><code>Processor Declined = We are sorry, but your card was declined.</code></div>';

//------------------------------------------------------------------------------
// Order Statuses
//------------------------------------------------------------------------------
$_['tab_order_statuses']				= 'Order Statuses';
$_['heading_order_statuses']			= 'Order Statuses';
$_['help_order_statuses']				= 'Choose the order statuses set when a payment meets each condition. Note: to actually <strong>deny</strong> payments that fail AVS or CVV Checks, you need to enable the appropriate setting in your Braintree admin panel.<br />Order statuses will be assigned in order of importance: CVV Check > AVS Postcode Check > AVS Street Check.';

$_['entry_success_status_id']			= 'Successful Payment:';
$_['entry_authorize_status_id']			= 'Successful Payment (Authorized):';
$_['entry_mismatch_status_id']			= 'Successful Payment (Address Mismatch): <div class="help-text">This status will apply when the customer\'s shipping address does not match their billing address. It will override both of the two Successful Payment statuses set above. If you set the Charge Mode setting to "Authorize if possible fraudulent", then an address mismatch will also cause the payment to be authorized instead of captured.</div>';
$_['entry_error_status_id']				= 'Order Completion Error: <div class="help-text">This status will apply when the payment is completed successfully, but the order cannot be completed using the normal OpenCart order confirmation functions. This usually happens when you have entered incorrect SMTP settings in System > Settings > Mail, or you have installed modifications that affect customer orders.</div>';
$_['entry_cvv_status_id']				= 'CVV Check Failure:';
$_['entry_postcode_status_id']			= 'AVS Postcode Check Failure:';
$_['entry_street_status_id']			= 'AVS Street Check Failure:';
$_['entry_refund_status_id']			= 'Refunded Payment: <div class="help-text">You can refund a payment by using the link provided in the History tab for the order. Only orders refunded through OpenCart will be assigned this order status.</div>';

$_['text_ignore']						= '--- Ignore ---';

//------------------------------------------------------------------------------
// Restrictions
//------------------------------------------------------------------------------
$_['tab_restrictions']					= 'Restrictions';
$_['heading_restrictions']				= 'Restrictions';

$_['entry_order_status_id']				= 'Order Status: <div class="help-text">Select the order status set for successful payments.</div>';
$_['entry_min_total']					= 'Minimum Total: <div class="help-text">Enter the minimum order total that must be reached before this payment method becomes active. Leave blank to have no restriction.</div>';
$_['entry_max_total']					= 'Maximum Total: <div class="help-text">Enter the maximum order total that can be reached before this payment method becomes active. Leave blank to have no restriction.</div>';
$_['entry_stores']						= 'Store(s): <div class="help-text">Select the stores that can use this payment method.</div>';
$_['entry_geo_zones']					= 'Geo Zone(s): <div class="help-text">Select the geo zones that can use this payment method. The "Everywhere Else" checkbox applies to any locations not within a geo zone.</div>';
$_['entry_customer_groups']				= 'Customer Group(s): <div class="help-text">Select the customer groups that can use this payment method. The "Guests" checkbox applies to all customers not logged in to an account.</div>';
$_['entry_currencies']					= 'Currencies: <div class="help-text">Select the currencies that are eligible for this payment method.</div>';

$_['text_everywhere_else']				= '<em>Everywhere Else</em>';
$_['text_guests']						= '<em>Guests</em>';

//------------------------------------------------------------------------------
// Braintree Settings
//------------------------------------------------------------------------------
$_['tab_braintree_settings']			= 'Braintree Settings';
$_['heading_braintree_settings']		= 'Braintree Settings';

$_['entry_server_mode']					= 'Server Mode: <div class="help-text">Use "Sandbox" to test payments through your Braintree sandbox. For more info on how to test, visit <a href="https://developers.braintreepayments.com/reference/general/testing" target="_blank">this page</a>. Use "Production (Live)" when you&apos;re ready to accept payments.</div>';
$_['text_sandbox']						= 'Sandbox';
$_['text_production']					= 'Production (Live)';

$_['entry_charge_mode']					= 'Charge Mode: <div class="help-text">Choose whether to authorize payments and manually settle them later, or to both authorize and submit for settlement (i.e. fully charge) payments when orders are placed. You can settle a payment that is only Authorized by using the link provided in the History tab for the order.<br /><br />If you choose "Authorize if possibly fraudulent, Submit otherwise" then the extension will use your OpenCart fraud extensions to determine whether an order might be fraudulent. If the fraud score is over your threshold, the charge will be Authorized; if under, the charge will be Submitted for Settlement.</div>';
$_['text_authorize']					= 'Authorize';
$_['text_submit_for_settlement']		= 'Submit for Settlement';
$_['text_fraud_authorize']				= 'Authorize if possibly fraudulent, Submit otherwise';

$_['entry_attempts']					= 'Maximum Number of Allowed Attempts: <div class="help-text">Enter the maximum number of payment attempts customers are allowed to try in one session. This helps prevent fraudsters from running lots of cards through your Stripe account to check if they are valid. Leave this field blank to have no maximum limit.</div>';
$_['entry_attempts_exceeded']			= 'Error When Exceeding Allowed Attempts: <div class="help-text">Enter the error message shown when a customer continues to make payment attempts after exceeding the allowed number of attempts set above.</div>';

$_['entry_store_payment_method']		= 'Store Payment Method in Vault: <div class="help-text">Select whether to store the credit card or other payment method in your Braintree vault. This will allow you to charge them again in the future within Braintree, and allow them to use the stored payment method for future purchases.</div>';
$_['text_never']						= 'Never';
$_['text_customers_choice']				= 'Customer&apos;s choice';
$_['text_always']						= 'Always';

$_['entry_allow_stored_cards']			= 'Allow Customers to Use Stored Cards: <div class="help-text">If set to "Yes", customers that have cards stored in Braintree will be able to use those cards for future purchases in your store, without having to re-enter the information.</div>';
$_['entry_store_billing']				= 'Store Billing Address in Vault: <div class="help-text">Choose whether the customer&apos;s billing address is stored along with their payment method information.</div>';
$_['entry_store_shipping']				= 'Store Shipping Address in Vault: <div class="help-text">Choose whether the customer&apos;s shipping address is stored along with their payment method information.</div>';
$_['entry_advanced_error_handling']		= 'Advanced Error Handling: <div class="help-text">Enabling this will catch errors that occur outside the extension, and record those into the order history. Quick checkout extensions sometimes have issues with this, so if you encounter problems with payments completing but orders not being confirmed, try disabling this setting.</div>';

// Production (Live) API Keys
$_['heading_production_api_keys']		= 'Production (Live) API Keys';
$_['help_production_api_keys']			= 'API Keys can be found in your <b>Braintree</b> admin panel under Account > My user > Authorization > API Keys';

$_['entry_production_public_key']		= 'Public Key:';
$_['entry_production_private_key']		= 'Private Key:';
$_['entry_production_merchant_id']		= 'Merchant ID:';

$_['help_merchant_account_id']			= 'To charge orders in a specific currency when it is selected by the customer, enter the appropriate Merchant Account ID below. These are different than your Merchant ID, and can be found in your Braintree admin panel under Settings > Processing. Leave the fields blank to have the order converted and charged in your default currency.';

$_['text_merchant_account_id']			= ' Merchant Account ID:';

// Sandbox API Keys
$_['heading_sandbox_api_keys']			= 'Sandbox API Keys';
$_['help_sandbox_api_keys']				= 'API Keys can be found in your <b>Sandbox</b> admin panel under Account > My user > Authorization > API Keys';

$_['entry_sandbox_public_key']			= 'Public Key:';
$_['entry_sandbox_private_key']			= 'Private Key:';
$_['entry_sandbox_merchant_id']			= 'Merchant ID:';

//------------------------------------------------------------------------------
// Other Payment Methods
//------------------------------------------------------------------------------
$_['tab_other_payment_methods']			= 'Other Payment Methods';
$_['help_other_payment_methods']		= 'For utilizing payment methods like Apple Pay, Google Pay, PayPal Credit, or Venmo, <a target="_blank" href="http://www.getclearthinking.com/contact">contact Clear Thinking</a> about upgrading to <a target="_blank" href="https://www.opencartx.com/braintree-payment-gateway-pro">Braintree Payment Gateway Pro</a>.';

// 3D Secure
$_['heading_three_d_secure']			= '3D Secure';
$_['entry_three_d_secure']				= '3D Secure: <div class="help-text">Choose whether to enable 3D Secure for credit / debit cards. Cards that are eligible for 3D Secure and fail the 3D Secure check will not be able to be used for payment. For cards that are ineligible for 3D Secure, choose "allow" if you want to accept payments from these cards, or "deny" if you do not want to accept payments.</div>';
$_['text_yes_allow_ineligible_cards']	= 'Yes, allow ineligible cards';
$_['text_yes_deny_ineligible_cards']	= 'Yes, deny ineligible cards';
$_['entry_error_three_d_failure']		= '3D Secure Failure: <div class="help-text">Enter the text displayed when a customer\'s card fails the 3D Secure check, if enabled.</div>';

// PayPal
$_['heading_paypal']					= 'PayPal';
$_['entry_paypal']						= 'PayPal: <div class="help-text">If you enable this, make sure you have also enabled it within your Braintree account in Settings > Processing.</div>';

//------------------------------------------------------------------------------
// Subscription Products
//------------------------------------------------------------------------------
$_['tab_subscription_products']			= 'Subscription Products';
$_['heading_subscription_products']		= 'Subscription Products';
$_['help_subscription_products']		= 'Subscription products will subscribe the customer to the associated Braintree plan when they are purchased. You can associate a product with a plan by entering the Braintree plan ID in the "Location" field for the product.<br /><br />If the subscription is not set to be charged immediately (i.e. it has a trial period), the amount of the subscription will be taken off their original order, and a new order will be created when the subscription is actually charged to their card. Any time Braintree charges the subscription in the future, a corresponding order will be created in OpenCart.';

$_['entry_subscriptions']				= 'Enable Subscription Products:';
$_['entry_webhook_url']					= 'Webhook URL: <div class="help-text">If using subscriptions, copy and paste this URL into your Braintree account, by choosing Settings > Webhooks > New. If you haven&apos;t already, you must first enable webhooks in:<br />Settings > Users and Roles > Manage Roles > Edit > Manage Webhooks.</div>';
$_['help_webhook_url']					= '<div class="help-text">If you change your store&apos;s Encryption Key in System > Settings > Server, this URL will change, so remember to add the new webhook URL in Braintree.</div>';

$_['entry_text_to_be_charged']			= 'To Be Charged Later: <div class="help-text">This text is displayed for the line item on the order invoice when a subscription product has a trial. The line item subtracts the subscription price out of the total, so the customer is not double-charged.</div>';
$_['entry_prevent_guests']				= 'Prevent Guests From Purchasing: <div class="help-text">If set to "Yes", only customers with accounts in OpenCart will be allowed to checkout if a subscription product is in the cart.</div>';
$_['entry_text_customer_required']		= 'Customer Required: <div class="help-text">If guests are not allowed to purchase subscription products, enter the text displayed when a guest tries to check out with a subscription product in their cart.</div>';
$_['entry_subscription_shipping']		= 'Add Shipping and Taxes: <div class="help-text">Choose whether shipping and taxes will be added to the price of future subscription charges. The shipping option with the same name selected by the customer will be used for each subscription product. The new price (subscription price + shipping + taxes) will override the default plan price for as long as the customer is subscribed.</div>';

// Current Subscription Products
$_['heading_current_subscriptions']		= 'Current Subscription Products';
$_['entry_current_subscriptions']		= 'Current Subscription Products: <div class="help-text">Products with mismatching prices are highlighted. The OpenCart product price will override the plan price if different, so you can set subscription products on Special in OpenCart and it will charge the correct Special price.<br /><br />Note: only plans for your Server Mode will be listed. You are currently set to <b>[server_mode]</b> mode.</div>';

$_['text_thead_opencart']				= 'OpenCart';
$_['text_thead_braintree']				= 'Braintree';
$_['text_product_name']					= 'Product Name';
$_['text_product_price']				= 'Product Price';
$_['text_location_plan_id']				= 'Location / Plan ID';
$_['text_plan_name']					= 'Plan Name';
$_['text_plan_interval']				= 'Plan Interval';
$_['text_plan_charge']					= 'Plan Charge';
$_['text_no_subscription_products']		= 'No Subscription Products';
$_['text_create_one_by_entering']		= 'Create one by entering the Braintree plan ID in the "Location" field for the product';

//------------------------------------------------------------------------------
// Standard Text
//------------------------------------------------------------------------------
$_['copyright']							= '<hr /><div class="text-center" style="margin: 15px">' . $_['heading_title'] . ' (' . $version . ') &copy; <a target="_blank" href="http://www.getclearthinking.com/contact">Clear Thinking, LLC</a></div>';

$_['standard_autosaving_enabled']		= 'Auto-Saving Enabled';
$_['standard_confirm']					= 'This operation cannot be undone. Continue?';
$_['standard_error']					= '<strong>Error:</strong> You do not have permission to modify ' . $_['heading_title'] . '!';
$_['standard_max_input_vars']			= '<strong>Warning:</strong> The number of settings is close to your <code>max_input_vars</code> server value. You should enable auto-saving to avoid losing any data.';
$_['standard_please_wait']				= 'Please wait...';
$_['standard_saved']					= 'Saved!';
$_['standard_saving']					= 'Saving...';
$_['standard_select']					= '--- Select ---';
$_['standard_success']					= 'Success!';
$_['standard_testing_mode']				= "Your log is too large to open! If you need to archive it, you can download it using the button above.\n\nTo start a new log, (1) click the Clear Log button, (2) reload the admin panel page, then (3) run your test again.";

$_['standard_module']					= 'Modules';
$_['standard_shipping']					= 'Shipping';
$_['standard_payment']					= 'Payments';
$_['standard_total']					= 'Order Totals';
$_['standard_feed']						= 'Feeds';
?>