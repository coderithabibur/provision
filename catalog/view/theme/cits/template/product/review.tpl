<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="reviews-list">
  <?php if ($reviews) { ?>
  <?php foreach ($reviews as $review) { ?>
  <div class="review-item">
    <div class="review-avatar">
      <img src="catalog/view/theme/cits/assets/images/user.png" alt="<?php echo $review['author']; ?>">
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
        <span class="star-icon" aria-label="<?php echo $i; ?> out of 5 stars"></span>
        <?php } else { ?>
        <span class="star-icon active" aria-label="<?php echo $i; ?> out of 5 stars"></span>
        <?php } ?>
        <?php } ?> </div>
      </div>
    </div>

    <?php } ?>
    
    <div class="row review-footer">
        <div class="col-sm-6">
            <div class="pro-policy">
                 <a href="https://www.pro-vision-lighting.com/returnandrefundpolicy" target="_blank" title="Return and Refund Policy">Return and Refund Policy</a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="text-right"><?php echo $pagination; ?></div>
        </div>
    </div>

    <?php } else { ?>
    <div class="no-reviews">
      <p><?php echo $text_no_reviews; ?></p>
      <!-- Optional: Show Policy even if no reviews? No, standard OC just says no reviews. -->
    </div>
    <?php } ?>
  </div>
