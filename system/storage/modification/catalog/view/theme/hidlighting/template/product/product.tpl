<?php echo $header; ?>
<section class="bannerOuter paddingless">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="pageTitle"><span>Product detail</span></div>
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
        <div class="row"><?php echo $column_left; ?>
            <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
            <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-md-9 col-sm-8 col-xs-12'; ?>
            <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
            <?php } ?>
            <div class="<?php echo $class; ?>">
                <?php echo $content_top; ?>
                <div id="content"></div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-6 fullBlock">
                        <?php // if ($thumb || $images) { ?>
                        <div class="productViewBox thumbnails">
                            <?php if ($thumb) { ?>
                            <div class="largethumb"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                            <?php } else { ?>
                            <div class="largethumb"><img src="<?php echo $base."image/cache/placeholder-239x247.png"; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></div>
                            <?php } ?>
                            <?php if ($images) {  $i=1; ?>
                            <?php foreach ($images as $image) { ?>
                            <div class="productsmall <?php if($i % 4 == 0){echo 'last';}?>"><a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                            <?php $i++; } ?>
                            <?php } ?>
                        </div>
                        <?php // } ?>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-6 fullBlock">
                        <div class="theading">
                            <h1><?php echo $heading_title; ?></h1>
                        </div>
                        <div class="productViewinfo">
                            <?php if ($price == '$0.00') { ?>

                            <?php } else { ?>

                            <?php if (!$special) { ?>
                            <div class="product-spl-price">
                                <p class="newprice"><?php echo $price; ?><span class="eachText"> (<?php echo $txt_each; ?>)</span></p>
                                <span class="separator-line"></span>
                                <?php if ($discounts) { ?>
                                <?php foreach ($discounts as $discount) { ?>
                                <p class="splDes"><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><span><?php echo $discount['price']; ?><span class="eachText"> (<?php echo $txt_each; ?>)</span></span></p>
                                <?php } ?>
                                <?php } ?>
                            </div>
                            <?php } else { ?>
                            <span style="text-decoration: line-through;"><?php echo $price; ?><span class="eachText"> (<?php echo $txt_each; ?>)</span></span>
                            <p class="newprice"><?php echo $special; ?><span class="eachText"> (<?php echo $txt_each; ?>)</span>
                                <span class="newprice" style="font-size: 16px;"> - Discount:
                                    <?php

                                                $prica = str_replace(',','',$price);
                                                $pricb = str_replace(',','',$special);
                                                $priceInt= str_replace('$','',$prica);
                                                $specialInt= str_replace('$','',$pricb);
                                                $disc = (($priceInt-$specialInt)/$priceInt)*100;
                                                ?>
                                    <?php echo round($disc,2);?>% </span>
                            </p>
                            </li>
                            <?php } ?>
                            <?php if ($tax) { /* ?>
                            <p class="spl"><?php echo $text_tax; ?><span> <?php echo $tax; ?></span></p>
                            <?php */ } ?>

                            <?php if ($points) { ?>
                            <p class="spl"><?php echo $text_points; ?> <span> <?php echo $points; ?></span></p>
                            <?php } ?>


                            <?php } ?>
                            <?php if ($manufacturer) { ?>
                            <p class="spl"><?php echo $text_manufacturer; ?> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></p>
                            <?php } ?>
                            <p class="spl"><?php echo $text_model; ?> <span> <?php echo $model; ?></span></p>
                            <?php if ($reward) { ?>
                            <p class="spl"><?php echo $text_reward; ?> <span><?php echo $reward; ?></span></p>
                            <?php } ?>
                            <p class="spl"><?php echo $text_stock; ?> <span><?php echo $stock; ?></span></p>

                            <?php if ($review_status) { ?>
                            <div class="ratingInfo">
                                <div class="ratingBox">
                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if ($rating < $i) { ?>
                                    <a href=""onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"></a>
                                    <?php } else { ?>
                                    <a class="active" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"></a>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="reviews">  <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); $('html, body').delay(0).animate({
                                scrollTop: $('#review_scorll').offset().top
                            }, 500); return false;"><?php echo $reviews; ?></a> | <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); $('html, body').delay(0).animate({scrollTop: $('.reviewForm').offset().top }, 500); return false;"><img src="catalog/view/theme/hidlighting/images/write-review-ic.svg" alt="Write a review"><?php echo $text_write; ?></a></div>
                                <!--div class="reviews">  <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $reviews; ?></a> | <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $text_write; ?></a></div-->
                                <!-- AddThis Button BEGIN>
                                <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
                                <!-- AddThis Button END -->
                            </div>
                            <?php } ?>
                            <?php if($short_description) { ?>
                            <div class="comp">
                                <?php echo $short_description; ?>
                            </div>
                            <!--p> <?php //echo strip_tags(substr($description, 0, 500)); ?> </p-->
                            <?php } ?>
                        </div>


                    </div>


                    <div class="col-md-3 col-sm-6 col-xs-6 fullBlock" id="product">
                        <?php if ($options) { ?>
                        <div class="productViewinfo">
                            <h3><?php echo $text_option; ?></h3>
                            <div >

                                <hr>

                                <?php foreach ($options as $option) { ?>
                                <?php if ($option['type'] == 'select') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                    <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                                        <option value=""><?php echo $text_select; ?></option>
                                        <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                        <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                            <?php if ($option_value['price']) { ?>
                                            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                            <?php } ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'radio') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label"><?php echo $option['name']; ?></label>
                                    <div id="input-option<?php echo $option['product_option_id']; ?>">
                                        <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                                                <?php echo $option_value['name']; ?>
                                                <?php if ($option_value['price']) { ?>
                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'checkbox') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label"><?php echo $option['name']; ?></label>
                                    <div id="input-option<?php echo $option['product_option_id']; ?>">
                                        <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                                                <?php echo $option_value['name']; ?>
                                                <?php if ($option_value['price']) { ?>
                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'image') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label"><?php echo $option['name']; ?></label>
                                    <div id="input-option<?php echo $option['product_option_id']; ?>">
                                        <?php foreach ($option['product_option_value'] as $option_value) { ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                                                <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> <?php echo $option_value['name']; ?>
                                                <?php if ($option_value['price']) { ?>
                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'text') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'textarea') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                    <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'file') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label"><?php echo $option['name']; ?></label>
                                    <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                                    <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'date') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                    <div class="input-group date">
                                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                                        <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                            </span></div>
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'datetime') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                    <div class="input-group datetime">
                                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                                        <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                </span></div>
                                </div>
                                <?php } ?>
                                <?php if ($option['type'] == 'time') { ?>
                                <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                                    <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                                    <div class="input-group time">
                                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                                        <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                    </span></div>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($recurrings) { ?>
                                <hr>
                                <h3><?php echo $text_payment_recurring ?></h3>
                                <div class="form-group required">
                                    <select name="recurring_id" class="form-control">
                                        <option value=""><?php echo $text_select; ?></option>
                                        <?php foreach ($recurrings as $recurring) { ?>
                                        <option value="<?php echo $recurring['recurring_id'] ?>"><?php echo $recurring['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block" id="recurring-description"></div>
                                </div>
                                <?php } ?>
                                <div class="form-group qtyBlock">
                                    <div class="cartBox"><span>Qty: </span>
                                        <input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="prod-input" />
                                    </div>
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                                    <button type="button" data-toggle="tooltip" data-placement="bottom" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="yellowbtn Btn2" title="<?php echo $button_cart; ?>"><?php echo $button_cart; ?> </button>
                                    <button title="" id="button-cart1" onclick="location.href = '<?php echo $cart; ?>';" class="yellowbtn Btn2" data-placement="bottom" data-toggle="tooltip" type="button" data-original-title="View Cart"  style="display: none;">View Cart </button>
                                    <button type="button" data-toggle="tooltip" data-placement="bottom" class="yellowbtn Btn1 addtocompare" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product_id; ?>');"><?php echo $button_addtocompare; ?></button>
                                    <button type="button" data-toggle="tooltip" data-placement="bottom" class="yellowbtn Btn12" title="<?php echo $button_compare; ?>" onclick="location.href = '<?php echo $compare; ?>';" style="display: none;">Compare Now</button>
                                    <div class="btn-group wishListBtn">
                                        <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn btn-default btnwish" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product_id; ?>');"><i class="fa fa-heart"></i></button>
                                    </div>
                                </div>
                                <?php if ($minimum > 1) { ?>
                                <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                </div>




                <div class="row">


                    <div class="col-md-12 col-ie-12">
                        <div id="customerReview" class="tabbed-content">
                            <nav id="tabs" class="tabs">
                                <ul>
                                    <li><a href="#tab-description" class="active product-faq-form"><?php echo $tab_description; ?></a></li>
                                    <li><a href="#tab-specification" class="product-faq-form">Specifications</a></li>
                                    <li><a href="#tab-questions" data-toggle="tab">FAQ</a></li>
                                </ul>
                            </nav>
                            <section id="tab-description" class="item active" data-title="Discription">
                                <div class="item-content">
                                    <?php echo $description; ?>
                                </div>
                            </section>
                            <section id="tab-specification" class="item" data-title="Specifications">
                                <div class="item-content">
                                    <?php //if ($attribute_groups) { ?>
                                    <div class="tab-pane" id="tab-specification">

                                        <?php echo $spec; ?>
                                    </div>
                                    <?php //} ?>
                                </div>
                            </section>
                            <!-- <div id="tabs">
                                 <ul>
                                     <li class="active"><a href="#tab-description" data-toggle="tab"><?php echo $tab_description; ?></a></li>
                                     <?php //if ($attribute_groups) { ?>
                                     <li><a href="#tab-specification" data-toggle="tab"><?php //echo $tab_attribute; ?> Specifications</a></li>
                                     <?php //} ?>
                                 </ul>
                             </div>
                         -->

                        </div>
                    </div>
                    <?php   // echo "<pre>"; print_r($data) ; echo "</pre>" ;      ?>
                    <?php if ($products) {


                   ?>
                    <div class="col-md-12">
                        <div class="panel-box-title">
                            <h2 class="title-orange"><?php echo $text_related; ?></h2>
                        </div>
                    </div>
                    <?php $i = 0; ?>
                    <?php foreach ($products as $product) { ?>
                    <div class="col-md-3 col-sm-6 col-xs-6 full">
                        <div class="columnOuter">
                            <div class="column">
                                <div class="productThumb"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
                                <div class="desc"><div class="thead"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                                    <div class="cartBox">

                                        <?php $productmoney = $product['price']; ?>
                                        <?php if ($productmoney == '$0.00') { ?>
                                        <p class="price">&nbsp; </p>
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
                    <?php if (($column_left && $column_right) && ($i % 2 == 0)) { ?>
                    <div class="clearfix visible-md visible-sm"></div>
                    <?php } elseif (($column_left || $column_right) && ($i % 3 == 0)) { ?>
                    <div class="clearfix visible-md"></div>
                    <?php } elseif ($i % 4 == 0) { ?>
                    <div class="clearfix visible-md"></div>
                    <?php } ?>
                    <?php $i++; ?>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($tags) { ?>
                    <div class="col-md-12 col-ie-12">
                        <p class="product-tag-box"><?php echo $text_tags; ?>
                            <?php for ($i = 0; $i < count($tags); $i++) { ?>
                            <?php if ($i < (count($tags) - 1)) { ?>
                            <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
                            <?php } else { ?>
                            <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
                            <?php } ?>
                            <?php } ?>
                        </p>
                    </div>
                    <?php } ?>
                    <?php echo $content_bottom; ?></div>
                <?php echo $column_right; ?>
                <?php if($video_link) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-box-title">
                            <h4 class="iframe-title title-orange"><?php echo $video_title ?></h4>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-5">
                        <iframe class="video-iframe" width="100%" height="320" src="<?php echo $video_link?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-7">
                        <div class="overview-section">
                            <?php if ($video_overview) { ?>
                            <h4>Overview</h4>
                            <?php } ?>
                            <p><?php echo $video_overview ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?php if ($review_status) { ?>
                        <div class="panel-box-title">
                            <h3 class="review-title title-orange" id="review_scorll"><?php echo $tab_review; ?> <span class="badge"></span></h3>
                        </div>
                        <?php } ?>
                        <div class="views">
                            <div class="tab-content">
                                <?php if ($review_status) { ?>
                                <div class="tab-pane active" id="tab-review">
                                    <form class="form-horizontal" id="form-review">
                                        <div id="review"></div>
                                        <div class="reviewForm">
                                            <div class="panel-box-title">
                                                <h2 class="title-orange"><?php echo $text_write; ?></h2>
                                            </div>
                                            <?php if ($review_guest) { ?>
                                            <div class="fullWidth required ">
                                                <div class="halfwidth">
                                                    <label for="input-name"><?php echo $entry_name; ?></label>
                                                    <input type="text" name="name" value="" id="input-name" placeholder="Enter your name…" class="textfeild" />
                                                </div>
                                            </div>
                                            <div class="fullWidth required">
                                                <div class="halfwidth">
                                                    <label for="input-review"><?php echo $entry_review; ?></label>
                                                    <textarea name="text" rows="0" cols="0" id="input-review" placeholder="Write Review" class="textareafeild"></textarea>
                                                    <!--div class="help-block"><?php //echo $text_note; ?></div-->
                                                </div>
                                            </div>
                                            <div class="fullWidth required">
                                                <label><?php echo $entry_rating; ?></label>
                                                <div class="star-rating">
                                                    <input id="star-5" type="radio" name="rating" value="5">
                                                    <label for="star-5" title="5 stars">
                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                    </label>
                                                    <input id="star-4" type="radio" name="rating" value="4">
                                                    <label for="star-4" title="4 stars">
                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                    </label>
                                                    <input id="star-3" type="radio" name="rating" value="3">
                                                    <label for="star-3" title="3 stars">
                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                    </label>
                                                    <input id="star-2" type="radio" name="rating" value="2">
                                                    <label for="star-2" title="2 stars">
                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                    </label>
                                                    <input id="star-1" type="radio" name="rating" value="1">
                                                    <label for="star-1" title="1 star">
                                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="fullWidth required">
                                                <div class="halfwidth captcha">
                                                    <?php echo $captcha; ?>
                                                </div>
                                            </div>
                                            <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="yellowbtn"><?php echo "Post"; ?></button>
                                        </div>
                                        <?php } else { ?>
                                        <?php echo $text_login; ?>
                                        <?php } ?>
                                </div>
                                </form>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function () {
        tabControl();

        var resizeTimer;
        $(window).on('resize', function (e) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                tabControl();
            }, 250);
        });

        function tabControl() {
            var tabs = $('.tabbed-content').find('.tabs');
            if (tabs.is(':visible')) {
                tabs.find('a').on('click', function (event) {
                    event.preventDefault();
                    var target = $(this).attr('href'),
                        tabs = $(this).parents('.tabs'),
                        buttons = tabs.find('a'),
                        item = tabs.parents('.tabbed-content').find('.item');
                    buttons.removeClass('active');
                    item.removeClass('active');
                    $(this).addClass('active');
                    $(target).addClass('active');
                });
            } else {
                $('.item').on('click', function () {
                    var container = $(this).parents('.tabbed-content'),
                        currId = $(this).attr('id'),
                        items = container.find('.item');
                    container.find('.tabs a').removeClass('active');
                    items.removeClass('active');
                    $(this).addClass('active');
                    container.find('.tabs a[href$="#' + currId + '"]').addClass('active');
                });
            }
        }

        $('.tabbed-content .item').click(function () {

            $('html, body').animate({

                scrollTop: $(".item.active").offset().top

            }, 1000)

        });
    });


</script>


<script type="text/javascript"><!--
    $('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
        $.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
            dataType: 'json',
            beforeSend: function() {
                $('#recurring-description').html('');
            },
            success: function(json) {
                $('.alert, .text-danger').remove();

                if (json['success']) {
                    $('#recurring-description').html(json['success']);
                }
            }
        });
    });
    //--></script>
<script type="text/javascript"><!--
    $('#button-cart').on('click', function() {
        var quantity = $('#input-quantity').val();
        //~ var requiredQuantity = $("#requiredQuantity").val();
        //~ if(quantity < requiredQuantity ){
        //~ alert('Required quantity is: ' + requiredQuantity);
        //~ return false;
        //~ }
        var result = $.isNumeric(quantity);
        if(result == true){
            $.ajax({
                url: 'index.php?route=checkout/cart/add',
                type: 'post',
                data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
                dataType: 'json',
                beforeSend: function() {
                    $('#button-cart').button('loading');
                },
                complete: function() {
                    $('#button-cart').button('reset');
                },
                success: function(json) {
                    $('.alert, .text-danger').remove();
                    $('.form-group').removeClass('has-error');

                    if (json['error']) {
                        if (json['error']['option']) {
                            for (i in json['error']['option']) {
                                var element = $('#input-option' + i.replace('_', '-'));

                                if (element.parent().hasClass('input-group')) {
                                    element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                } else {
                                    element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                }
                            }
                        }

                        if (json['error']['recurring']) {
                            $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                        }

                        // Highlight any found errors
                        $('.text-danger').parent().addClass('has-error');
                        /*$('#button-cart').hide();
                        $('#button-cart1').show();*/
                    }

                    if (json['success']) {
                        $('#content').before('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

sendAddProductInfo();
                        $('#cart > button').html(json['total']);
                        $('#button-cart').hide();
                        $('#button-cart1').show();

                        //$('html, body').animate({ scrollTop: 0 }, 'slow');

                        $('#cart > ul').load('index.php?route=common/cart/info ul li');
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }else{
            alert('Invalid quanity supplied');
        }
    });
    //--></script>
<script type="text/javascript"><!--
    $('.date').datetimepicker({
        pickTime: false
    });

    $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
    });

    $('.time').datetimepicker({
        pickDate: false
    });

    $('button[id^=\'button-upload\']').on('click', function() {
        var node = this;

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: 'index.php?route=tool/upload',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(node).button('loading');
                    },
                    complete: function() {
                        $(node).button('reset');
                    },
                    success: function(json) {
                        $('.text-danger').remove();

                        if (json['error']) {
                            $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                        }

                        if (json['success']) {
                            alert(json['success']);

                            $(node).parent().find('input').attr('value', json['code']);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
    //--></script>
<script type="text/javascript"><!--
    $('#review').delegate('.pagination a', 'click', function(e) {
        e.preventDefault();

        $('#review').fadeOut('slow');

        $('#review').load(this.href);

        $('#review').fadeIn('slow');
    });

    $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

    $('#button-review').on('click', function() {
        $.ajax({
            url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
            type: 'post',
            dataType: 'json',
            data: $("#form-review").serialize(),
            beforeSend: function() {
                $('#button-review').button('loading');
            },
            complete: function() {
                $('#button-review').button('reset');
            },
            success: function(json) {
                $('.alert-success, .alert-danger').remove();

                if (json['error']) {
                    grecaptcha.reset();
                    $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']) {
                    $('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                }
            }
        });
    });

    $(document).ready(function() {
        $('.thumbnails').magnificPopup({
            type:'image',
            delegate: 'a',
            gallery: {
                enabled:true
            }
        });
    });

    (function() {
        /* Define a variável que dá swipe no lightbox */
        var magnificPopup = $.magnificPopup.instance;

        /* Carrega a função quando clica no lightbox (senão não pega a classe utilizada) */
        $(".thumbnails").click(function(e) {

            /* Espera carregar o lightbox */
            setTimeout(function() {
                /* Swipe para a esquerda - Próximo */
                $(".mfp-container").swipe( {
                    swipeLeft:function(event, direction, distance, duration, fingerCount) {
                        console.log("swipe right");
                        magnificPopup.next();
                    },

                    /* Swipe para a direita - Anterior */
                    swipeRight:function(event, direction, distance, duration, fingerCount) {
                        console.log("swipe left");
                        magnificPopup.prev();
                    },
                });
            }, 500);
        });

    }).call(this);
    $('.product-faq-form').on('click', function() {
        $('#section-product-question-form').hide();
    });
    //--></script>

			<?php if($config_gr_status) { ?>
	<span itemscope itemtype="http://schema.org/Product">
		<meta itemprop="name" content="<?php echo $heading_title; ?>">
		<meta itemprop="url" content="<?php echo $plink; ?>">
		<?php if($meta_description != "") { ?><meta itemprop="description" content="<?php echo $meta_description; ?>" /><?php } ?>
		<?php if(isset($pimage)) { ?><meta itemprop="image" content="<?php echo str_replace(" ","%20",$pimage); ?>" /><?php } ?>
		<?php if($model != "") { ?><meta itemprop="model" content="<?php echo $model; ?>"><?php } ?>
		<?php if($manufacturer != "") { ?><meta itemprop="brand" content="<?php echo $manufacturer; ?>"><?php } ?>
	 	<?php foreach ($pcurrencies as $currency) { ?><span itemscope itemprop="offers" itemtype="http://schema.org/Offer">
				<meta itemprop="price" content="<?php echo $currency['price']; ?>">
				<meta itemprop="priceCurrency" content="<?php echo $currency['code']; ?>">
				<meta itemprop="availability" itemtype="http://schema.org/ItemAvailability" content="http://schema.org/<?php echo ($pstock ? "InStock" : "OutOfStock") ?>">
				<meta itemprop="itemCondition" content="http://schema.org/NewCondition" />
			</span>
		<?php } ?>
		<?php if(isset($ptotalreviews) && $ptotalreviews) { ?>
			<span itemscope itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating">
				<meta itemprop="reviewCount" content="<?php echo $ptotalreviews; ?>">
				<meta itemprop="ratingValue" content="<?php echo $prating; ?>">
			</span>
		<?php } ?>
		<?php foreach($reviewresults as $result) { ?>
			<span itemprop="review" itemscope itemtype="http://schema.org/Review" />
				<meta itemprop="name"  content = "<?php echo substr($result['text'], 0, 15); ?>" />
				<meta itemprop="description" content = "<?php echo $result['text']; ?>" />
				<span itemprop="author" itemscope itemtype="http://schema.org/Person">
				 	<meta itemprop="name" content = "<?php echo $result['author']; ?>" />
				</span>
				<meta itemprop="datePublished" content="<?php echo date('Y-m-d', strtotime($result['date_added'])); ?>" />
				<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
					<meta itemprop="ratingValue" content = "<?php echo $result['rating']; ?>" />
					<meta itemprop="bestRating" content = "5" />
					<meta itemprop="worstRating" content="1" />
				</span>
			</span>
		<?php } ?>
	</span>
<?php } ?>
<?php if($config_gr_status) { ?><?php if(isset($breadcrumbs) && !empty($breadcrumbs)) { ?><script type="application/ld+json">
{
"@context": "http://schema.org",
"@type": "BreadcrumbList",
"itemListElement": [
<?php $temp = 0;end($breadcrumbs); $lastElement = key($breadcrumbs); foreach ($breadcrumbs as $key => $value) { $temp = $temp + 1;?>
{
"@type": "ListItem",
"position": <?php echo $temp ?>,
"item": {
"@id": "<?php echo $value['href']; ?>",
"name": "<?php echo strip_tags($value['text']); ?>"
}  
}<?php if($key == $lastElement) {}else{echo ",";}?>
<?php } ?>
]
}
</script>
<?php } ?>
<?php } ?>


			    <!--START - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
			        <?php echo $product_view_script; ?> 
			        <script type="text/javascript">
			           function sendAddProductInfo() {
    			            $.ajax({
                    		    url: 'index.php?route=extension/module/google_ecommerce/get_product_info&product_id=<?php echo $product_id; ?>',
                    	    	type: 'post',
                    		    dataType: 'json',
                    		    success: function(json) {
                    		        if (json['error']) {
                    		            console.log(json['error']);
                    		        }else{
                    		            gtag('event', 'add_to_cart', {
                                          "items": [
                                            {
                                              "id": json.id,
                                              "name": json.product_name,
                                              "list_name": "Product Page",
                                              "brand": json.brand,
                                              "category": json.category,
                                              "price": json.price
                                            }
                                          ]
                                        });
                    		        }
                    		    }
    	                    });
	                   }
			        </script>
			    <!--END - GOOGLE ANALYTICS ECOMMERCE TRACKING-->
            	
<?php echo $footer; ?>