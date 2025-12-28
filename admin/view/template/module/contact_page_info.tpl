<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-contact-page-info" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-contact-page-info" class="form-horizontal">
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="contact_page_info_status" id="input-status" class="form-control">
                <?php if ($contact_page_info_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <fieldset>
            <legend>Main Section</legend>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-main-title"><?php echo $entry_main_title; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_main_title" value="<?php echo $contact_page_info_main_title; ?>" placeholder="<?php echo $entry_main_title; ?>" id="input-main-title" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-main-desc"><?php echo $entry_main_desc; ?></label>
              <div class="col-sm-10">
                 <textarea name="contact_page_info_main_desc" rows="3" placeholder="<?php echo $entry_main_desc; ?>" id="input-main-desc" class="form-control"><?php echo $contact_page_info_main_desc; ?></textarea>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>Customer Service</legend>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-cs-title"><?php echo $entry_cs_title; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_cs_title" value="<?php echo $contact_page_info_cs_title; ?>" placeholder="<?php echo $entry_cs_title; ?>" id="input-cs-title" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-cs-phone"><?php echo $entry_cs_phone; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_cs_phone" value="<?php echo $contact_page_info_cs_phone; ?>" placeholder="<?php echo $entry_cs_phone; ?>" id="input-cs-phone" class="form-control" />
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-cs-text"><?php echo $entry_cs_text; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="contact_page_info_cs_text" value="<?php echo $contact_page_info_cs_text; ?>" placeholder="<?php echo $entry_cs_text; ?>" id="input-cs-text" class="form-control" />
                </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>Write To Us</legend>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-wtu-title"><?php echo $entry_wtu_title; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_wtu_title" value="<?php echo $contact_page_info_wtu_title; ?>" placeholder="<?php echo $entry_wtu_title; ?>" id="input-wtu-title" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-wtu-email"><?php echo $entry_wtu_email; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_wtu_email" value="<?php echo $contact_page_info_wtu_email; ?>" placeholder="<?php echo $entry_wtu_email; ?>" id="input-wtu-email" class="form-control" />
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>Follow Us</legend>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-fu-title"><?php echo $entry_fu_title; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_fu_title" value="<?php echo $contact_page_info_fu_title; ?>" placeholder="<?php echo $entry_fu_title; ?>" id="input-fu-title" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-facebook"><?php echo $entry_facebook; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_facebook" value="<?php echo $contact_page_info_facebook; ?>" placeholder="<?php echo $entry_facebook; ?>" id="input-facebook" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-youtube"><?php echo $entry_youtube; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_youtube" value="<?php echo $contact_page_info_youtube; ?>" placeholder="<?php echo $entry_youtube; ?>" id="input-youtube" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-blogger"><?php echo $entry_blogger; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_blogger" value="<?php echo $contact_page_info_blogger; ?>" placeholder="<?php echo $entry_blogger; ?>" id="input-blogger" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-instagram"><?php echo $entry_instagram; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact_page_info_instagram" value="<?php echo $contact_page_info_instagram; ?>" placeholder="<?php echo $entry_instagram; ?>" id="input-instagram" class="form-control" />
              </div>
            </div>
          </fieldset>

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
