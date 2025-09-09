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
<div id="content">
  <div id="cssmenu">
  </div>
     <div class="page-header">
      <div class="container-fluid">
        <div class="pull-right">
             <a href="<?php echo $clear_all; ?>" class="btn btn-primary"><i class="fa fa-eraser"></i> Clear All</a>
             <a href="<?php echo $cancel; ?>" class="btn btn-primary"><i class="fa fa-reply"></i> Back</a>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Check your broken links below</h3>
      </div>
      <div class="panel-body">
       <div class="alert alert-danger">
         This page consist of all Url's that has failed on the store.<br>
          It is automatically updated as an when some url fails over the store.<br>
           <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <table class="table table-striped custom-table table-hover">
          <thead>
            <tr>
              <td class="center"><?php if ($sort == 'date') { ?>
                <a href="<?php echo $sort_date; ?>" title="Date Of Failure" class="<?php echo strtolower($order); ?>"><?php echo $date; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date; ?>" title="Date Of Failure"><?php echo $date; ?></a>
                <?php } ?></td>
              <td class="center"><?php if ($sort == 'failed_url') { ?>
                <a href="<?php echo $sort_failed_url; ?>" title="Failed Url In Store Front" class="<?php echo strtolower($order); ?>"><?php echo $failed_url; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_failed_url; ?>" title="Failed Url In Store Front"><?php echo $failed_url; ?></a>
                <?php } ?></td>
              <td class="center"><?php if ($sort == 'count') { ?>
                <a href="<?php echo $sort_count; ?>" title="Rate Of Failure" class="<?php echo strtolower($order); ?>"><?php echo $count; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_count; ?>" title="Rate Of Failure"><?php echo $count; ?></a>
                <?php } ?>
              </td>
              <td class="center" title="Assign Redirection To Failed Links">
                <?php echo $create_redirect; ?>
              </td>
            </tr>
          </thead>
          <tbody>
            <?php if ($redirectlist) { ?>
            <?php foreach ($redirectlist as $redirect) { ?>
            <form action="<?php echo $redirect['action']; ?>" method="post" enctype="multipart/form-data" id="form<?php echo $redirect['index']; ?>">
            <tr>
              <td class="center"><?php echo $redirect['date']; ?></td>
              <td class="center" style="width:60%;height:30px;"><textarea disabled style="width:95%" name="fromTable"/><?php echo $redirect['failedUrl']; ?></textarea></td>
              <td class="center failcount"><?php echo $redirect['count'] ?></td>
              <td class="center"><a onclick="$(this).parent().parent().find('textarea').attr('disabled', false);$('#form<?php echo $redirect['index'] ?>').submit()" class="btn btn-warning" ><?php echo $insert_redirect; ?></a></td>
            </tr>
          </form>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          
          </tbody>
        </table>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
    </div>
</div>
</div>
<script>
 $(".delete").click(function(){
      if (!confirm('Are you sure you want to delete this?')) {
        return false;
      } else {
        return true;
      }
  }); 
</script>
  <?php echo $footer; ?>
<?php echo $seoloadscripts; ?>