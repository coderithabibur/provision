<?php
// Heading
$_['heading_title']       		  = 'AfterShip';

// Tab
$_['tab_setting']         		  = 'Settings';
$_['tab_courier']         		  = 'Couriers';
$_['tab_order_comment']           = 'Order Comment Template';
$_['tab_help']           		  = 'Help';

// Button
$_['button_syncronize']           = 'Syncronize Couriers';
$_['button_register']             = 'Register AfterShip account';
$_['button_track']                = 'Track on AfterShip';

// Text
$_['text_module']         		  = 'Modules';
$_['text_success']        		  = 'Success: You have modified module Order Tracking!';
$_['text_edit']         		  = 'Edit AfterShip!';
$_['text_sync_complete']          = 'Success: Sync operation (AfterShip > OpenCart) is completed!';

$_['text_tracking_number']        = 'Tracking Number:';

// Column
$_['column_name']                 = 'Name';
$_['column_phone']                = 'Phone';
$_['column_website']              = 'Website';

// Entry
$_['entry_status']				  = 'Extension Status';
$_['entry_api_key']               = 'API KEY';
$_['entry_username']              = 'Username';
$_['entry_order_status']          = 'Order status';

$_['entry_comment_auto']          = 'Auto Generate Comment';  
$_['entry_comment_template']      = 'Comment Template';

// Legend
$_['legend_aftership_account']    = 'AfterShip.com account details';
$_['legend_order_statuses']       = 'In Order Info (section \'Add History\') let me set AfterShip courier and tracking number WHEN i choose order status';

// Help
$_['help_register']               = 'If you don\'t have an AfterShip account you can create one by pressing button \'Register AfterShip account\'. Don\'t forget to set your prefered couriers!';
$_['help_api_key']                = 'To find your API KEY, login in your AfterShip account and choose APPS > API OR access directly link https://secure.aftership.com/apps';
$_['help_username']               = 'To find your USERNAME, login in your AfterShip account and choose PROFILE OR access directly link https://secure.aftership.com/users/profile';
$_['help_order_status']           = 'Ex: Shipped';
$_['help_courier_info']           = 'To import/update couriers info from AfterShip account please press button \'Syncronize Couriers\';  (same action required if in your AfterShip account is enabled new courier or is changed sort order)';
$_['help_comment_auto']           = 'Auto generate order history comment based on template when in order info is selected courier and added tracking number';
$_['help_keywords']        		  = 'In comment you can use custom keywords: {courier_name} {courier_phone} {courier_website} {tracking_number} {tracking_url}';
$_['help_comment']        		  = 'Please take a look at comment_example.txt file (available in extension zip)';

// Error
$_['error_warning']               = 'Warning: Please check the form carefully for errors!';
$_['error_permission']    		  = 'Warning: You do not have permission to modify module AfterShip!';
$_['error_api_key']    		      = 'Error: API KEY is required!';
$_['error_username']    		  = 'Error: Username is required!';
$_['error_order_statuses']        = 'Error: Please choose at least one order status (ex: Shipped)!';
$_['error_order_comment']         = 'Error: Order comment is required!';
$_['error_sync_courier']          = 'Couriers sync operation failed <u>(will keep couriers old info)</u>! AfterShip API response: <i>%s</i>';
?>