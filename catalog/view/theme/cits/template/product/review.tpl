<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="review">
  <div class="row">
    <?php if ($reviews) { ?>
    <?php foreach ($reviews as $review) { ?>
    <div class="col-sm-6 review-box">
      <h5><?php echo $review['author']; ?></h5>
      <div class="ratingInfo">
        <div class="ratingBox">
          <?php for ($i = 1; $i <= 5; $i++) { ?>
          <?php if ($review['rating'] < $i) { ?>
          <a href="javascript:void(0)" title=""></a>
          <?php } else { ?>
          <a href="javascript:void(0)" title="" class="active"></a>
          <?php } ?>
          <?php } ?> </div>
          <div class="reviews">
            <ul>
              <li><span class="sep">|</span> <?php echo $review['date_added']; ?></li>
            </ul>
          </div>
        </div>

        <p><?php echo $review['text']; ?></p>
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
  </div>
