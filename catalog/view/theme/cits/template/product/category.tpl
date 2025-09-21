<?php echo $header; ?>

<section class="category-product-area">
    <div class="container">
      <div class="category-title">
        <h2><?php echo $heading_title; ?></h2>
      </div>
      <div class="category-filter-area">
        <ul>
          <li><button class="active">LED Headlights</button></li>
          <li><button>LED Headlight Bulbs</button></li>
          <li><button>LED LIGHT BARS</button></li>
          <li><button>LED Work Lights</button></li>
          <li><button>LED Driving Lights</button></li>
          <li><button>LED Headlight Control Modules</button></li>
        </ul>
      </div>
      <div class="category-product-grid"> 
        <?php echo $column_right; ?>
      </div>
    </div>
  </section>

  <section class="category-info-area">
    <div class="container">
      <!-- <h2>Led lights</h2> -->
      <div class="category-content-area">
        <?php echo $description; ?>
      </div>
    </div>
  </section>

  <?php echo $footer; ?>