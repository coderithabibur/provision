<?php
// Heading
$_['heading_title']   		 = 'UKSB Google Merchant v4.1.0';

// Text   
$_['text_extension']         = 'Extensions';
$_['text_edit']      	 	 = 'Edit Feed Settings';
$_['text_feed']      	 	 = 'Product Feeds';
$_['text_success']    	 	 = 'Success: You have modified the UKSB Google Merchant feed!';
$_['text_model']			 = 'Model field';
$_['text_location']			 = 'Location field';
$_['text_gtin']				 = 'GTIN field';
$_['text_mpn']				 = 'MPN field';
$_['text_default']				 = 'UPC, EAN, JAN or ISBN field';
$_['text_none']				 = ' --- None --- ';
$_['text_no']				 = 'No';
$_['text_yes']				 = 'Yes';
$_['text_sku']				 = 'SKU field';
$_['text_gpc_gb']			= 'English GB';
$_['text_gpc_us']			= 'English US';
$_['text_gpc_au']			= 'English';
$_['text_gpc_fr']			= 'French';
$_['text_gpc_de']			= 'German';
$_['text_gpc_it']			= 'Italian';
$_['text_gpc_nl']			= 'Dutch';
$_['text_gpc_es']			= 'Spanish';
$_['text_gpc_pt']			= 'Portuguese';
$_['text_gpc_cz']			= 'Czech';
$_['text_gpc_jp']			= 'Japanese';
$_['text_gpc_da']			= 'Danish';
$_['text_gpc_no']			= 'Norwegian';
$_['text_gpc_pl']			= 'Polish';
$_['text_gpc_ru']			= 'Russian';
$_['text_gpc_sv']			= 'Swedish';
$_['text_gpc_tr']			= 'Turkish';

$_['text_initialise_data'] = 'Create Data';
$_['text_initialise_data_text'] = '<p>If you have not already done so, please make sure you have done a full database backup.</p><p>When ready, please click the button below.</p><p style="color:red;">If the server times out, you can run this process again to continue where it left off.</p>';
$_['text_free_support_remaining'] = 'You have <strong><span style="color:red;">%s</span></strong> days of free support remaining - <a href="https://support.uksitebuilder.net" target="_blank">Visit Support Now</a>';
$_['text_free_support_expired'] = '<span style="color:red;">Your 12 months of free support has expired</span> - <a href="https://secureserverssl.co.uk/opencart-extensions/google-merchant/free-support.php?path=%d&ssl=%d&domain=%s&ext=%s&token=%s&type=1">Extend Now</a>';

// Entry
$_['tab_google_settings']	 =	'Google Merchant Settings';
$_['tab_google_feeds']	 =	'Google Merchant Feeds';
$_['tab_bulk_update']	 =	'Bulk Update Products';
$_['tab_videos']	 =	'Video Tutorials';

$_['entry_variant_section']	 =	'Clothing &amp; Apparel and Variant Products';
$_['entry_adwords_section']	 =	'Google Adwords Attributes';
$_['entry_free_support']     = 'Free Support';
$_['entry_status']    	 	 = 'Status';
$_['entry_google_category']  = 'Default Google Product Category';
$_['entry_choose_google_category']  = 'Click Here to choose your default Google Product Category';
$_['entry_choose_google_category_xml']  = 'Click the blue \'+\' icon to choose your Google Product Category for each Google Site you have chosen to list on.';
$_['entry_mpn']  			 = 'Manufacturer\'s Part Number';
$_['entry_gtin']  			 = 'GTIN Number';
$_['entry_characters']  	 = 'Fix Non-Standard Characters';
$_['entry_split'] 			 = 'Split Feed';
$_['entry_cron'] 			 = 'Advanced Feed Creation:';
$_['entry_site'] 			 = 'Google Shopping Site';
$_['entry_info']  			 = 'Information';
$_['entry_data_feed']   	 = 'Data Feed URL';
$_['entry_cron_data_feed']   	 = 'Cron Feed URL';
$_['entry_cron_code']   	 = 'Cron Command URL';

