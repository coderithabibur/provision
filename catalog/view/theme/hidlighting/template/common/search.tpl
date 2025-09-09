 <div class="srchOuter">
            <div class="input-group" id="search">              
              <div class="input-group-btn search-panel">
             <select name="searchCat" id="searchCat" class="btn btn-default"><span class="caret">
      
            <option value="0">All</span>
</option>
            <?php foreach($categories as $cat){
                $sel ="";
                 if(isset($_GET['category_id'])){
                    if($_GET['category_id'] == $cat['id']){
                        $sel = 'selected="selected"';
                    }
                }
                echo '<option value="'.$cat['id'].'"'.$sel.'>'.$cat['name'].'</option>';
            } ?>
        </select>
         
              </div>
              <input type="hidden" name="search_param" value="all" id="search_param">
              <div class="serchbar">
                <div class="input-group">
                  <input type="text" class="form-control" value="<?php echo $search; ?>" name="search" placeholder="Search term...">
                  <span class="input-group-btn">
                  <button type="button" class="btn"><img src="catalog/view/theme/hidlighting/images/search.png" alt=""></button>
                  </span> </div>
              </div>
            </div>
          </div>


