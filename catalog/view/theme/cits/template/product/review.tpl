<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="reviews-list">
  <?php if ($reviews) { ?>
  <?php foreach ($reviews as $review) { ?>
  <div class="review-item">
    <div class="review-avatar">
      <img src="catalog/view/theme/cits/assets/images/user.png">
    </div>
    <div class="review-content">
      <div class="review-rating">★★★★★</div>
      <div class="review-author"><?php echo $review['author']; ?> — <?php echo $review['date_added']; ?></div>
      <p><?php echo $review['text']; ?></p>
    </div>

    <div class="ratingInfo">
      <div class="ratingBox">
        <?php for ($i = 1; $i <= 5; $i++) { ?>
        <?php if ($review['rating'] < $i) { ?>
        <a href="javascript:void(0)" title=""></a>
        <?php } else { ?>
        <a href="javascript:void(0)" title="" class="active"></a>
        <?php } ?>
        <?php } ?> </div>
      </div>
    </div>

    <?php } ?>
    <div class="col-sm-12">
      <div class="text-right"><?php echo $pagination; ?></div>
    </div>
    <?php } else { ?>
    <div class="col-sm-12">
      <p><?php echo $text_no_reviews; ?></p>
    </div>
    <?php } ?>
    <div class="col-sm-12">
        <a style="font-size:16px;text-decoration: underline;" href="https://www.pro-vision-lighting.com/returnandrefundpolicy" title="RETURN AND REFUND POLICY" >RETURN AND REFUND POLICY</a>
    </div>
  </div>
