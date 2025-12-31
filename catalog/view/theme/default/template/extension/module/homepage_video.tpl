<?php if ($video_url) { ?>
<div class="homepage-video-module">
  <?php if ($headline) { ?>
  <h2><?php echo $headline; ?></h2>
  <?php } ?>
  <div class="video-container">
    <iframe src="<?php echo $video_url; ?>" frameborder="0" allowfullscreen></iframe>
  </div>
</div>
<?php } ?>
