<?php
// Heading
$_['heading_title'] 		                             = 'Product Questions';

// Tab
$_['tab_general'] 		                             = 'General';
$_['tab_question']                                   = 'Question Tab';
$_['tab_extra_button']                               = 'Extra Button';
$_['tab_email']                                      = 'Email Template';
$_['tab_help'] 		                                = 'Help';

// Legend
$_['legend_admin_notification']                      = 'Send notification to ADMIN when customer send a question?';
$_['legend_answer_language']                         = 'Which language to use in answer (email) sent to customer?';
$_['legend_force_multilanguage']                     = 'Force multilanguage answer? (if your store is available in more languages)';
$_['legend_tab_name']                                = 'Questions tab title / name';
$_['legend_tab_header_position']                     = 'Questions tab header position & format';
$_['legend_tab_content_position']                    = 'Questions tab content position & format';
$_['legend_tab_question_limit']                      = 'How many questions to show by default (in product page)?';
$_['legend_extra_button_name']                       = 'Extra button name';
$_['legend_extra_button_position']                   = 'Extra button format & position';
$_['legend_email_admin_notification']                = 'Email Template for Admin notification (when customer send new question)';
$_['legend_email_customer_answer']                   = 'Email Template for customer answer (when customer receive answer to his question)';

// Text
$_['text_extension'] 		                          = 'Extensions';
$_['text_success'] 		                             = 'Success: You have modified module Product Questions!';
$_['text_edit'] 		                                = 'Edit Product Questions';

$_['text_prepend']                                   = 'prepend';
$_['text_append']                                    = 'append';
$_['text_before']                                    = 'before';
$_['text_after']                                     = 'after';
$_['text_customer_prefered_language']                = 'Customer prefered language (language used in front store when customer sent question)';
$_['text_custom_language']                           = 'Let me choose language';

$_['text_open_question_tab']                         = 'Show questions list in Questios tab';
$_['text_open_question_form']                        = 'Show "Ask a question" form';

$_['text_import_example']                            = 'Import example';

// Entry
$_['entry_status']                                   = 'Status';
$_['entry_autoreply']                                = 'Auto Reply';
$_['entry_admin_notification']                       = 'Notification';
$_['entry_admin_notification_additional']            = 'Additional Notification';
$_['entry_answer_language_type']                     = 'Language';
$_['entry_answer_language_id']                       = 'Which Language?';
$_['entry_force_multilanguage']                      = 'Force Multilanguage Answer';

$_['entry_tab_name']                                 = 'Tab Name';
$_['entry_tab_header_format']                        = 'Format';
$_['entry_tab_content_format']                       = 'Format';
$_['entry_tab_question_limit']                       = 'Limit';

$_['entry_extra_button_status']                      = 'Status';
$_['entry_extra_button_name']                        = 'Name';
$_['entry_extra_button_format']                      = 'Format';
$_['entry_extra_button_behaviour']                   = 'Behaviour';

$_['entry_email_subject']                            = 'Subject';
$_['entry_email_message']                            = 'Message';

$_['entry_position_selector']                        = 'Selector';
$_['entry_position_function']                        = 'Function';

// Help
$_['help_extra_button']                              = 'Use this feature if you want to show an extra button/link like "Ask a question" outside Questions tab (e.g: below add to cart button)';
$_['help_install']                                   = '<i class="fa fa-fw fa-lightbulb-o"></i> For custom themes is recommended to get install service from <a href="https://www.oc-extensions.com/Contact?reason=general">OC-Extensions.com</a> (one of our developers will install extension for you)';
$_['help_status']                                    = 'Enable or Disable extension';
$_['help_admin_notification']                        = 'Enabled = Send email to admin with question details (In tab "Email Template" you can specify how you want to look this email)';
$_['help_admin_notification_additional']             = 'Enabled = Send a copy of admin notification to "Additional Emails" specified in store settings (Store settings > Tab Mail > Option "Additional Alert Mail")';
$_['help_force_multilanguage']                       = 'This option is NOT applied to answer received by customer on email, is related to answer displayed in product page (if admin decide to include customer question-answer in product page)<br /><br />E.g: Your store is using 2 languages in front (EN and FR). Customer send new question using EN as preferd store language.<br /> If this option is set as ENABLED in admin area in question edit will expect to add an answer for each language available in store (and also in product page will show question-answer for all languages)<br /><br />If is set as Disabled will expect add answer for language used by customer when question was sent, and in front store (product page) will show only when is selected certain language';

