<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><?php if(md5($licensed)=='e9dc924f238fa6cc29465942875fe8f0' && $state=='complete'){ ?>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary gensave"><i class="fa fa-save"></i></button><?php } ?>
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
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
    </div>
    <div class="panel-body">
        <?php if ($error_warning || $error_duplicate) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo ($error_warning?$error_warning:$error_duplicate); ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
      <?php if(md5($licensed)=='e9dc924f238fa6cc29465942875fe8f0'){ ?>
      <?php if($state!='complete'){ ?>
      <div id="create_data">
      <h2><?php echo $text_initialise_data; ?></h2>
      <?php echo $text_initialise_data_text; ?>
      <a onclick="$('#create_data').hide();$('#creating_data').show();location = '<?php echo $uksb_install_link; ?>';"><button type="button" id="loading" class="btn btn-primary">
 <?php echo $button_run; ?>
</button></a>
      </div>
      <div id="creating_data" style="display:none;">
      <p><img src="view/image/create_data.gif"></p>
      </div>
      <?php } else { ?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-uksb-google-merchant" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-google-settings" class="general2" data-toggle="tab"><?php echo $tab_google_settings; ?></a></li>
            <li><a href="#tab-google-feeds" class="general3" data-toggle="tab"><?php echo $tab_google_feeds; ?></a></li>
            <li><a href="javascript:void(0);" class="show_bulk"><?php echo $tab_bulk_update; ?></a></li>
            <li><a href="#tab-videos" class="general4" data-toggle="tab"><?php echo $tab_videos; ?></a></li>
          </ul>
      <div class="tab-content">    
    <div class="tab-pane active" id="tab-google-settings">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="free_support"><?php echo $entry_free_support; ?></label>
            <div class="col-sm-10">
              <span id="free_support"><?php echo $text_free_support_remaining; ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status1"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary<?php if ($uksb_google_merchant_status) { ?> active<?php } ?>">
                        <input type="radio" name="uksb_google_merchant_status" id="input-status1" value="1"<?php if ($uksb_google_merchant_status) { ?> checked<?php } ?>><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-primary<?php if (!$uksb_google_merchant_status) { ?> active<?php } ?>">
                        <input type="radio" name="uksb_google_merchant_status" id="input-status2" value="0"<?php if (!$uksb_google_merchant_status) { ?> checked<?php } ?>><?php echo $text_disabled; ?>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-characters1"><span data-toggle="tooltip" title="<?php echo $help_characters; ?>"><?php echo $entry_characters; ?></span></label>
            <div class="col-sm-10">
              <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary<?php if ($uksb_google_merchant_characters) { ?> active<?php } ?>">
                        <input type="radio" name="uksb_google_merchant_characters" id="input-characters1" value="1"<?php if ($uksb_google_merchant_characters) { ?> checked<?php } ?>><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-primary<?php if (!$uksb_google_merchant_characters) { ?> active<?php } ?>">
                        <input type="radio" name="uksb_google_merchant_characters" id="input-characters2" value="0"<?php if (!$uksb_google_merchant_characters) { ?> checked<?php } ?>><?php echo $text_disabled; ?>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="split"><span data-toggle="tooltip" title="<?php echo $help_split; ?>"><?php echo $entry_split; ?></span></label>
            <div class="col-sm-10">
              <select name="uksb_google_merchant_split" id="split" class="form-control">
                <option value="0"<?php if (!$uksb_google_merchant_split) { ?> selected="selected"<?php } ?>><?php echo $text_disabled; ?></option>
                <option value="50"<?php if ($uksb_google_merchant_split=='50') { ?> selected="selected"<?php } ?>>50</option>
                <option value="100"<?php if ($uksb_google_merchant_split=='100') { ?> selected="selected"<?php } ?>>100</option>
                <option value="250"<?php if ($uksb_google_merchant_split=='250') { ?> selected="selected"<?php } ?>>250</option>
                <option value="500"<?php if ($uksb_google_merchant_split=='500') { ?> selected="selected"<?php } ?>>500</option>
                <option value="750"<?php if ($uksb_google_merchant_split=='750') { ?> selected="selected"<?php } ?>>750</option>
                <option value="1000"<?php if ($uksb_google_merchant_split=='1000') { ?> selected="selected"<?php } ?>>1000</option>
                <option value="1500"<?php if ($uksb_google_merchant_split=='1500') { ?> selected="selected"<?php } ?>>1500</option>
                <option value="2000"<?php if ($uksb_google_merchant_split=='2000') { ?> selected="selected"<?php } ?>>2000</option>
                <option value="2500"<?php if ($uksb_google_merchant_split=='2500') { ?> selected="selected"<?php } ?>>2500</option>
                <option value="3000"<?php if ($uksb_google_merchant_split=='3000') { ?> selected="selected"<?php } ?>>3000</option>
                <option value="3500"<?php if ($uksb_google_merchant_split=='3500') { ?> selected="selected"<?php } ?>>3500</option>
                <option value="4000"<?php if ($uksb_google_merchant_split=='4000') { ?> selected="selected"<?php } ?>>4000</option>
                <option value="4500"<?php if ($uksb_google_merchant_split=='4500') { ?> selected="selected"<?php } ?>>4500</option>
                <option value="5000"<?php if ($uksb_google_merchant_split=='5000') { ?> selected="selected"<?php } ?>>5000</option>
                <option value="6000"<?php if ($uksb_google_merchant_split=='6000') { ?> selected="selected"<?php } ?>>6000</option>
                <option value="7000"<?php if ($uksb_google_merchant_split=='7000') { ?> selected="selected"<?php } ?>>7000</option>
                <option value="8000"<?php if ($uksb_google_merchant_split=='8000') { ?> selected="selected"<?php } ?>>8000</option>
                <option value="9000"<?php if ($uksb_google_merchant_split=='9000') { ?> selected="selected"<?php } ?>>9000</option>
                <option value="10000"<?php if ($uksb_google_merchant_split=='10000') { ?> selected="selected"<?php } ?>>10000</option>
                <option value="12500"<?php if ($uksb_google_merchant_split=='12500') { ?> selected="selected"<?php } ?>>12500</option>
                <option value="15000"<?php if ($uksb_google_merchant_split=='15000') { ?> selected="selected"<?php } ?>>15000</option>
                <option value="20000"<?php if ($uksb_google_merchant_split=='20000') { ?> selected="selected"<?php } ?>>20000</option>
                <option value="25000"<?php if ($uksb_google_merchant_split=='25000') { ?> selected="selected"<?php } ?>>25000</option>
                <option value="30000"<?php if ($uksb_google_merchant_split=='30000') { ?> selected="selected"<?php } ?>>30000</option>
                <option value="40000"<?php if ($uksb_google_merchant_split=='40000') { ?> selected="selected"<?php } ?>>40000</option>
                <option value="50000"<?php if ($uksb_google_merchant_split=='50000') { ?> selected="selected"<?php } ?>>50000</option>
              </select></div>
          </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-cron1"><span data-toggle="tooltip" title="<?php echo $help_cron; ?>"><?php echo $entry_cron; ?></span></label>
            <div class="col-sm-10">
              <div class="btn-group" data-toggle="buttons">
                    <label onclick="$('#split_help').fadeOut().fadeIn();$( '#split' ).val('0');" class="btn btn-primary<?php if ($uksb_google_merchant_cron) { ?> active<?php } ?>">
                        <input type="radio" name="uksb_google_merchant_cron" id="input-cron1" value="1"<?php if ($uksb_google_merchant_cron) { ?> checked<?php } ?>><?php echo $text_enabled; ?>
                    </label>
                    <label onclick="$('#split_help').fadeOut().fadeIn();" class="btn btn-primary<?php if (!$uksb_google_merchant_cron) { ?> active<?php } ?>">
                        <input type="radio" name="uksb_google_merchant_cron" id="input-cron2" value="0"<?php if (!$uksb_google_merchant_cron) { ?> checked<?php } ?>><?php echo $text_disabled; ?>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group" id="split_help" style="display:none;">
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-10"><span style="color:red;"><br><?php echo $help_split_help; ?></span></div>
          </div>
       <div class="form-group">
            <label class="col-sm-2 control-label" for="select-gpc"><span data-toggle="tooltip" title="<?php echo $help_google_category; ?><br><br><?php echo $entry_choose_google_category_xml; ?>"><?php echo $entry_google_category; ?></span></label>
            <div class="col-sm-8"><div class="input-group"><span class="input-group-addon"><img src="view/image/flags/gb.png" /></span><span class="input-group-addon"><img src="view/image/flags/in.png" /> <img src="view/image/flags/ch.png" /></span><input id="select-gpc" type="text" name="uksb_google_merchant_google_category_gb" placeholder="<?php echo $text_gpc_gb; ?>" value="<?php echo $uksb_google_merchant_google_category_gb; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/us.png" /></span><span class="input-group-addon"><img src="view/image/flags/ca.png" /></span><input type="text" name="uksb_google_merchant_google_category_us" placeholder="<?php echo $text_gpc_us; ?>" value="<?php echo $uksb_google_merchant_google_category_us; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=en-US','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/au.png" /></span><input type="text" name="uksb_google_merchant_google_category_au" placeholder="<?php echo $text_gpc_au; ?>" value="<?php echo $uksb_google_merchant_google_category_au; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=en-AU','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/fr.png" /></span><span class="input-group-addon"><img src="view/image/flags/be.png" /> <img src="view/image/flags/ca.png" /> <img src="view/image/flags/ch.png" /></span><input type="text" name="uksb_google_merchant_google_category_fr" placeholder="<?php echo $text_gpc_fr; ?>" value="<?php echo $uksb_google_merchant_google_category_fr; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=fr-FR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/de.png" /></span><span class="input-group-addon"><img src="view/image/flags/at.png" /> <img src="view/image/flags/ch.png" /></span><input type="text" name="uksb_google_merchant_google_category_de" placeholder="<?php echo $text_gpc_de; ?>" value="<?php echo $uksb_google_merchant_google_category_de; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=de-DE','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/it.png" /></span><span class="input-group-addon"><img src="view/image/flags/ch.png" /></span><input type="text" name="uksb_google_merchant_google_category_it" placeholder="<?php echo $text_gpc_it; ?>" value="<?php echo $uksb_google_merchant_google_category_it; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=it-IT','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/nl.png" /></span><span class="input-group-addon"><img src="view/image/flags/be.png" /></span><input type="text" name="uksb_google_merchant_google_category_nl" placeholder="<?php echo $text_gpc_nl; ?>" value="<?php echo $uksb_google_merchant_google_category_nl; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=nl-NL','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/es.png" /></span><span class="input-group-addon"><img src="view/image/flags/mx.png" /></span><input type="text" name="uksb_google_merchant_google_category_es" placeholder="<?php echo $text_gpc_es; ?>" value="<?php echo $uksb_google_merchant_google_category_es; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=es-ES','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/br.png" /></span><input type="text" name="uksb_google_merchant_google_category_pt" placeholder="<?php echo $text_gpc_pt; ?>" value="<?php echo $uksb_google_merchant_google_category_pt; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=pt-BR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/cz.png" /></span><input type="text" name="uksb_google_merchant_google_category_cz" placeholder="<?php echo $text_gpc_cz; ?>" value="<?php echo $uksb_google_merchant_google_category_cz; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=cs-CZ','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/jp.png" /></span><input type="text" name="uksb_google_merchant_google_category_jp" placeholder="<?php echo $text_gpc_jp; ?>" value="<?php echo $uksb_google_merchant_google_category_jp; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=ja-JP','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/dk.png" /></span><input type="text" name="uksb_google_merchant_google_category_dk" placeholder="<?php echo $text_gpc_da; ?>" value="<?php echo $uksb_google_merchant_google_category_dk; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=da-DK','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/no.png" /></span><input type="text" name="uksb_google_merchant_google_category_no" placeholder="<?php echo $text_gpc_no; ?>" value="<?php echo $uksb_google_merchant_google_category_no; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=no-NO','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/pl.png" /></span><input type="text" name="uksb_google_merchant_google_category_pl" placeholder="<?php echo $text_gpc_pl; ?>" value="<?php echo $uksb_google_merchant_google_category_pl; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=pl-PL','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/ru.png" /></span><input type="text" name="uksb_google_merchant_google_category_ru" placeholder="<?php echo $text_gpc_ru; ?>" value="<?php echo $uksb_google_merchant_google_category_ru; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=ru-RU','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/se.png" /></span><input type="text" name="uksb_google_merchant_google_category_sv" placeholder="<?php echo $text_gpc_sv; ?>" value="<?php echo $uksb_google_merchant_google_category_sv; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=sv-SE','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
            <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/tr.png" /></span><input type="text" name="uksb_google_merchant_google_category_tr" placeholder="<?php echo $text_gpc_tr; ?>" value="<?php echo $uksb_google_merchant_google_category_tr; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $home; ?>taxonomy.php?lang=tr-TR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="select-mpn"><span data-toggle="tooltip" title="<?php echo $help_mpn; ?>"><?php echo $entry_mpn; ?></span></label>
            <div class="col-sm-10">
              <select name="uksb_google_merchant_mpn" id="select-mpn" class="form-control">
                <option value="sku"<?php if ($uksb_google_merchant_mpn=='sku') { ?> selected="selected"<?php } ?>><?php echo $text_sku; ?></option>
                <option value="model"<?php if (!$uksb_google_merchant_mpn||$uksb_google_merchant_mpn=='model') { ?> selected="selected"<?php } ?>><?php echo $text_model; ?></option>
                <option value="mpn"<?php if ($uksb_google_merchant_mpn=='mpn') { ?> selected="selected"<?php } ?>><?php echo $text_mpn; ?></option>
                <option value="location"<?php if ($uksb_google_merchant_mpn=='location') { ?> selected="selected"<?php } ?>><?php echo $text_location; ?></option>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="select-gtin"><span data-toggle="tooltip" title="<?php echo $help_gtin; ?>"><?php echo $entry_gtin; ?></span></label>
            <div class="col-sm-10">
              <select name="uksb_google_merchant_g_gtin" id="select-gtin" class="form-control">
                <option value="default"<?php if (!$uksb_google_merchant_g_gtin||$uksb_google_merchant_g_gtin=='default') { ?> selected="selected"<?php } ?>><?php echo $text_default; ?></option>
                <option value="sku"<?php if ($uksb_google_merchant_g_gtin=='sku') { ?> selected="selected"<?php } ?>><?php echo $text_sku; ?></option>
                <option value="gtin"<?php if ($uksb_google_merchant_g_gtin=='gtin') { ?> selected="selected"<?php } ?>><?php echo $text_gtin; ?></option>
                <option value="location"<?php if ($uksb_google_merchant_g_gtin=='location') { ?> selected="selected"<?php } ?>><?php echo $text_location; ?></option>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_info; ?></label>
            <div class="col-sm-10"><?php echo $help_google_help . '<br><br>' . $help_info; ?></div>
          </div>
        </div>
         <div class="tab-pane" id="tab-google-feeds">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="google-site"><span data-toggle="tooltip" title="<?php echo $help_site; ?>"><?php echo $entry_site; ?></span></label>
            <div class="col-sm-10">
              <select name="uksb_google_merchant_site" id="google_site" class="form-control">
                <option value="default" selected="selected">Store Default</option>
                <option value="gb">United Kingdom</option>
                <option value="us">United States of America</option>
                <option value="ca">Canada (English)</option>
                <option value="ca_fr">Canada (Français)</option>
                <option value="mx">México</option>
                <option value="au">Australia</option>
                <option value="fr">France</option>
                <option value="de">Deutschland</option>
                <option value="it">Italia</option>
                <option value="nl">Nederlands</option>
                <option value="es">España</option>
                <option value="be_nl">België (Nederlands)</option>
                <option value="be_fr">Belgique (Français)</option>
                <option value="at">Österreich</option>
                <option value="dk">Danmark</option>
                <option value="no">Norge</option>
                <option value="sv">Sverige</option>
                <option value="pl">Polska</option>
                <option value="cz">Československo</option>
                <option value="ch">Switzerland (English)</option>
                <option value="ch_fr">Suisse (Français)</option>
                <option value="ch_de">Schweiz (Deutsch)</option>
                <option value="ch_it">Svizzera (Italiano)</option>
                <option value="ru">Россия</option>
                <option value="tr">Türkiye</option>
                <option value="br">Brasil</option>
                <option value="in">India (English)</option>
                <option value="ja">日本</option>
              </select></div>
          </div>
          <?php if($config_cron){ ?>
          <div class="form-group">
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-10"><?php echo $help_cron_code; ?></div>
          </div>
          <?php } ?>
          <?php
          $feeds = explode("^", $data_feed);
          $crons = ($config_cron?explode("^", $data_cron_path):'');
          $i=0;
          foreach (array_keys($feeds) as $key) {
            if($config_cron){ ?>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="cron_code_<?php echo $i; ?>"><?php echo $entry_cron_code; ?></label>
          <div class="col-sm-10"><textarea id="cron_code_<?php echo $i; ?>" rows="2" class="form-control" readonly onClick="$(this).select();"><?php echo $crons[$key]; ?></textarea></div>
          </div>
            <?php } ?>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="feed_url_<?php echo $i; ?>"><?php echo $entry_data_feed; ?></label>
          <div class="col-sm-10"><textarea id="feed_url_<?php echo $i; ?>" rows="2" class="form-control" readonly onClick="$(this).select();"><?php echo $feeds[$key]; ?></textarea></div>
          </div>
          <?php
          $i++;
          } ?>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_info; ?></label>
            <div class="col-sm-10"><?php echo $help_google_help . '<br><br>' . $help_info; ?></div>
          </div>
        </div>
        <div class="tab-pane" id="tab-videos">
          <div class="form-group">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 embed-responsive embed-responsive-16by9"><iframe src="//www.youtube.com/embed/videoseries?list=SPzQz7G36iOiZsePOZPhA8band-1rxZ9ae" frameborder="0" allowfullscreen></iframe></div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_info; ?></label>
            <div class="col-sm-10"><?php echo $help_info; ?></div>
          </div>
        </div>
      </div>        
    </form>
    <form style="display:none;" action="<?php echo $action_bulk_update; ?>" method="post" enctype="multipart/form-data" id="form-bulk-update" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li><a href="javascript:void(0);" class="show_general2"><?php echo $tab_google_settings; ?></a></li>
            <li><a href="javascript:void(0);" class="show_general3"><?php echo $tab_google_feeds; ?></a></li>
            <li class="active"><a href="#tab-bulk_update" data-toggle="tab"><?php echo $tab_bulk_update; ?></a></li>
            <li><a href="javascript:void(0);" class="show_general4"><?php echo $tab_videos; ?></a></li>
          </ul>
      <div class="tab-content">    
        <?php echo $help_bulk_update_info; ?>
        <div class="tab-pane active" id="tab-bulk_update">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_on_google1"><span data-toggle="tooltip" title="<?php echo $help_p_on_google; ?>"><?php echo $entry_p_on_google; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_on_google" value="0" checked></label></label>
          
          <div class="col-sm-10">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary active">
                <input type="radio" name="g_on_google" id="input-g_on_google1" value="1" checked><?php echo $text_yes; ?>
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="g_on_google" id="input-g_on_google2" value="0"><?php echo $text_no; ?>
              </label>
            </div>
          </div>
        </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_promotion_id"><span data-toggle="tooltip" title="<?php echo $help_p_promotion_id; ?>"><?php echo $entry_p_promotion_id; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_promotion_id" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_promotion_id" value="" placeholder="<?php echo $entry_p_promotion_id; ?>" id="input-g_promotion_id" class="form-control" />
          </div>
          </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-p_expiry_date"><span data-toggle="tooltip" title="<?php echo $help_p_expiry_date; ?>"><?php echo $entry_p_expiry_date; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_expiry_date" value="0" checked></label></label>
          <div class="col-sm-3">
            <div class="input-group expiry-date">
            <input type="text" name="g_expiry_date" value="" placeholder="<?php echo $entry_p_expiry_date; ?>" data-date-format="YYYY-MM-DD" id="input-p_expiry_date" class="form-control" />
            <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
            </span></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_identifier_exists1"><span data-toggle="tooltip" title="<?php echo $help_p_identifier_exists; ?>"><?php echo $entry_p_identifier_exists; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_identifier_exists" value="0" checked></label></label>
          <div class="col-sm-10">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary active">
                <input type="radio" name="g_identifier_exists" id="input-g_identifier_exists1" value="1" checked><?php echo $text_yes; ?>
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="g_identifier_exists" id="input-g_identifier_exists2" value="0"><?php echo $text_no; ?>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_condition1"><span data-toggle="tooltip" title="<?php echo $help_p_condition; ?>"><?php echo $entry_p_condition; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_condition" value="0" checked></label></label>
          <div class="col-sm-10">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary active">
                <input type="radio" name="g_condition" id="input-g_condition1" value="new" checked><?php echo $text_condition_new; ?>
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="g_condition" id="input-g_condition2" value="used"><?php echo $text_condition_used; ?>
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="g_condition" id="input-g_condition3" value="refurbished"><?php echo $text_condition_ref; ?>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_brand"><span data-toggle="tooltip" title="<?php echo $help_p_brand; ?>"><?php echo $entry_p_brand; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_brand" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_brand" value="" placeholder="<?php echo $entry_p_brand; ?>" id="input-g_brand" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="select-gpc"><span data-toggle="tooltip" title="<?php echo $help_p_google_category; ?><br><br><?php echo $entry_choose_google_category_xml; ?>"><?php echo $entry_p_google_category; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_google_categories" value="0" checked></label></label>
          <div class="col-sm-8">
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/gb.png" /></span><span class="input-group-addon"><img src="view/image/flags/in.png" /> <img src="view/image/flags/ch.png" /></span><input id="input-gpc" type="text" name="google_category_gb" placeholder="<?php echo $text_gpc_gb; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/us.png" /></span><span class="input-group-addon"><img src="view/image/flags/ca.png" /></span><input type="text" name="google_category_us" placeholder="<?php echo $text_gpc_us; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=en-US','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/au.png" /></span><input type="text" name="google_category_au" placeholder="<?php echo $text_gpc_au; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=en-AU','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/fr.png" /></span><span class="input-group-addon"><img src="view/image/flags/be.png" /> <img src="view/image/flags/ca.png" /> <img src="view/image/flags/ch.png" /></span><input type="text" name="google_category_fr" placeholder="<?php echo $text_gpc_fr; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=fr-FR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/de.png" /></span><span class="input-group-addon"><img src="view/image/flags/at.png" /> <img src="view/image/flags/ch.png" /></span><input type="text" name="google_category_de" placeholder="<?php echo $text_gpc_de; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=de-DE','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/it.png" /></span><span class="input-group-addon"><img src="view/image/flags/ch.png" /></span><input type="text" name="google_category_it" placeholder="<?php echo $text_gpc_it; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=it-IT','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/nl.png" /></span><span class="input-group-addon"><img src="view/image/flags/be.png" /></span><input type="text" name="google_category_nl" placeholder="<?php echo $text_gpc_nl; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=nl-NL','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/es.png" /></span><span class="input-group-addon"><img src="view/image/flags/mx.png" /></span><input type="text" name="google_category_es" placeholder="<?php echo $text_gpc_es; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=es-ES','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/br.png" /></span><input type="text" name="google_category_pt" placeholder="<?php echo $text_gpc_pt; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=pt-BR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/cz.png" /></span><input type="text" name="google_category_cz" placeholder="<?php echo $text_gpc_cz; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=cs-CZ','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/jp.png" /></span><input type="text" name="google_category_jp" placeholder="<?php echo $text_gpc_jp; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=ja-JP','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/dk.png" /></span><input type="text" name="google_category_dk" placeholder="<?php echo $text_gpc_da; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=da-DK','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/no.png" /></span><input type="text" name="google_category_no" placeholder="<?php echo $text_gpc_no; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=no-NO','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/pl.png" /></span><input type="text" name="google_category_pl" placeholder="<?php echo $text_gpc_pl; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=pl-PL','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/ru.png" /></span><input type="text" name="google_category_ru" placeholder="<?php echo $text_gpc_ru; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=ru-RU','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/se.png" /></span><input type="text" name="google_category_sv" value="" placeholder="<?php echo $text_gpc_sv; ?>" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=sv-SE','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div><br>
          <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/tr.png" /></span><input type="text" name="google_category_tr" placeholder="<?php echo $text_gpc_tr; ?>" value="" class="form-control" /><span class="input-group-addon"><a onclick="window.open('<?php echo $uksbhome; ?>taxonomy.php?lang=tr-TR','google');"><i data-toggle="tooltip" class="fa fa-plus-circle" style="cursor:pointer;" title="<?php echo $entry_choose_google_category; ?>"></i></a></span></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_multipack"><span data-toggle="tooltip" title="<?php echo $help_p_multipack; ?>"><?php echo $entry_p_multipack; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_multipack" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_multipack" value="" placeholder="<?php echo $entry_p_multipack; ?>" id="input-g_multipack" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_is_bundle1"><span data-toggle="tooltip" title="<?php echo $help_p_is_bundle; ?>"><?php echo $entry_p_is_bundle; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_is_bundle" value="0" checked></label></label>
          <div class="col-sm-10">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary">
                <input type="radio" name="g_is_bundle" id="input-g_is_bundle1" value="1"><?php echo $text_yes; ?>
              </label>
              <label class="btn btn-primary active">
                <input type="radio" name="g_is_bundle" id="input-g_is_bundle2" value="0" checked><?php echo $text_no; ?>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_adult1"><span data-toggle="tooltip" title="<?php echo $help_p_adult; ?>"><?php echo $entry_p_adult; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_adult" value="0" checked></label></label>
          <div class="col-sm-10">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary">
                <input type="radio" name="g_adult" id="input-g_adult1" value="1"><?php echo $text_yes; ?>
              </label>
              <label class="btn btn-primary active">
                <input type="radio" name="g_adult" id="input-g_adult2" value="0" checked><?php echo $text_no; ?>
              </label>
            </div>
          </div>
        </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="select-g_energy_efficiency_class"><span data-toggle="tooltip" title="<?php echo $help_p_energy_efficiency_class; ?>"><?php echo $entry_p_energy_efficiency_class; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_energy_efficiency_class" value="0" checked></label></label>
                <div class="col-sm-10">
                  <select name="g_energy_efficiency_class" id="select-g_energy_efficiency_class" class="form-control">
                      <option value="0" selected="selected"><?php echo $text_none; ?></option>
                      <option value="A+++">A+++</option>
                      <option value="A++">A++</option>
                      <option value="A+">A+</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                      <option value="G">G</option>
                  </select></div>
              </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_unit_pricing_measure"><span data-toggle="tooltip" title="<?php echo $help_p_unit_pricing_measure; ?>"><?php echo $entry_p_unit_pricing_measure; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_unit_pricing_measure" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_unit_pricing_measure" value="" placeholder="<?php echo $entry_p_unit_pricing_measure; ?>" id="input-g_unit_pricing_measure" class="form-control" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_unit_pricing_base_measure"><span data-toggle="tooltip" title="<?php echo $help_p_unit_pricing_base_measure; ?>"><?php echo $entry_p_unit_pricing_base_measure; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_unit_pricing_base_measure" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_unit_pricing_base_measure" value="" placeholder="<?php echo $entry_p_unit_pricing_base_measure; ?>" id="input-g_unit_pricing_base_measure" class="form-control" />
          </div>
          </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="select-g_gender"><?php echo $entry_p_gender; ?><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_gender" value="0" checked></label></label>
                <div class="col-sm-10">
                  <select name="g_gender" id="select-g_gender" class="form-control">
                      <option value="0" selected="selected"><?php echo $text_none; ?></option>
                      <option value="male"><?php echo $text_male; ?></option>
                      <option value="female"><?php echo $text_female; ?></option>
                      <option value="unisex"><?php echo $text_unisex; ?></option>
                  </select></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="select-g_age_group"><?php echo $entry_p_age_group; ?><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_age_group" value="0" checked></label></label>
                <div class="col-sm-10">
                  <select name="g_age_group" id="select-g_age_group" class="form-control">
                      <option value="0" selected="selected"><?php echo $text_none; ?></option>
                      <option value="newborn"><?php echo $text_newborn; ?></option>
                      <option value="infant"><?php echo $text_infant; ?></option>
                      <option value="toddler"><?php echo $text_toddler; ?></option>
                      <option value="kids"><?php echo $text_kids; ?></option>
                      <option value="adult"><?php echo $text_adult; ?></option>
                  </select></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="select-size_type"><span data-toggle="tooltip" title="<?php echo $help_p_size_type; ?>"><?php echo $entry_p_size_type; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_size_type" value="0" checked></label></label>
                <div class="col-sm-10">
                  <select name="g_size_type" id="select-g_size_type" class="form-control">
                      <option value="0" selected="selected"><?php echo $text_none; ?></option>
                      <option value="regular"><?php echo $text_regular; ?></option>
                      <option value="petite"><?php echo $text_petite; ?></option>
                      <option value="plus"><?php echo $text_plus; ?></option>
                      <option value="big and tall"><?php echo $text_big_and_tall; ?></option>
                      <option value="maternity"><?php echo $text_maternity; ?></option>
                  </select></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="select-size_system"><span data-toggle="tooltip" title="<?php echo $help_p_size_system; ?>"><?php echo $entry_p_size_system; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_size_system" value="0" checked></label></label>
                <div class="col-sm-10">
                  <select name="g_size_system" id="select-g_size_system" class="form-control">
                      <option value="0" selected="selected"><?php echo $text_none; ?></option>
                      <option value="US">US</option>
                      <option value="UK">UK</option>
                      <option value="EU">EU</option>
                      <option value="DE">DE</option>
                      <option value="FR">FR</option>
                      <option value="JP">JP</option>
                      <option value="CN (China)">CN (China)</option>
                      <option value="IT">IT</option>
                      <option value="BR">BR</option>
                      <option value="MEX">MEX</option>
                      <option value="AU">AU</option>
                  </select></div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10"><h2><?php echo $entry_variant_section; ?></h2><?php echo $help_variant_bulk; ?><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_variants" value="0" checked></label></div>
          </div>
                  <div class="table-responsive">
                    <table id="variants" class="table table-striped table-bordered table-hover">
                      <tbody>
                        <tr id="variant-row0">
                          <td class="col-sm-3 text-left">
                <label class="control-label" for="variant[0][g_size]"><?php echo $entry_p_size; ?></label><br>
                <input type="text" id="variant[0][g_size]" name="variant[0][g_size]" value="" placeholder="<?php echo $entry_p_size; ?>" class="form-control" /><br><br>
                <label class="control-label" for="variant[0][g_material]"><?php echo $entry_p_material; ?></label><br>
                <input type="text" id="variant[0][g_material]" name="variant[0][g_material]" value="" placeholder="<?php echo $entry_p_material; ?>" class="form-control" /></td>
                          <td class="col-sm-3 text-left">
                <label class="control-label" for="variant[0][g_colour]"><?php echo $entry_p_colour; ?></label><br>
                <input type="text" id="variant[0][g_colour]" name="variant[0][g_colour]" value="" placeholder="<?php echo $entry_p_colour; ?>" class="form-control" /><br><br>
                <label class="control-label" for="variant[0][g_pattern]"><?php echo $entry_p_pattern; ?></label><br>
                <input type="text" id="variant[0][g_pattern]" name="variant[0][g_pattern]" value="" placeholder="<?php echo $entry_p_pattern; ?>" class="form-control" /></td>
                          <td class="col-sm-3 text-left">
                <label class="control-label" for="variant[0][v_prices]"><?php echo $entry_v_prices; ?></label><br><br><?php echo $help_v_prices; ?><br><br>
                <input type="text" id="variant[0][v_prices]" name="variant[0][v_prices]" value="" placeholder="<?php echo $entry_v_prices; ?>" class="form-control" /></td>
                          <td class="col-sm-2 text-left"><a href="" id="thumb-image0" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="variant[0][v_images]" value="" id="v_images0" /></td>
                          <td class="text-left"><button type="button" onclick="$('#variant-row0').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4"></td>
                          <td class="col-sm-1 text-left"><button type="button" onclick="addVariant();" data-toggle="tooltip" title="<?php echo $button_add_variant; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
              <div class="form-group">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10"><h2><?php echo $entry_adwords_section; ?></h2></div>
          </div>
              <div class="form-group">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10"><?php echo $help_p_custom_label; ?></div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_custom_label_0"><?php echo $entry_p_custom_label_0; ?><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_custom_label_0" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_custom_label_0" value="" placeholder="<?php echo $entry_p_custom_label_0; ?>" id="input-g_custom_label_0" class="form-control" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_custom_label_1"><?php echo $entry_p_custom_label_1; ?><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_custom_label_1" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_custom_label_1" value="" placeholder="<?php echo $entry_p_custom_label_1; ?>" id="input-g_custom_label_1" class="form-control" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_custom_label_2"><?php echo $entry_p_custom_label_2; ?><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_custom_label_2" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_custom_label_2" value="" placeholder="<?php echo $entry_p_custom_label_2; ?>" id="input-g_custom_label_2" class="form-control" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_custom_label_3"><?php echo $entry_p_custom_label_3; ?><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_custom_label_3" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_custom_label_3" value="" placeholder="<?php echo $entry_p_custom_label_3; ?>" id="input-g_custom_label_3" class="form-control" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-g_custom_label_4"><?php echo $entry_p_custom_label_4; ?><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_custom_label_4" value="0" checked></label></label>
          <div class="col-sm-10">
            <input type="text" name="g_custom_label_4" value="" placeholder="<?php echo $entry_p_custom_label_4; ?>" id="input-g_custom_label_4" class="form-control" />
          </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-g_adwords_redirect"><span data-toggle="tooltip" title="<?php echo $help_p_adwords_redirect; ?>"><?php echo $entry_p_adwords_redirect; ?></span><br><label><?php echo $entry_ignore; ?><input type="checkbox" name="x_g_adwords_redirect" value="0" checked></label></label>
            <div class="col-sm-10">
              <input type="text" name="g_adwords_redirect" value="" placeholder="<?php echo $entry_p_adwords_redirect; ?>" id="input-g_adwords_redirect" class="form-control" /></div>
          </div>
          <div class="form-group" style="background:#E9E9E9;">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10"><h2><?php echo $entry_products_to_update; ?></h2><p><?php echo $help_products_to_update; ?></p></div>
          </div>
          <div class="form-group" style="background:#E9E9E9;">
            <label class="col-sm-2 control-label" for="input-manufacturers"><span data-toggle="tooltip" title="<?php echo $help_manufacturers; ?>"><?php echo $entry_manufacturers; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="manufacturers" value="" placeholder="<?php echo $entry_manufacturers; ?>" id="input-manufacturers" class="form-control" />
              <div id="product-manufacturers" class="well well-sm" style="height: 150px; overflow: auto;"></div>
            </div>
          </div>
          <div class="form-group" style="background:#E9E9E9;">
            <label class="col-sm-2 control-label" for="input-categories"><span data-toggle="tooltip" title="<?php echo $help_categories; ?>"><?php echo $entry_categories; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="categories" value="" placeholder="<?php echo $entry_categories; ?>" id="input-categories" class="form-control" />
              <div id="product-categories" class="well well-sm" style="height: 150px; overflow: auto;"></div>
            </div>
          </div>
          <div class="form-group" style="background:#E9E9E9;">
            <label class="col-sm-2 control-label" for="input-products"><span data-toggle="tooltip" title="<?php echo $help_products; ?>"><?php echo $entry_products; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="products" value="" placeholder="<?php echo $entry_products; ?>" id="input-products" class="form-control" />
              <div id="product-products" class="well well-sm" style="height: 150px; overflow: auto;"></div>
            </div>
          </div>
          <div class="form-group">
             <div class="col-sm-2">&nbsp;</div>
          <div class="col-sm-10 bu"><button type="button" data-toggle="tooltip" title="<?php echo $button_bulk_update; ?>" class="btn btn-primary bulksave"><?php echo $button_bulk_update; ?></button> <button type="button" data-toggle="tooltip" title="<?php echo $button_bulk_reset; ?>" class="btn btn-danger bulkreset"><?php echo $button_bulk_reset; ?></button></div>
          </div>      
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_info; ?></label>
            <div class="col-sm-10"><?php echo $help_google_help . '<br><br>' . $help_info; ?></div>
          </div>        
        </div>
      </div>        
    </form>


    <?php } ?>
    <?php } ?>
    <?php if($licensed=='none'){ ?>
    <?php echo $license_purchase_thanks; ?>
    <?php if(isset($regerror)){ echo $regerror_quote_msg; } ?>
    <?php if(isset($regerror)){ ?><p style="color:red;">error msg: <?php echo $regerror; ?></p><?php } ?>
    <h2><?php echo $license_registration; ?></h2>
    <form name="reg" method="post" action="<?php echo $home; ?>register.php" id="reg" class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="opencart_email"><?php echo $license_opencart_email; ?></label>
            <div class="col-sm-10">
          	  <input name="opencart_email" type="text" autofocus required id="opencart_email" form="reg" class="form-control"></div>
          </div>
	<?php if(isset($emailmal)&&$regerror=='emailmal'){ ?><p style="color:red;"><?php echo $check_email; ?></p><?php } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="order_id"><?php echo $license_opencart_orderid; ?></label>
            <div class="col-sm-10">
          	  <input name="order_id" type="text" autofocus required id="order_id" form="reg" class="form-control"></div>
          </div>
	<?php if(isset($regerror)&&$regerror=='orderid'){ ?><p style="color:red;"><?php echo $check_orderid; ?></p><?php } ?>
        <div class="form-group">
            <div class="col-sm-12">
          	  <button type="submit" form="reg" data-toggle="tooltip" title="<?php echo $license_registration; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button><input name="extension_id" type="hidden" id="extension_id" form="reg" value="19110"></div>
          </div>
    </form>
    <?php } ?>
    <?php if($licensed=='curl'){ ?>
    <?php echo $server_error_curl; ?>
    <?php } ?>
     
    </div>
  </div>
  </div>
</div>
<?php echo $footer; ?>

<?php if(md5($licensed)=='e9dc924f238fa6cc29465942875fe8f0'){ ?>
<?php if($state=='complete'){ ?>
<script type="text/javascript">
<!--
$(document).ready(function(){ 
<?php
$i = 0;
reset($feeds);
if($config_cron){
	reset($crons);
}
foreach (array_keys($feeds) as $key) {
?>
		
  $(".btn.active").removeClass("btn-primary").addClass("btn-success");
  $(document).on("click", function(){
    $(".btn").removeClass("btn-success").addClass("btn-primary");
    $(".btn.active").removeClass("btn-primary").addClass("btn-success");
  });

	$("textarea#feed_url_<?php echo $i; ?>").text('<?php echo $feeds[$key] . ($config_cron ? 'google_' . $config_language . '-' . $config_currency . '.xml' : '&language=' . $config_language . '&currency=' . $config_currency); ?>');
		
		<?php if($config_cron){ ?>$("textarea#cron_code_<?php echo $i; ?>").text('<?php echo $crons[$key] . '&language='.$config_language.'&currency='.$config_currency; ?>');
		<?php } ?>
<?php $i++; } ?>
			
	$("#split").change(function(){
		$("#split_help").fadeOut().fadeIn();
		if($( "#split" ).val() != '0'){
			$( "#input-cron2" ).trigger( "click" );
		};
	});

	$("#google_site").change(function(){
		var site;
		site = $("#google_site").val();
		var cron_lang_curr;
		var feed_lang_curr;
		
		switch (site) {
			case 'gb':
				cron_lang_curr = 'en-GBP';
				feed_lang_curr = '&language=en&currency=GBP';
				break;
			case 'us':
				cron_lang_curr = 'en-USD';
				feed_lang_curr = '&language=en&currency=USD';
				break;
			case 'ca':
				cron_lang_curr = 'en-CAD';
				feed_lang_curr = '&language=en&currency=CAD';
				break;
			case 'ca_fr':
				cron_lang_curr = 'fr-CAD';
				feed_lang_curr = '&language=fr&currency=CAD';
				break;
			case 'au':
				cron_lang_curr = 'en-AUD';
				feed_lang_curr = '&language=en&currency=AUD';
				break;
			case 'fr':
			case 'be_fr':
				cron_lang_curr = 'fr-EUR';
				feed_lang_curr = '&language=fr&currency=EUR';
				break;
			case 'de':
			case 'at':
				cron_lang_curr = 'de-EUR';
				feed_lang_curr = '&language=de&currency=EUR';
				break;
			case 'it':
				cron_lang_curr = 'it-EUR';
				feed_lang_curr = '&language=it&currency=EUR';
				break;
			case 'nl':
			case 'be_nl':
				cron_lang_curr = 'nl-EUR';
				feed_lang_curr = '&language=nl&currency=EUR';
				break;
			case 'es':
				cron_lang_curr = 'es-EUR';
				feed_lang_curr = '&language=es&currency=EUR';
				break;
			case 'dk':
				cron_lang_curr = 'da-DKK';
				feed_lang_curr = '&language=da&currency=DKK';
				break;
			case 'no':
				cron_lang_curr = 'no-NOK';
				feed_lang_curr = '&language=no&currency=NOK';
				break;
			case 'sv':
				cron_lang_curr = 'se-SEK';
				feed_lang_curr = '&language=se&currency=SEK';
				break;
			case 'pl':
				cron_lang_curr = 'pl-PLN';
				feed_lang_curr = '&language=pl&currency=PLN';
				break;
			case 'cz':
				cron_lang_curr = 'cz-CZK';
				feed_lang_curr = '&language=cz&currency=CZK';
				break;
			case 'ru':
				cron_lang_curr = 'ru-RUB';
				feed_lang_curr = '&language=ru&currency=RUB';
				break;
			case 'tr':
				cron_lang_curr = 'tr-TRY';
				feed_lang_curr = '&language=tr&currency=TRY';
				break;
			case 'in':
				cron_lang_curr = 'en-INR';
				feed_lang_curr = '&language=en&currency=INR';
				break;
			case 'ja':
				cron_lang_curr = 'ja-JPY';
				feed_lang_curr = '&language=ja&currency=JPY';
				break;
			case 'br':
				cron_lang_curr = 'pt-BRL';
				feed_lang_curr = '&language=pt&currency=BRL';
				break;
			case 'mx':
				cron_lang_curr = 'es-MXN';
				feed_lang_curr = '&language=es&currency=MXN';
				break;
			case 'ch':
				cron_lang_curr = 'en-CHF';
				feed_lang_curr = '&language=en&currency=CHF';
				break;
			case 'ch-fr':
				cron_lang_curr = 'fr-CHF';
				feed_lang_curr = '&language=fr&currency=CHF';
				break;
			case 'ch-de':
				cron_lang_curr = 'de-CHF';
				feed_lang_curr = '&language=de&currency=CHF';
				break;
			case 'ch-it':
				cron_lang_curr = 'it-CHF';
				feed_lang_curr = '&language=it&currency=CHF';
				break;
			case 'default':
			default:
				cron_lang_curr = '<?php echo $config_currency.'-'.$config_language; ?>';
				feed_lang_curr = '<?php echo '&language='.$config_language.'&currency='.$config_currency; ?>';
		}
		
			<?php $i = 0; reset($feeds); if($config_cron){reset($crons);}
    
			foreach (array_keys($feeds) as $key) {
			
				if($config_cron){ ?>
				$("textarea#feed_url_<?php echo $i; ?>").text('<?php echo $feeds[$key]; ?>' + 'google_' + cron_lang_curr + '.xml');
				$("textarea#cron_code_<?php echo $i; ?>").text('<?php echo $crons[$key]; ?>' + feed_lang_curr);
				<?php }else{ ?>
				$("textarea#feed_url_<?php echo $i; ?>").text('<?php echo $feeds[$key]; ?>' + feed_lang_curr);
				<?php } ?>
				
				
			<?php $i++; } ?>
		
	});

<?php if(isset($clearform)){
    echo '$("#form-uksb-google-merchant").hide();
    $(".gensave").hide();
    $("#form-bulk-update").show();';
} ?>
  $(".show_bulk").on("click", function(){
    $("#form-uksb-google-merchant").hide();
    $(".gensave").hide();
    $("#form-bulk-update").show();
  });
  $(".show_general2").on("click", function(){
    $("#form-bulk-update").hide();
    $("#form-uksb-google-merchant").show();
    $(".gensave").show();
    $(".general2").trigger("click");
  });
  $(".show_general3").on("click", function(){
    $("#form-bulk-update").hide();
    $("#form-uksb-google-merchant").show();
    $(".gensave").show();
    $(".general3").trigger("click");
  });
  $(".show_general4").on("click", function(){
    $("#form-bulk-update").hide();
    $("#form-uksb-google-merchant").show();
    $(".gensave").show();
    $(".general4").trigger("click");
  });
});

$('input[name=\'manufacturers\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['manufacturer_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'manufacturers\']').val('');

    $('#product-manufacturers' + item['value']).remove();

    $('#product-manufacturers').append('<div id="product-manufacturers' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_manufacturers[]" value="' + item['value'] + '" /></div>');
  }
});

$('#product-manufacturers').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

$('input[name=\'categories\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
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
    $('input[name=\'categories\']').val('');

    $('#product-categories' + item['value']).remove();

    $('#product-categories').append('<div id="product-categories' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_categories[]" value="' + item['value'] + '" /></div>');
  }
});

