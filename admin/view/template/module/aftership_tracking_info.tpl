<div class="order-track-info">
	<div class="order-track-info-container">
		<div class="order-track-info-courier-logo"><img src="<?php echo $courier_logo; ?>" width="40" height="40"/></div>
		<div class="order-track-info-courier-info">
			<strong><?php echo $courier_name; ?></strong><br />
			<?php echo $courier_phone; ?>
		</div>
		<div class="order-track-info-tracking-number">
			<?php echo $text_tracking_number; ?><br />
			<span class="tracking-number"><?php echo $tracking_number; ?></span>
		</div>
		<div class="order-track-info-action"><a href="<?php echo $tracking_url; ?>"  target="_blank" class="btn btn-success"><i class="fa fa-fw fa-search"></i> <?php echo $button_track; ?></a></div>
	</div>
</div>