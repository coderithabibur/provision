<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<td class="text-left"><?php echo $column_name; ?></td>
				<td class="text-left"><?php echo $column_phone; ?></td>
				<td class="text-left"><?php echo $column_website; ?></td>
			</tr>
		</thead>
		<tbody>
		<?php if ($couriers) { ?>
		<?php foreach ($couriers as $courier) { ?>
		<tr>
		  <td class="text-left"><?php echo $courier['name']; ?></td>
		  <td class="text-left"><?php echo $courier['phone']; ?></td>
		  <td class="text-left"><?php echo $courier['website']; ?></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr>
		  <td class="text-center" colspan="3"><?php echo $text_no_results; ?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>