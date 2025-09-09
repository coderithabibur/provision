
   <div class="product-question-invitation">
      <div class="invitation-left-side">
         <p class="short-description"><?php echo $text_question_invitation; ?></p>
      </div>
      <div class="invitation-right-side">
         <a class="product-question-button" id="button-ask-product-question"><i class="fa fa-fw fa-comments-o"></i> <?php echo $button_ask_question; ?></a>
      </div>
   </div>

   <section id="section-product-question-form">
      <form id="form-product-question" class="form-horizontal">
         <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
         <div class="form-group required">
            <div class="col-sm-12">
               <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
               <input type="text" name="name" value="<?php echo $customer_name; ?>" id="input-name" class="form-control" />
            </div>
         </div>
         <div class="form-group required">
            <div class="col-sm-12">
               <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
               <input type="text" name="email" value="<?php echo $customer_email;  ?>" id="input-email" class="form-control" />
            </div>
         </div>
         <div class="form-group hidden">
            <div class="col-sm-12">
               <label class="control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
               <input type="text" name="telephone" value="<?php echo $customer_telephone;  ?>" id="input-telephone" class="form-control" />
            </div>
         </div>
         <div class="form-group required">
            <div class="col-sm-12">
               <label class="control-label" for="input-question"><?php echo $entry_question; ?></label>
               <textarea name="question" rows="8" id="input-question" class="form-control"></textarea>
           </div>
         </div>
         <?php echo $captcha; ?>
         <div class="buttons">
            <a id="button-send-product-question" class="product-question-button"><?php echo $button_send_question; ?></a>
         </div>
      </form>
      <div class="loading-mask-overlay">
         <div class="loading-mask-loading">
            <div class="uil-ripple-css"><div></div><div></div></div>
         </div>
      </div>
   </section>

   <div id="product-question-list"></div>
