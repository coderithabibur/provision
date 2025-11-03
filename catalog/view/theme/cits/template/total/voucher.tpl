<div class="single-coupon-item"> 
  <label class="control-label" for="input-voucher"><?php echo $entry_voucher; ?></label>
  <div class="input-group">
    <input type="text" name="voucher" value="<?php echo $voucher; ?>" placeholder="<?php echo $entry_voucher; ?>"
      id="input-voucher" class="form-control" />
    <span class="input-group-btn">
      <input type="submit" value="<?php echo $button_voucher; ?>" id="button-voucher"
        data-loading-text="<?php echo $text_loading; ?>" class="yellowbtn voucher" />
    </span>
  </div>

  <script type="text/javascript">
    $('#button-voucher').on('click', function() {
      $.ajax({
        url: 'index.php?route=total/voucher/voucher',
        type: 'post',
        data: 'voucher=' + encodeURIComponent($('input[name=\'voucher\']').val()),
        dataType: 'json',
        beforeSend: function() {
          $('#button-voucher').button('loading');
        },
        complete: function() {
          $('#button-voucher').button('reset');
        },
        success: function(json) {
          $('.alert').remove();

          if (json['error']) {
            $('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

            $('html, body').animate({ scrollTop: 0 }, 'slow');
          }

          if (json['redirect']) {
            location = json['redirect'];
          }
        }
      });
    });
  </script>
</div>