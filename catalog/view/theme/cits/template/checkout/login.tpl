<div class="row">
  <div class="col-sm-12">
    <!-- Styled Tabs for Guest / Register / Login -->
    <div class="checkout-login-tabs">
        <?php if ($checkout_guest) { ?>
        <label class="tab-label <?php if ($account == 'guest') echo 'active'; ?>" id="tab-guest">
            <input type="radio" name="account" value="guest" <?php if ($account == 'guest') echo 'checked="checked"'; ?> />
            Guest
        </label>
        <?php } ?>
        <label class="tab-label <?php if ($account == 'register') echo 'active'; ?>" id="tab-register">
            <input type="radio" name="account" value="register" <?php if ($account == 'register') echo 'checked="checked"'; ?> />
            Register
        </label>
        <label class="tab-label" id="tab-login">
           Login
        </label>
    </div>

    <!-- Login Area (Hidden by default unless Login tab clicked, logic handled by custom JS or just toggling) -->
    <div id="login-form-area" style="display:none; margin-top: 20px;">
        <div class="form-group">
          <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
          <input type="text" name="email" value="" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
        </div>
        <div class="form-group">
          <label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
          <input type="password" name="password" value="" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
          <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
        </div>
        <input type="button" value="<?php echo $button_login; ?>" id="button-login" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-block" style="border-radius: 50px; background: var(--brand-color); border:none;" />
    </div>

    <!-- Continue Button for Guest/Register -->
    <div id="continue-area" style="margin-top: 20px;">
        <p id="account-desc" class="text-muted"><?php echo $text_register_account; ?></p>
        <input type="button" value="<?php echo $button_continue; ?>" id="button-account" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-block" style="border-radius: 50px; background: var(--brand-color); border:none;" />
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    // Tab Interaction Logic
    $('.checkout-login-tabs label').click(function() {
        $('.checkout-login-tabs label').removeClass('active');
        $(this).addClass('active');

        // Check if it's the Login "Tab" (which is actually just a label here acting as a trigger)
        if ($(this).attr('id') == 'tab-login') {
            $('#login-form-area').slideDown();
            $('#continue-area').slideUp();
            // We don't actually check a radio for login, as standard Opencart separates logic.
            // But we need to ensure 'account' is NOT checked if we want to login.
            // Actuall standard opencart login is separate AJAX.
        } else {
            // Guest or Register
            $('#login-form-area').slideUp();
            $('#continue-area').slideDown();
            // Trigger the internal radio click
            $(this).find('input[type="radio"]').prop('checked', true);
            
            // Update description text based on selection
            if ($(this).find('input').val() == 'register') {
                $('#account-desc').text('<?php echo $text_register_account; ?>');
            } else {
                $('#account-desc').text('Checkout as a guest. You can create an account later.');
            }
        }
    });

    // Default State initialization
    if ($('input[name="account"]:checked').val() == 'register') {
        $('#tab-register').addClass('active');
    } else if ($('input[name="account"]:checked').val() == 'guest') {
        $('#tab-guest').addClass('active');
    }
});
</script>