$('#product-categories').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

$('input[name=\'products\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'products\']').val('');

    $('#product-products' + item['value']).remove();

    $('#product-products').append('<div id="product-products' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_products[]" value="' + item['value'] + '" /></div>');
  }
});

$('#product-products').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

var variant_row = 1;

function addVariant() {
  html  = '  <tr id="variant-row' + variant_row + '">';
  html += '    <td class="col-sm-3 text-left">';
  html += '    <label class="control-label" for="variant[' + variant_row + '][g_size]"><?php echo $entry_p_size; ?></label><br>';
  html += '    <input type="text" name="variant[' + variant_row + '][g_size]" value="" placeholder="<?php echo $entry_p_size; ?>" class="form-control" /><br><br>';
  html += '    <label class="control-label" for="variant[' + variant_row + '][g_material]"><?php echo $entry_p_material; ?></label><br>';
  html += '    <input type="text" name="variant[' + variant_row + '][g_material]" value="" placeholder="<?php echo $entry_p_material; ?>" class="form-control" /></td>';
  html += '    <td class="col-sm-3 text-left">';
  html += '    <label class="control-label" for="variant[' + variant_row + '][g_colour]"><?php echo $entry_p_colour; ?></label><br>';
  html += '    <input type="text" name="variant[' + variant_row + '][g_colour]" value="" placeholder="<?php echo $entry_p_colour; ?>" class="form-control" /><br><br>';
  html += '    <label class="control-label" for="variant[' + variant_row + '][g_pattern]"><?php echo $entry_p_pattern; ?></label><br>';
  html += '    <input type="text" name="variant[' + variant_row + '][g_pattern]" value="" placeholder="<?php echo $entry_p_pattern; ?>" class="form-control" /></td>';
  html += '    <td class="col-sm-3 text-left">';
  html += '    <label class="control-label" for="variant[' + variant_row + '][v_prices]"><?php echo $entry_v_prices; ?></label><br><br><?php echo $help_v_prices; ?><br><br>';
  html += '    <input type="text" name="variant[' + variant_row + '][v_prices]" value="" placeholder="<?php echo $entry_v_prices; ?>" class="form-control" /></td>';
  html += '    <td class="col-sm-2 text-left"><a href="" id="thumb-image' + variant_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="variant[' + variant_row + '][v_images]" value="" id="v_images' + variant_row + '" /></td>';
  html += '    <td class="col-sm-1 text-left"><button type="button" onclick="$(\'#variant-row' + variant_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '  </tr>';
  
  $('#variants tbody').append(html);
  
  variant_row++;
}

$('.expiry-date').datetimepicker({
  pickTime: false
});

$( ".gensave" ).on( "click", function() {
  $( "#form-uksb-google-merchant" ).submit();
});

$( ".bulksave" ).on( "click", function() {
      $(".alert").remove();
      $.ajax({
        url: 'index.php?route=feed/uksb_google_merchant/bulk_update&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        data: new FormData($('#form-bulk-update')[0]),
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $('.bulksave').button('loading');
        },
        complete: function() {
          $('.bulksave').button('reset');
        },
        success: function(json) {
          if (json['error']) {
            $('.bu').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>')
          }
          else if(json['updated']){
            $('.bu').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['updated'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>')
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
});

$( ".bulkreset" ).on( "click", function() {
  location.href = 'index.php?route=feed/uksb_google_merchant&clear=1&token=<?php echo $token; ?>';
});
//-->
</script>
<?php } ?>
<?php } ?>