$_['help_tab_header_format']                         = 'Use button "<i class="fa fa-download"></i>" (located in right side of format input) to import example (<u>valid for Default OpenCart theme</u>).<br /><br /><strong>IMPORTANT:</strong> Use special keyword <strong>{tab.name}</strong> for tab name. Keep tab href like in example <strong>href="tab-questions"</strong>';
$_['help_tab_content_format']                        = 'Use button "<i class="fa fa-download"></i>" (located in right side of format input) to import example (<u>valid for Default OpenCart theme</u>).<br /><br /><strong>IMPORTANT:</strong> Use special keyword <strong>{tab.content}</strong> for tab content (will add there questions and ask question form).';

$_['help_extra_button_format']                       = 'Use button "<i class="fa fa-download"></i>" (located in right side of format input) to import example (<u>valid for Default OpenCart theme</u>).<br /><br /><strong>IMPORTANT:</strong> Use special keyword <strong>{extra.button.name}</strong> for button/link name/title. Keep class="product-question-extra-button"  and href="javascript:void(0)"';

$_['help_multilanguage_answer']                      = 'If is enabled and your store is multilanguage - in admin question edit area will force to add answer text for all languages available in store.';
$_['help_extra_button']                              = 'Use this option if you want to show an extra button "Ask question" in product page, outside Questions Tab';

$_['help_email_admin_notification_subject_keywords'] = 'Use special keywords described below to include product name/model or customer name in email subject<br /><br />{product.name} - product name<br />{product.model} - product model<br />{customer.name} - customer name';
$_['help_email_admin_notification_message_keywords'] = 'Use special keywords described below to include product name/ model / customer name / question etc in email message<br /><br />{product.name} - product name<br />{product.model} - product model<br />{product.url} - profuct page URL<br />{customer.name} - customer name<br />{customer.email} - customer email<br />{customer.question} - customer question<br />{customer.ip} - customer IP';
$_['help_email_customer_answer_subject_keywords']    = 'Subject special keywords:<br /><br />{store.name} = store name<br />{product.name} = product name<br />{customer.name} = customer name';
$_['help_email_customer_answer_message_keywords']    = 'Message special Keywords:<br /><br />{store.name} = store name<br />{store.url} = link to store<br />{store.logo} = store logo (path to image)<br />{product.name} = product name<br />{product.url} = link to product page<br />{customer.name} = customer name<br />{customer.email} = customer email<br />{question} = question sent by customer<br />{answer} = answer message';

// Error
$_['error_permission'] 		                          = 'Warning: You do not have permission to modify module Product Questions!';
$_['error_in_tab']                                   = 'Found errors in tab %s. Please check again each tab and fill all required info!';
$_['error_tab_name']                                 = 'Error: Tab Name is required!';
$_['error_tab_header_position_selector']             = 'Error: Selector is required!';
$_['error_tab_content_position_selector']            = 'Error: Selector is required!';
$_['error_tab_question_limit']                       = 'Error: Invalid value! Recommended: 10';
$_['error_extra_button_position_selector']           = 'Error: Selector is required!';
$_['error_admin_notification_subject']               = 'Error: Subject is required!';
$_['error_admin_notification_message']               = 'Error: Message must be at least 20 chars';
$_['error_customer_answer_subject']                  = 'Error: Subject is required!';
$_['error_customer_answer_message']                  = 'Error: Message must be at least 20 chars';
