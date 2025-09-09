<fieldset>
<legend>Google Analytics - Enhanced Ecommerce</legend>
<form class="form-horizontal" id="ga-refund-form" method="post" action="<?php echo $action; ?>" target="_blank">
	<div class="form-group">
	  <label class="col-sm-2 control-label">Send Refund Info</label>
	  <div class="col-sm-6">
		<select name="ga_refund_products" class="form-control">
			<option value="0">* ALL PRODUCTS / FULL REFUND *</option>
			<?php foreach ($products as $product){ ?>
				<option value="<?php echo $product['product_id']; ?>"><?php echo $product['name']; ?></option>;
			<?php } ?>
			</select>
	  </div>
	  <div class="col-sm-2">
	  	<div class="input-group">
			<span class="input-group-addon">QTY</span>
			<input type="text" name="ga_refund_qty" class="form-control">
		</div>
	  </div>
	  <div class="col-sm-2"><input type="submit" value="SEND DATA" class="btn btn-warning col-sm-12" id="ga-refund-btn"></div>
	</div>
</form>
</fieldset>