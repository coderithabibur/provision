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
        <?php if ($downloads) { ?>
      <div id="preCheckout">
          <div class="orderTable table-responsive">
            <table>
            <tbody><tr class="tableHead"> 
              <td class="text-right"><?php echo $column_order_id; ?></td>
              <td class="text-left"><?php echo $column_name; ?></td>
              <td class="text-left"><?php echo $column_size; ?></td>
              <td class="text-left"><?php echo $column_date_added; ?></td>
              <td></td>
            </tr>       
            <?php foreach ($downloads as $download) { ?>
            <tr>
              <td class="text-right"><?php echo $download['order_id']; ?></td>
              <td class="text-left"><?php echo $download['name']; ?></td>
              <td class="text-left"><?php echo $download['size']; ?></td>
              <td class="text-left"><?php echo $download['date_added']; ?></td>
              <td><a href="<?php echo $download['href']; ?>" data-toggle="tooltip" title="<?php echo $button_download; ?>" class="btn btn-primary"><i class="fa fa-cloud-download"></i></a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
          </div>
          <p class="slideView01">Slide table to view </p>
      </div>
        <?php if ($pagination) {?>
    <div class="row">
          <div class="col-sm-12 col-xs-12"> <div class="paginationOuter"><?php echo $pagination; ?></div></div>
      </div>
    <?php } ?>      
        <?php } else { ?>
        <p><?php echo $text_empty; ?></p>
        <?php } ?>
        <div class="buttons clearfix">
          <div class="pull-right"><a href="<?php echo $continue; ?>" class="yellowbtn"><?php echo $button_continue; ?></a></div>
        </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
</section>
<?php echo $footer; ?>