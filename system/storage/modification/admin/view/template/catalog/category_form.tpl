<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>

            <li><a href="#tab-google" data-toggle="tab"><?php echo $tab_google; ?></a></li>
            
            <li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="category_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="category_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                    <div class="col-sm-10">
                      <textarea name="category_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                    </div>
                  </div>
                  <!----Refine Search Text--->
                  
                   <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-refine-search-text<?php echo $language['language_id']; ?>">Refine Search Text</label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[<?php echo $language['language_id']; ?>][refine_search_text]" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['refine_search_text'] : ''; ?>" placeholder="Refine Search Text" id="input-refine-search-text<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
                  </div>
                  
                  <!------->
                  <!---Product Listing Text---->
                  
                   <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-product-listing-text<?php echo $language['language_id']; ?>">Product Listing Text</label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[<?php echo $language['language_id']; ?>][product_listing_text]" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['product_listing_text'] : ''; ?>" placeholder="Product Listing Text" id="input-product-listing-text<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
                  </div>
                  
                  <!------->
                  
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane" id="tab-data">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_parent; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="path" value="<?php echo $path; ?>" placeholder="<?php echo $entry_parent; ?>" id="input-parent" class="form-control" />
                  <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-filter"><span data-toggle="tooltip" title="<?php echo $help_filter; ?>"><?php echo $entry_filter; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="filter" value="" placeholder="<?php echo $entry_filter; ?>" id="input-filter" class="form-control" />
                  <div id="category-filter" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($category_filters as $category_filter) { ?>
                    <div id="category-filter<?php echo $category_filter['filter_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category_filter['name']; ?>
                      <input type="hidden" name="category_filter[]" value="<?php echo $category_filter['filter_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    <div class="checkbox">
                      <label>
                        <?php if (in_array(0, $category_store)) { ?>
                        <input type="checkbox" name="category_store[]" value="0" checked="checked" />
                        <?php echo $text_default; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="category_store[]" value="0" />
                        <?php echo $text_default; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php foreach ($stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($store['store_id'], $category_store)) { ?>
                        <input type="checkbox" name="category_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                        <?php echo $store['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="category_store[]" value="<?php echo $store['store_id']; ?>" />
                        <?php echo $store['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>                
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="<?php echo $help_top; ?>"><?php echo $entry_top; ?></span></label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($top) { ?>
                      <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                      <?php } else { ?>
                      <input type="checkbox" name="top" value="1" id="input-top" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-column"><span data-toggle="tooltip" title="<?php echo $help_column; ?>"><?php echo $entry_column; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="column" value="<?php echo $column; ?>" placeholder="<?php echo $entry_column; ?>" id="input-column" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

			<div class="tab-pane" id="tab-google">
       <div class="form-group">
            <label class="col-sm-2 control-label" for="select-gpc"><span data-toggle="tooltip" title="<?php echo $help_p_google_category; ?><br><br><?php echo $entry_choose_google_category_xml; ?>"><?php echo $entry_p_google_category; ?></span></label>
            <div class="col-sm-8">
			<?php $nogpc = 17; if($config_gpc_gb != ''){ ?>
			<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/gb.png" /></span><span class="input-group-addon"><img src="view/image/flags/in.png" /> <img src="view/image/flags/ch.png" /></span><input id="input-gpc" type="text" name="google_category_gb" placeholder="<?php echo $text_gpc_gb; ?>" value="<?php echo $google_category_gb; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_gb" value="" /><?php } ?>
            <?php if($config_gpc_us != ''){ ?>
			<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/us.png" /></span><span class="input-group-addon"><img src="view/image/flags/ca.png" /></span><input type="text" name="google_category_us" placeholder="<?php echo $text_gpc_us; ?>" value="<?php echo $google_category_us; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=en-US','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_us" value="" /><?php } ?>
            <?php if($config_gpc_au != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/au.png" /></span><input type="text" name="google_category_au" placeholder="<?php echo $text_gpc_au; ?>" value="<?php echo $google_category_au; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=en-AU','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_au" value="" /><?php } ?>
            <?php if($config_gpc_fr != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/fr.png" /></span><span class="input-group-addon"><img src="view/image/flags/be.png" /> <img src="view/image/flags/ca.png" /> <img src="view/image/flags/ch.png" /></span><input type="text" name="google_category_fr" placeholder="<?php echo $text_gpc_fr; ?>" value="<?php echo $google_category_fr; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=fr-FR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_fr" value="" /><?php } ?>
            <?php if($config_gpc_de != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/de.png" /></span><span class="input-group-addon"><img src="view/image/flags/at.png" /> <img src="view/image/flags/ch.png" /></span><input type="text" name="google_category_de" placeholder="<?php echo $text_gpc_de; ?>" value="<?php echo $google_category_de; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=de-DE','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_de" value="" /><?php } ?>
            <?php if($config_gpc_it != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/it.png" /></span><span class="input-group-addon"><img src="view/image/flags/ch.png" /></span><input type="text" name="google_category_it" placeholder="<?php echo $text_gpc_it; ?>" value="<?php echo $google_category_it; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=it-IT','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_it" value="" /><?php } ?>
            <?php if($config_gpc_nl != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/nl.png" /></span><span class="input-group-addon"><img src="view/image/flags/be.png" /></span><input type="text" name="google_category_nl" placeholder="<?php echo $text_gpc_nl; ?>" value="<?php echo $google_category_nl; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=nl-NL','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_nl" value="" /><?php } ?>
            <?php if($config_gpc_es != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/es.png" /></span><span class="input-group-addon"><img src="view/image/flags/mx.png" /></span><input type="text" name="google_category_es" placeholder="<?php echo $text_gpc_es; ?>" value="<?php echo $google_category_es; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=es-ES','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_es" value="" /><?php } ?>
            <?php if($config_gpc_pt != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/br.png" /></span><input type="text" name="google_category_pt" placeholder="<?php echo $text_gpc_pt; ?>" value="<?php echo $google_category_pt; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=pt-BR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_pt" value="" /><?php } ?>
            <?php if($config_gpc_cz != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/cz.png" /></span><input type="text" name="google_category_cz" placeholder="<?php echo $text_gpc_cz; ?>" value="<?php echo $google_category_cz; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=cs-CZ','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_cz" value="" /><?php } ?>
            <?php if($config_gpc_jp != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/jp.png" /></span><input type="text" name="google_category_jp" placeholder="<?php echo $text_gpc_jp; ?>" value="<?php echo $google_category_jp; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=ja-JP','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_jp" value="" /><?php } ?>
            <?php if($config_gpc_dk != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/dk.png" /></span><input type="text" name="google_category_dk" placeholder="<?php echo $text_gpc_da; ?>" value="<?php echo $google_category_dk; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=da-DK','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_dk" value="" /><?php } ?>
            <?php if($config_gpc_no != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/no.png" /></span><input type="text" name="google_category_no" placeholder="<?php echo $text_gpc_no; ?>" value="<?php echo $google_category_no; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=no-NO','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_no" value="" /><?php } ?>
            <?php if($config_gpc_pl != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/pl.png" /></span><input type="text" name="google_category_pl" placeholder="<?php echo $text_gpc_pl; ?>" value="<?php echo $google_category_pl; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=pl-PL','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_pl" value="" /><?php } ?>
            <?php if($config_gpc_ru != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/ru.png" /></span><input type="text" name="google_category_ru" placeholder="<?php echo $text_gpc_ru; ?>" value="<?php echo $google_category_ru; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=ru-RU','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_ru" value="" /><?php } ?>
            <?php if($config_gpc_sv != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/se.png" /></span><input type="text" name="google_category_sv" placeholder="<?php echo $text_gpc_sv; ?>" value="<?php echo $google_category_sv; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=sv-SE','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_sv" value="" /><?php } ?>
            <?php if($config_gpc_tr != ''){ ?>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/tr.png" /></span><input type="text" name="google_category_tr" placeholder="<?php echo $text_gpc_tr; ?>" value="<?php echo $google_category_tr; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=tr-TR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div>
			<?php }else{ $nogpc --; ?><input type="hidden" id="input-gpc" name="google_category_tr" value="" /><?php } ?>
<?php if($nogpc === 0){ echo $warning_nogpc; } ?></div>
          </div>
          </div>
        	
            <div class="tab-pane" id="tab-design">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_store; ?></td>
                      <td class="text-left"><?php echo $entry_layout; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left"><?php echo $text_default; ?></td>
                      <td class="text-left"><select name="category_layout[0]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($category_layout[0]) && $category_layout[0] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php foreach ($stores as $store) { ?>
                    <tr>
                      <td class="text-left"><?php echo $store['name']; ?></td>
                      <td class="text-left"><select name="category_layout[<?php echo $store['store_id']; ?>]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($category_layout[$store['store_id']]) && $category_layout[$store['store_id']] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({
	height: 300
});
<?php } ?>
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'path\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					category_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'path\']').val(item['label']);
		$('input[name=\'parent_id\']').val(item['value']);
	}
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'filter\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['filter_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter\']').val('');

		$('#category-filter' + item['value']).remove();

		$('#category-filter').append('<div id="category-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_filter[]" value="' + item['value'] + '" /></div>');
	}
});

$('#category-filter').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?>
