<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($payment_methods) { ?>
<p><?php echo $text_payment_method; ?></p>
<?php foreach ($payment_methods as $payment_method) { ?>
<div class="radio">
  <label>
    <?php if ($payment_method['code'] == $code || !$code) { ?>
    <?php $code = $payment_method['code']; ?>
    <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" checked="checked" />
    <?php } else { ?>
    <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" />
    <?php } ?>
    <?php echo $payment_method['title']; ?> or Credit Card
    <?php if ($payment_method['terms']) { ?>
    (<?php echo $payment_method['terms']; ?>)
    <?php } ?>
  </label>
</div>
<?php } ?>
<?php } ?>
<p><strong><?php echo $text_comments; ?></strong></p>
<p>
  <textarea name="comment" rows="8" class="form-control"><?php echo $comment; ?></textarea>
</p>
<?php if ($text_agree) { ?>
<div class="buttons">
  <div class="safe_scure_image">
    <img src="https://www.pro-vision-lighting.com/image/catalog/safe_secure_image.png">
  </div>
  <div class="pull-right"><?php echo $text_agree; ?>
    <?php if ($agree) { ?>
    <input type="checkbox" name="agree" value="1" checked="checked" id="chkbox"/>
    <?php } else { ?>
    <input type="checkbox" name="agree" value="1" id="chkbox"/>
    <?php } ?>
    &nbsp;
    <input type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" data-loading-text="<?php echo $button_continue; ?>" class="btn2 yellowbtn" />
  </div>
</div>
<?php } else { ?>
<div class="buttons">
  <div class="pull-right">
    <input type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" data-loading-text="<?php echo $button_continue; ?>" class="btn2 yellowbtn" />
  </div>
</div>
<?php } ?>

<script>
 $('#collapse-payment-method #chkbox').click(function() {
        if($(this).is(":checked")) {
            //var returnVal = confirm("Are you sure?");
            //$(this).attr("checked", returnVal);
			$('#button-payment-method').removeAttr('disabled');
			$('#button-payment-method').text('Continue');
			$('#button-payment-method').val('Continue');
        } else {

		}
		});


</script>