// Help
$_['help_google_category']	 = 'You should choose here the default Google Product Category that best fits the majority of your products in the country(s) you will be listing on.<br><br>These can then be overridden in the Feed tab when editing a category and likewise when editing a product.';
$_['help_mpn']				 = 'By default this is set to use the Model field from the product data tab when editing a product.<br><br>However, you can choose to use the MPN field (recommended) when editing a product.';
$_['help_gtin']				 = 'By default this is set to use the UPC or EAN or JAN or ISBN field (in OC 1.5.4 onwards), from the product data tab when editing a product.<br><br>However, you can choose to use the new GTIN field added by this extension on the new Feed tab when editing a product.';
$_['help_characters']		 = 'Setting this option to Enabled will attempt to fix any XML errors caused by non standard or incorrectly encoded characters.';
$_['help_split']			 = 'If your server is timing out or runs out of memory due to your store having a lot of products, you can choose to split your feed into multiple feeds containing the number of products you set here.';
$_['help_split_help']	     = 'Please Save the feed settings, then return here to see your new Data Feed URL\'s on the Google Merchant Feeds tab.';
$_['help_cron']			 = 'Rather than using the Split Feed option which results in having several feeds that need submitting individually to Google, you can set up a cron job which will run automatically and which will generate one large feed. See the Google Merchant Feeds tab for the path to use for each country\'s feed.<br><br>Enabling this feature will Disable the Split Feed option.';
$_['help_cron_code']			 = '<h2>Cron Help</h2><p>If using the cron method for auto generating your feeds, you should set the timing of the cron job to be at least one hour before the time you schedule with Google to fetch your feed. This will give the script enough time to generate the feed file.</p><p style="color:red;">You should consult your server host with any questions you have for setting up a cron job.</p><p>Alternatively, you can also set-up a web-based Cron via <a href="https://www.easycron.com?ref=25438" target="_blank">Easy Cron</a>. Make sure you set the Timezone in your account correctly if using this method.</p>';
$_['help_site']		  		 = 'You can choose to list on multiple Google Shopping Sites by choosing the Google Shopping site here.<br><br>PLEASE NOTE - You must have the correct currency and language installed in OC and live on your store for each site you wish to list on.<br><br>After choosing a site, the Data Feed URL will change to suit.';
$_['help_info']				 = 'This Extension is brought to you by <a style="cursor:pointer;" onclick="window.open(\'http://www.opencart.com/index.php?route=extension/extension&filter_username=uksitebuilder\',\'uksb\');" title="Web Design, E-Commerce Solutions and Application Development">UK Site Builder Ltd</a>.<br>For more great OpenCart extensions, please visit <a style="cursor:pointer;" onclick="window.open(\'http://www.opencart.com/index.php?route=extension/extension&filter_username=uksitebuilder\',\'extensions\');">UKSB OpenCart Extensions</a>.';
$_['warning_nogpc']	 	 = '<span style="color:red;"><b>Warning</b></span><br><br>You have not chosen a Default Google Product Category in the UKSB Google Merchant Feed settings.<br><br>If the Google site you are wishing to list on requires a Google Product Category, you should set one now in the Feed Settings.';

// Error
$_['error_permission'] 		 = 'Warning: You do not have permission to modify the UKSB Google Merchant feed!';
$_['error_duplicate'] 		 = 'Warning: You cannot have the same fields for both (Manufacturer\'s Part Number) and (EAN or UPC or ISBN Number)!';
$_['error_bulk_ignored'] 		 = 'Warning: You need to uncheck \'Ignore\' next to the fields you wish to update!';

