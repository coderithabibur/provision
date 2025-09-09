<?php echo $header; ?>
<section class="bannerOuter paddingless">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="pageTitle"><span>Product listing</span></div>
      </div>
    </div>
  </div>
</section>
<section class="greyBg paddingtop30">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ol class="breadcrumb">
         <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
        </ol>
      </div>
    </div>
    <div class="row">
    <?php //echo $column_left; ?>
    <div class="col-xs-12">

      <?php echo $content_top; ?>
         <div class="row">
          <div class="">
            <div class="theading">
                  <h1><?php echo $heading_title; ?></h1>
            </div>
          </div>
        </div>
      <?php if ($thumb || $description) { ?>
        <div class="row">
        <div class="col-xs-12">
           <?php if ($thumb) { ?>
        <div class="pthumb"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-thumbnail" style="height: 300px; width: 300px" /></div>
        <?php } ?>
        <?php /*if ($description) {
        $length = strlen($description) ;
      ?>
      <div class="description <?php echo (isset($length) && $length > 100?'limitContent':'') ;?> "><?php echo $description ; ?> </div>
     <?php
      if($length > 100){ ?>
          <p class="moreHere"><a class="morelink" href="">Read more</a></p>
    <?php } ?>

    <p class="lessHere"><a class="lesslink" href="">Read Less</a></p>
    <?php }*/ ?>
    <?php if($description) {  ?>
    <div class="description">

        <?php echo $description; ?>

    </div>

    <?php } ?>




      </div>
     </div>
      <?php } ?>
    <?php if ($categories) { ?>
    <div class="row">
          <div class="col-xs-12">
            <div class="theading">
                  <h2><?php echo ($refine_search_text?$refine_search_text:$text_refine) ; ?></h2>
            </div>
          </div>
        </div>
      <?php if (count($categories) <= 5) { ?>
      <div class="row">
            <?php foreach ($categories as $category) { ?>
           <div class="col-md-3 col-sm-6 col-xs-6 full">
          <div class="columnOuter">
           <div class="column">
             <div class="productThumb"><a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>" title="<?php echo $category['name']; ?>" class="img-responsive" /></a></div>
             <div class="desc"><div class="thead"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></div>             </div>
           </div>
         </div>
         </div>
            <?php } ?>
      </div>
      <?php } else { ?>
      <div class="row">
        <?php foreach (array_chunk($categories, ceil(count($categories) / 4)) as $categories) { ?>
            <?php foreach ($categories as $category) { ?>
          <div class="col-md-3 col-sm-6 col-xs-6 full">
          <div class="columnOuter">
           <div class="column">
             <div class="productThumb"><a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>" title="<?php echo $category['name']; ?>" class="img-responsive" /></a></div>
             <div class="desc"><div class="thead"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></div>             </div>
           </div>
         </div>
         </div>
            <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
      <?php } ?>

          <div class="row">
          <div class="col-xs-12">
            <div class="theading">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6 full">
                  <h2><?php echo ($product_listing_text?$product_listing_text:'Product listing') ; ?></h2>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 full">
                  <?php if ($products) { ?>
                  <div class="selectBox">
                    <label><?php echo $text_limit; ?></label>
                    <div class="selectBG left">
                      <select id="input-limit" onchange="location = this.value;">
                          <?php foreach ($limits as $limits) { ?>
                        <?php if ($limits['value'] == $limit) { ?>
                        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                        <?php } ?>
                        <?php } ?>

                      </select>
                    </div>
                  </div>
                  <div class="selectBox">
                    <label><?php echo $text_sort; ?></label>
                    <div class="selectBG">
                      <select id="input-sort" onchange="location = this.value;">
                      <?php foreach ($sorts as $sorts) { ?>
                          <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                          <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                          <?php } ?>
                          <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div><div id="content"></div>
          </div>
        </div>
      <?php if ($products) { ?>
      <div class="row inline-flex">
        <?php foreach ($products as $product) { ?>
          <div class="col-md-3 col-sm-6 col-xs-6 full">
          <div class="columnOuter">
           <div class="column">
             <div class="productThumb"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
             <div class="desc"><div class="thead"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
             <div class="cartBox">

            <?php $productmoney = $product['price']; ?>
         <?php if ($productmoney == '$0.00') { ?>
         <p class="price"> &nbsp;
             </p>
          <?php } else { ?>

            <?php if ($product['price']) { ?>
            <?php if (!$product['special']) { ?>
          <p class="price">
          <?php echo $product['price']; ?>
          </p>
          <?php } else { ?>
          <p class="price"><?php echo $product['special']; ?> <span class="price-old"><?php echo $product['price']; ?></span></p>
          <?php } ?>
        <?php } ?>

       <?php } ?>

       <button class="yellowbtn btn-2 btn-2a" onclick="cart.add('<?php echo $product['product_id']; ?>');"><img src="catalog/view/theme/hidlighting/images/cart.png" alt=""><b><?php echo $button_cart; ?></b></button>
  <button class="yellowbtn combtn Btn1<?php echo $product['product_id']; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"> <b>Add To Compare </b></button>
       <button class="yellowbtn combtn1 Btn12<?php echo $product['product_id']; ?>" onclick="location.href = '<?php echo $compare; ?>';"  style="display: none;"><b>Compare Now</b></button>
             </div>
             </div>
        <div class="ratingsAndReviews">
       <?php if ($product['rating']) { ?>
      <div class="rating">
        <?php for ($i = 1; $i <= 5; $i++) { ?>
        <?php if ($product['rating'] < $i) { ?>
        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
        <?php } else { ?>
        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
        <?php } ?>
        <?php } ?>
      </div>
        <?php } ?>

      <div class="reviews">
        <a href="<?php echo $product['href']; ?>#customerReview"><?php echo $product['reviews']; ?></a>
        |
        <a href="<?php echo $product['href']; ?>#customerReview"><?php echo $text_write; ?></a>
      </div>

    </div>



           </div>
         </div>
         </div>
        <?php } ?>
      </div>
      <?php if($pagination){?>
      <div class="row">
          <div class="col-xs-12">
            <div class="paginationOuter">
              <?php echo $pagination; ?>
            </div>
          </div>
        </div>
      <?php } } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
    </div>
</section>

			    <!--START - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
			        <?php if (isset($product_impression_script)) { echo $product_impression_script; } ?> 
			    <!--END - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
            	
<?php echo $footer; ?>
<style>

  a.morelink, a.lesslink {
    color: rgb(231, 148, 57);
    display: block;
    font-size: 16px;
    font-weight: bold;
}
</style>

<script>
$(document).ready(function() {

  $(".description").shorten();



 });

(function($) {
    $.fn.shorten = function(settings) {
        "use strict";

        var config = {
            showChars: 800,
            minHideChars: 10,
            ellipsesText: "...",
            moreText: "Read More",
            lessText: "Read Less",
            onLess: function() {},
            onMore: function() {},
            errMsg: null,
            force: false
        };

        if (settings) {
            $.extend(config, settings);
        }

        if ($(this).data('jquery.shorten') && !config.force) {
            return false;
        }
        $(this).data('jquery.shorten', true);

        $(document).off("click", '.morelink');

        $(document).on({
            click: function() {

                var $this = $(this);
                if ($this.hasClass('less')) {
                    $this.removeClass('less');
                    $this.html(config.moreText);
                    $this.parent().prev().animate({}, function () { $this.parent().prev().prev().show(); }).hide(300, function() {
                        config.onLess();
                      });

                } else {
                    $this.addClass('less');
                    $this.html(config.lessText);
                    $this.parent().prev().animate({}, function () { $this.parent().prev().prev().hide(); }).show(300, function() {
                        config.onMore();
                      });
                }
                return false;
            }
        }, '.morelink');

        return this.each(function() {
            var $this = $(this);

            var content = $this.html();
            var contentlen = $this.text().length;
            if (contentlen > config.showChars + config.minHideChars) {
                var c = content.substr(0, config.showChars);
                if (c.indexOf('<') >= 0) // If there's HTML don't want to cut it
                {
                    var inTag = false; // I'm in a tag?
                    var bag = ''; // Put the characters to be shown here
                    var countChars = 0; // Current bag size
                    var openTags = []; // Stack for opened tags, so I can close them later
                    var tagName = null;

                    for (var i = 0, r = 0; r <= config.showChars; i++) {
                        if (content[i] == '<' && !inTag) {
                            inTag = true;

                            // This could be "tag" or "/tag"
                            tagName = content.substring(i + 1, content.indexOf('>', i));

                            // If its a closing tag
                            if (tagName[0] == '/') {


                                if (tagName != '/' + openTags[0]) {
                                    config.errMsg = 'ERROR en HTML: the top of the stack should be the tag that closes';
                                } else {
                                    openTags.shift(); // Pops the last tag from the open tag stack (the tag is closed in the retult HTML!)
                                }

                            } else {
                                // There are some nasty tags that don't have a close tag like <br/>
                                if (tagName.toLowerCase() != 'br') {
                                    openTags.unshift(tagName); // Add to start the name of the tag that opens
                                }
                            }
                        }
                        if (inTag && content[i] == '>') {
                            inTag = false;
                        }

                        if (inTag) { bag += content.charAt(i); } // Add tag name chars to the result
                        else {
                            r++;
                            if (countChars <= config.showChars) {
                                bag += content.charAt(i); // Fix to ie 7 not allowing you to reference string characters using the []
                                countChars++;
                            } else // Now I have the characters needed
                            {
                                if (openTags.length > 0) // I have unclosed tags
                                {
                                    //console.log('They were open tags');
                                    //console.log(openTags);
                                    for (j = 0; j < openTags.length; j++) {
                                        //console.log('Cierro tag ' + openTags[j]);
                                        bag += '</' + openTags[j] + '>'; // Close all tags that were opened

                                        // You could shift the tag from the stack to check if you end with an empty stack, that means you have closed all open tags
                                    }
                                    break;
                                }
                            }
                        }
                    }
                    c = $('<div/>').html(bag + '<span class="ellip">' + config.ellipsesText + '</span>').html();
                }else{
                    c+=config.ellipsesText;
                }

                var html = '<div class="shortcontent">' + c +
                    '</div><div class="allcontent">' + content +
                    '</div><span><a href="javascript:void(0)" class="morelink">' + config.moreText + '</a></span>';

                $this.html(html);
                $this.find(".allcontent").hide(); // Hide all text
                $('.shortcontent p:last', $this).css('margin-bottom', 0); //Remove bottom margin on last paragraph as it's likely shortened
            }
        });

    };

})(jQuery);
/*
$(document).ready(function () {

 $('.description').readmore({
  speed: 500,
  maxHeight: 200,
  moreLink: '<a class="morelink" href="">Read more</a>',
  lessLink: '<a class="lesslink" href="">Read Less</a>',

 });
});
  /*$(".morelink").click(function(e){
        e.preventDefault();
      $(".description").removeClass("limitContent") ;
      $(".moreHere").css({
        "display": "none",
      });
      $(".lessHere").css({
        "display"  : "block" ,
      });

  });
  $(".lesslink").click(function(e){
        e.preventDefault();
      $(".description").addClass("limitContent") ;
      $(".lessHere").css({
        "display"  : "none" ,
      });
      $(".moreHere").css({
        "display": "block",
      });
  });

*/

</script>
