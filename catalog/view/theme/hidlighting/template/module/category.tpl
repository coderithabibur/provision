<div class="theading margbot">
 <h2>browse Products</h2>
  <div class="sidedown"><i aria-hidden="true" class="fa fa-angle-down"></i></div>
  </div>
 <div class="categories">
   <ul class="catListing">
  <?php $i=1;?> 
   <?php foreach ($categories as $category) { ?>	
            <li class="<?php if ($category['category_id'] == $category_id) { echo "active "; }?>"><a href="<?php echo $category['href']; ?>" title="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></a><?php if ($category['children']) { ?><i aria-hidden="true" class="fa fa-angle-right"></i><?php } ?>
				<?php if ($category['children']) {
                  $j = 1;
                  ?>
		        <ul class="<?php if($j == 1){echo "firstUL" ;}?>">
						  <?php foreach ($category['children'] as $child) { ?>
							 <li class="<?php // if ($category['category_id'] == $category_id) { echo 'active'; }?>" id="dropdownMenu">
								<a href="<?php echo $child['href']; ?>" class=""><?php echo $child['name']; ?>		
								</a>
								<?php if($child['subChild']){ ?>
									<i aria-hidden="true" class="fa fa-angle-right"></i>
										<ul>
											<?php foreach($child['subChild'] as $sub){ ?>
												<li>
													<a href="<?php echo $sub['href']; ?>"><?php echo $sub['name']; ?></a>
												</li>
											<?php } ?>
										</ul>
								<?php } ?>
							</li>
						 <?php $j++; } ?> 
		             </ul>
		  <?php } ?>
		  <?php $i++;?>
          </li>
		  <?php } ?>
   </ul>
</div>