// Google Merchant Edit Product & Bulk Update Settings
$_['tab_google']			 = 'Feed';
$_['entry_ignore']		 = 'Ignore ';
$_['entry_p_on_google']		 = 'List on Google Shopping';
$_['entry_p_promotion_id']		 = 'Promotion ID';
$_['entry_p_expiry_date']			 = 'Expiry Date';
$_['entry_p_identifier_exists']	 = 'Identifier Exists';
$_['entry_p_condition']		 = 'Condition';
$_['entry_p_brand']			 = 'Brand';
$_['entry_p_mpn']			 = 'MPN';
$_['entry_p_gtin']			 = 'GTIN';
$_['entry_p_google_category'] = 'Google Product Category';
$_['link_google_category']	 = 'Click Here to choose your Google Product Category';
$_['entry_p_multipack']			 = 'Multipack';
$_['entry_p_is_bundle']			 = 'Bundle';
$_['entry_p_adult']			 = 'Adult';
$_['entry_p_energy_efficiency_class']			 = 'Energy Class';
$_['entry_p_unit_pricing_measure']			 = 'Unit Pricing Measure';
$_['entry_p_unit_pricing_base_measure']			 = 'Unit Pricing Base Measure';
$_['entry_p_gender']			 = 'Gender';
$_['entry_p_age_group']		 = 'Age Group';
$_['entry_p_size_type']			 = 'Size Type';
$_['entry_p_size_system']			 = 'Size System';
$_['entry_p_colour']			 = 'Colour';
$_['entry_p_size']			 = 'Size';
$_['entry_p_material']		 = 'Material';
$_['entry_p_pattern']		 = 'Pattern';
$_['entry_v_mpn']			 = 'MPN';
$_['entry_v_gtin']			 = 'GTIN';
$_['entry_v_prices']			 = 'Price Difference';
$_['button_remove']			 = 'Remove';
$_['button_add_variant']			 = 'Add Variant';
$_['entry_p_custom_label_0']			 = 'Custom Label 0';
$_['entry_p_custom_label_1']			 = 'Custom Label 1';
$_['entry_p_custom_label_2']			 = 'Custom Label 2';
$_['entry_p_custom_label_3']			 = 'Custom Label 3';
$_['entry_p_custom_label_4']			 = 'Custom Label 4';
$_['entry_p_adwords_redirect']	 = 'Adwords Redirect';
$_['entry_help_section']			 = 'Google Help';
$_['entry_products_to_update']			 = 'Choose Products To Update';
$_['entry_categories']   	 = 'Categories';
$_['entry_manufacturers']   	 = 'Manufacturers';
$_['entry_products']   	 = 'Products';

$_['help_variant_bulk']		 = '<p><span style="color:red;">WARNING</span> - Updating variants will delete any previously saved variants for the products chosen.</p><p>As this is a bulk update tool, there are no GTIN or MPN values for variants, as by their nature, they should be unique for each product variant.</p>';
$_['help_bulk_update_info']		 = '<h3 style="color:red;">Use this tool with caution!</h3><p>Please use the fields below to bulk update your products.</p><p>You should uncheck the \'Ignore\' checkboxes next to the fields you wish to update.</p><p>At the bottom of this page, you can filter by Manufacturers, Categories and Individual Products.</p><p><span style="color:red;">Please Note:</span> Choosing a mixture of Manufacturers, Categories and/or Products will update all products assigned to the chosen Manufacturers and Categories, plus any individual products selected.</p><p><span style="color:red;">Warning:</span> As this is a bulk update tool, it is not possible to update GTIN and/or MPN values, as by their nature, they should be unique for each product.</p>';
$_['help_p_on_google']		 = 'You can stop individual products from being listed on Google Shopping with this setting.<br>If you wish to stop a currently listed item from being listed on Google Shopping,<br>you should manually delete it in your Google Merchant account.<br>Otherwise, it will continue to be listed for 30 days or until the date you set in the Expiry Date field below.';
$_['help_p_promotion_id']		 = 'You can enter here a Google Shopping Promotion ID from your Google Shopping Promotions (if you have any setup).';
$_['help_p_expiry_date']			 = 'You can set an expiry date for this product for it to stop being listed on Google Shopping. Once the expiry date has passed, the List on Google Shopping option will revert to \'No\' in the feed.';
$_['help_p_identifier_exists']	 = 'Select \'No\' if you are not submitting Unique Product Identifiers for this product.';
$_['help_p_condition']		 = 'You can override the default condition for this product here.';
$_['help_p_brand']			 = 'You can override the Brand chosen in the Links tab here if you wish to be more specific.';
$_['help_p_mpn']			 = 'Manufacturer\'s Part Number.<br>This value will be ignored if using Product Variants (see below).';
$_['help_p_gtin']			 = 'UPC or EAN or JAN or ISBN Number.<br>This value will be ignored if using Product Variants (see below).';
$_['help_p_google_category']	 = 'This will override the default Google Product Category set in the Product Feed settings';
$_['help_p_multipack']			 = 'Enter the number of identical items in this multipack only if you personally have created the multipack.';
$_['help_p_is_bundle']			 = 'If this item has various products, choose \'Yes\'.';
$_['help_p_adult']			 = 'If not all products you are listing are classed as Adult products, you can specify individual products as being Adult.';
$_['help_p_energy_efficiency_class']			 = 'Recommended if applicable for electrical items.';
$_['help_p_unit_pricing_measure']			 = 'Numerical value + unit. Weight (mg, g, kg), volume (ml, cl, l, cbm), length (cm, m) and area (sqm) are supported.';
$_['help_p_unit_pricing_base_measure']			 = 'Integer value + unit. Weight (mg, g, kg), volume (ml, cl, l, cbm), length (cm, m) and area (sqm) are supported.';
$_['help_p_size_type']			 = 'Recommended for Clothing items.';
$_['help_p_size_system']			 = 'Size system of this product.';
$_['help_v_prices']			 = 'Based on the price entered on the Data tab, enter here the amount to add on or subtract from that price for this variant.<br><br>Add on: +5.00<br>Subtract: -5.00';
$_['help_p_custom_label'] = 'Custom Labels can be used to group the items in a Shopping campaign by values of your choosing, such as seasonal or clearance, etc.';
$_['help_p_adwords_redirect']	 = 'Allows you to override the product URL when the product is shown within the context of Product Ads.<br>This allows you to track different sources of traffic separately from Google Shopping.';
$_['help_google_help'] = 'If you require more information on what you need to enter for your product data, the following link from Google will help.<br><br>
<a style="cursor:pointer;" onclick="window.open(\'https://support.google.com/merchants#topic=3404818\');">Google Merchant Center Help</a>';
$_['help_products_to_update']			 = 'Use the below filters to choose the products you would like to update with the values from above.';
$_['help_categories']				 = 'Choose the categories you would like to bulk update here.<br><br>If this is blank, manufacturers is blank and products is blank, All products will be updated.';
$_['help_manufacturers']				 = 'Choose the manufacturers you would like to bulk update here.<br><br>If this is blank, categories is blank and products is blank, All products will be updated.';
$_['help_products']				 = 'Choose the products you would like to bulk update here.<br><br>If this is blank, manufacturers is blank and categories is blank, All products will be updated.';

