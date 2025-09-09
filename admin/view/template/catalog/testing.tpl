<?php echo $header; ?><?php echo $column_left; ?><?php echo $seoloadstyles; ?>
<section class="sticky-header">
        <!-- sidebar left start-->
        <?php echo $seomenu; ?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" >
            <!-- header section start-->
            <div class="header-section">

                <!--logo and logo icon start-->
                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="index.html">
                        <img src="view/javascript/aios/img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <!--mega menu start-->
               <?php echo $seomegamenu; ?>
                <!--mega menu end-->

                <div class="notification-wrap">
                <!--left notification start-->
                <div class="left-notification">
                <ul class="notification-menu">

                <!--task info start-->
                <?php echo $seotask; ?>
                <!--task info end-->

                 <!--notification info start-->
                <?php echo $seonotification; ?>
                <!--notification info end-->
               
                </ul>
                </div>
                <!--left notification end-->
                
                </div>

            </div>
            <!-- header section end-->

            <!--body wrapper start-->
            <div class="wrapper">
                 <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
          <div class="page-header"><h1><i class="fa  fa-file-text"></i> Seo report for product</h1></div>
          <table class="pure-table pure-table-bordered" style="  margin: auto;">
            <thead>
            <tr>
              <th>Language</th>
              <th>Total Products Found</th>
              <th>Seo Keywords Found</th>
              <th>Meta Title Found</th>
              <th>Meta Keywords Found</th>
              <th>Meta Description Found</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($productreport as $key => $value) { ?>
               <tr>
              <td><img src="<?php echo $catalog; ?>image/flags/<?php echo $value['image']; ?>"> <?php echo $value['lname']; ?></td>
              <td><?php echo $value['count']; ?></td>
              <td <?php if($value['seok'] == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>><?php echo $value['seok']; ?></td>
              <td <?php if($value['metal']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>><?php echo $value['metal']; ?></td>
              <td <?php if($value['metak']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>><?php echo $value['metak']; ?></td>
              <td <?php if($value['metad']  == $value['count']) { echo "class='g'"; } else { echo  "class='s'"; }?>><?php echo $value['metad']; ?></td>
            </tr>
            <?php  } ?>
            </tbody>
          </table>
          <br><br>
          <div class="page-header"><h1><i class="fa fa-cog"></i> Product Seo Generators</h1></div>
          <table class="pure-table pure-table-bordered" style="width:100%;">
            <thead>
              <tr>
                <td class="left pattern"><?php echo $text_pattern; ?></td>
                <td class="left action"><?php echo $text_action; ?></td>
              </tr>
            </thead>  
            <tbody>
              <tr>
                <td><input type="text" id="products_url_template" name="products_url_template" value="<?php echo $products_url_template;?>" size="80" class="blueprint"><br> <div class="pattern-helper-msg"><?php echo $help_product_seo_description; ?></div></td>
                <td><div class="buttons">
                  <h4>Product Seo Keyword</h4><button type="submit" name="products_url" value="products_url" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button></div></td>
              </tr>
              <tr class="bb2">
                <td><input type="text" id="products_title_template" name="products_title_template" value="<?php echo $products_title_template;?>" size="80" class="blueprint"><br> <div class="pattern-helper-msg"><?php echo $help_product_title; ?></div></td>
                <td><div class="buttons"><h4>Product Meta Title</h4><button type="submit" name="products_title" value="products_title" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button></div></td>
              </tr>
              <tr>
                <td>
                  <input type="text" id="product_keywords_template" name="product_keywords_template" value="<?php echo $product_keywords_template;?>" size="80" class="blueprint"><br> <div class="pattern-helper-msg"><?php echo $help_meta_keywords; ?></div>
                </td>
                <td><div class="buttons"><h4>Product Meta keywords</h4><button type="submit" name="product_keywords" value="product_keywords" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button></div></td>
              </tr>
              <tr>
                <td><input type="text" id="product_description_template" name="product_description_template" value="<?php echo $product_description_template;?>" size="80" class="blueprint"><br> <div class="pattern-helper-msg"><?php echo $help_product_description; ?></div></td>
                <td><div class="buttons"><h4>Product Meta Description</h4><button type="submit" name="product_description" value="product_description" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button></div></td>
              </tr>
              <tr>
                <td><input type="text" id="product_tags_template" name="product_tags_template" value="<?php echo $product_tags_template;?>" size="80" class="blueprint"><br> <div class="pattern-helper-msg"><?php echo $help_product_tags; ?></div></td>
                <td><div class="buttons"><h4>Product Tags</h4><button type="submit" name="product_tags" value="product_tags" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button></div></td>
              </tr>
              <tr>
                <td><input type="text" id="product_image_template" name="product_image_template" value="<?php echo $product_image_template;?>" size="80" class="blueprint"><br> <div class="pattern-helper-msg"><?php echo $help_product_image_description; ?></div></td>
                <td><div class="buttons"><h4>Product SEO Image Name</h4><button type="submit" name="product_image" value="product_image" class="btn btn-primary"><span> <i class="fa fa-cogs"></i> <?php echo $generate;?></span></button></div></td>
              </tr>
              </tbody>
           </table>
       </form>

            </div>
            <!--body wrapper end-->


            <!--footer section start-->
            <footer>
                2016 &copy; ALL IN ONE SEO by NERDHERD
            </footer>
            <!--footer section end--> 

        </div>
        <!-- body content end-->
    </section>
<?php echo $footer; ?>
<!--jquery-ui-->
<?php echo $seoloadscripts; ?>