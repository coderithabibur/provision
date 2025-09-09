<?php echo $header; ?>
<?php if(isset($order_success)) { ?>
<script type="text/javascript">

/* <![CDATA[ */

var google_conversion_id = 1046724351;

var google_conversion_language = "en";

var google_conversion_format = "3";

var google_conversion_color = "ffffff";

var google_conversion_label = "W5N8CMn-qG8Q__2O8wM";

var google_conversion_value = 100.00;

var google_conversion_currency = "AUD";

var google_remarketing_only = false;

/* ]]> */

</script>

<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">

</script>

<noscript>

<div style="display:inline;">

<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1046724351/?value=100.00&amp;currency_code=AUD&amp;label=W5N8CMn-qG8Q__2O8wM&amp;guid=ON&amp;script=0"/>

</div>

</noscript>
<?php 

if(!empty($testData)){?>
	
    <script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>
    <script>
    
      window.renderOptIn = function() {
        window.gapi.load('surveyoptin', function() {
          window.gapi.surveyoptin.render(
            {
              "merchant_id": 114170849,
              "order_id": "<?php echo $testData['order_id']; ?>",
              "email": "<?php echo $testData['email']; ?>",
              "delivery_country": "<?php echo $testData['delivery_country']; ?>",
              "estimated_delivery_date": "<?php echo $testData['estimated_delivery_date']; ?>",
             });
        });
      }
    
    </script>
<?php	} ?>
<?php } ?>
<section class="bannerOuter paddingless">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="pageTitle"><h1><?php echo $heading_title; ?>
       </h1></div>
      </div>
    </div>
  </div>
</section>
<section class="greyBg paddingtop30">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ol class="breadcrumb">
         <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
        </ol>
      </div>
    </div>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-md-9 col-sm-8 col-xs-12'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>     
      <?php echo $text_message; ?>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="yellowbtn"><?php echo $button_continue; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
</section>
 
<script>
(function () {
  if (window.__ga4_purchase_fired) return;
  window.__ga4_purchase_fired = true;

  window.dataLayer = window.dataLayer || [];

  // Server-built ecommerce payload from ControllerCheckoutSuccess
  var ecommerce = <?php echo json_encode($ga4_purchase ?: new stdClass()); ?>;

  // Optional customer block (already provided by your controller vars)
  var customer = {
    first_name: "<?php echo isset($customer_firstname) ? addslashes($customer_firstname) : ''; ?>",
    last_name:  "<?php echo isset($customer_lastname)  ? addslashes($customer_lastname)  : ''; ?>",
    email:      "<?php echo isset($customer_email)     ? addslashes($customer_email)     : ''; ?>",
    phone:      "<?php echo isset($customer_phone)     ? addslashes($customer_phone)     : ''; ?>",
    address: {
      street_address: "<?php echo isset($billing_address_1)    ? addslashes($billing_address_1)    : ''; ?>",
      city:           "<?php echo isset($billing_city)         ? addslashes($billing_city)         : ''; ?>",
      state:          "<?php echo isset($billing_state)        ? addslashes($billing_state)        : ''; ?>",
      postal_code:    "<?php echo isset($billing_postcode)     ? addslashes($billing_postcode)     : ''; ?>",
      country:        "<?php echo isset($billing_country_iso2) ? addslashes($billing_country_iso2) : ''; ?>"
    }
  };

  // Push
  dataLayer.push({ ecommerce: null });  
  dataLayer.push({
    event: 'purchase',
    customer: customer,
    ecommerce: ecommerce
  });
})();
</script>


			    <!--START - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
			        <?php if (isset($ecommerce_tracking_script)) { echo $ecommerce_tracking_script; } ?> 
			    <!--END - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
            	
<?php echo $footer; ?>
