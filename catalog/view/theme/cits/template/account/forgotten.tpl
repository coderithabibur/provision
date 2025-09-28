<?php echo $header; ?>
<section class="acccount-section">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="pageTitle"><h1><?php echo $heading_title; ?></h1></div>
      </div>
    </div>
  </div>

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
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-xs-12 col-sm-8 col-lg-9 col-md-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="account-login-box">
        <div class="row">
            <div class="col-xs-12">
              <div class="theading">
                <h2><?php echo $heading_title; ?></h2>
              </div>
            </div>
          </div>
        <p><?php echo $text_email; ?></p>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
          <fieldset>
            <legend><?php echo $text_your_email; ?></legend>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
              <div class="col-sm-10">
                <input type="text" name="email" value="" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
              </div>
            </div>
          </fieldset>
          <div class="buttons clearfix">
            <div class="pull-left"><a href="<?php echo $back; ?>" class="yellowbtn"><?php echo $button_back; ?></a></div>
            <div class="pull-right">
              <input type="submit" value="<?php echo $button_continue; ?>" class="yellowbtn" />
            </div>
          </div>
        </form>
        </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
</section>
<?php echo $footer; ?>