$_['text_bulk_updated']		= 'Products Updated = <strong>%d</strong> (Only products who\'s values were different were updated).';
$_['text_condition_new']	 = 'New';
$_['text_condition_used']	 = 'Used';
$_['text_condition_ref']	 = 'Refurbished';
$_['text_male']				 = 'Male';
$_['text_female']			 = 'Female';
$_['text_unisex']			 = 'Unisex';
$_['text_newborn']				 = 'Newborn';
$_['text_infant']				 = 'Infant';
$_['text_toddler']				 = 'Toddler';
$_['text_kids']				 = 'Kids';
$_['text_adult']			 = 'Adult';
$_['text_regular']				 = 'Regular';
$_['text_petite']				 = 'Petite';
$_['text_plus']				 = 'Plus';
$_['text_big_and_tall']				 = 'Big and Tall';
$_['text_maternity']				 = 'Maternity';
$_['warning_mpn_model']		 = 'UKSB Google Merchant Feed Settings are currently set to use the Model field on the Data tab for MPN';
$_['warning_mpn_location']	 = 'UKSB Google Merchant Feed Settings are currently set to use the Location field on the Data tab for MPN';
$_['warning_mpn_sku']	 	 = 'UKSB Google Merchant Feed Settings are currently set to use the SKU field on the Data tab for MPN';
$_['warning_gtin_default']		 = 'UKSB Google Merchant Feed Settings are currently set to use the UPC or EAN or JAN or ISBN field on the Data tab for GTIN';
$_['warning_gtin_location']	 = 'UKSB Google Merchant Feed Settings are currently set to use the Location field on the Data tab for GTIN';
$_['warning_gtin_sku']	 	 = 'UKSB Google Merchant Feed Settings are currently set to use the SKU field on the Data tab for GTIN';

$_['button_bulk_update']			 = 'Bulk Update';
$_['button_bulk_reset']			 = 'Reset Form';
$_['button_run'] = 'Run Action';