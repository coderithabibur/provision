<?php if ($logos) { ?>
<div class="client-logos-module">
  <?php if ($title) { ?>
  <h3><?php echo $title; ?></h3>
  <?php } ?>
  <div class="row">
    <?php foreach ($logos as $logo) { ?>
    <div class="col-sm-2 col-xs-4">
      <?php if ($logo['link']) { ?>
      <a href="<?php echo $logo['link']; ?>"><img src="<?php echo $logo['image']; ?>" alt="Client Logo" class="img-responsive" /></a>
      <?php } else { ?>
      <img src="<?php echo $logo['image']; ?>" alt="Client Logo" class="img-responsive" />
      <?php } ?>
    </div>
    <?php } ?>
  </div>
</div>
<?php } ?>
