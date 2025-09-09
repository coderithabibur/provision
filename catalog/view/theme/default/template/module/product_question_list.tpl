<?php if ($questions) { ?>
	<?php foreach($questions as $question) { ?>
		<div class="faq-item faq-item-v3">
			<div class="faq-question faq-question-v3"><?php echo $question['question']; ?></div>
			<div class="faq-answer faq-answer-v3"><?php echo $question['answer']; ?></div>
		</div>
	<?php } ?>

	<?php if ($load_more) { ?>
	<div class="product-question-load-more-container">
		<div class="loading-mask-overlay">
			<div class="loading-mask-loading">
				<div class="uil-ripple-css"><div></div><div></div></div>
			</div>
		</div>

		<a href="javascript:void(0)" id="product-question-load-more"  onclick="productQuestionLoadMore('<?php echo $load_more; ?>');"><?php echo $button_load_more; ?></a>
	</div>
	<?php } ?>
<?php } else { ?>
<p class="no-question"><?php echo $text_empty; ?></p>
<?php } ?>
