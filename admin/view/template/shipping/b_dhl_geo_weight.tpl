<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>      
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      
    
<div class="panel-body">  
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
          <div class="row">
            <div class="col-sm-2">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <li><a href="#tab-geo-zone<?php echo $geo_zone['geo_zone_id']; ?>" data-toggle="tab"><?php echo $geo_zone['name']; ?></a></li>
                <?php } ?>
              </ul>
            </div>
            
            
  <div class="col-sm-10">
              <div class="tab-content">
                <div class="tab-pane active" id="tab-general">
                                
                  
<!--<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>-->
<style type="text/css">
.form-horizontal .control-label {
/**/ text-align: left; 
margin-bottom: 0;
padding-top: 9px;
width: 200px;
}
</style>
          
          
          <div class="form-group">
           <?php /*?> <?php echo $entry_shipdisplay; ?><?php */?>
            
            <div class="col-sm-10">
			<span id="my1">		
			<?php if ($b_dhl_geo_weight_shipdisplayoption =='1') { ?>
                <?php echo $icon_shipping_1; ?>
                <?php } else if ($b_dhl_geo_weight_shipdisplayoption =='2') { ?>
                <?php echo $icon_shipping_2; ?>
                <?php } else { ?>
                <?php echo $icon_shipping_3; ?>
                <?php } ?>
            </span>
            </div>
          </div>
            
          
          
          
            <div class="form-group">
             <label class="col-sm-2 control-label"><span><?php echo $entry_shipdisplayoption; ?></span></label>
            <div class="col-sm-10">
            <select name="b_dhl_geo_weight_shipdisplayoption" id="my2">
                <?php if ($b_dhl_geo_weight_shipdisplayoption =='1') { ?>
                <option value="1" selected="selected"><?php echo $entry_logo_only; ?></option>
                <option value="2"><?php echo $entry_text_only; ?></option>
                <option value="3"><?php echo $entry_logoandtext; ?></option>
                <?php } else if ($b_dhl_geo_weight_shipdisplayoption =='2') { ?>
                <option value="1"><?php echo $entry_logo_only; ?></option>
                <option value="2" selected="selected"><?php echo $entry_text_only; ?></option>
                <option value="3"><?php echo $entry_logoandtext; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $entry_logo_only; ?></option>
                <option value="2"><?php echo $entry_text_only; ?></option>
                <option value="3" selected="selected"><?php echo $entry_logoandtext; ?></option>
                <?php } ?>
              </select>
              </div>
             </div> 
         
          
            <div class="form-group">
              <label class="col-sm-2 control-label"><span><?php echo $entry_tax_class; ?></span></label>
              <div class="col-sm-10">
              <select name="b_dhl_geo_weight_tax_class_id">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                  <?php if ($tax_class['tax_class_id'] == $b_dhl_geo_weight_tax_class_id) { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
            </div>
           </div>    
            
            <div class="form-group">
              <label class="col-sm-2 control-label"><span><?php echo $entry_status; ?></span></label>
              <div class="col-sm-10">
              <select name="b_dhl_geo_weight_status">
                  <?php if ($b_dhl_geo_weight_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
             </select>
            </div>
           </div> 
           
           
          <div class="form-group">
              <label class="col-sm-2 control-label"><span><?php echo $entry_sort_order; ?></span></label>
              <div class="col-sm-10">
             <input type="text" name="b_dhl_geo_weight_sort_order" value="<?php echo $b_dhl_geo_weight_sort_order; ?>" size="5" />
           </div>
          </div>
      </div>     
           
      
        
        
        <?php foreach ($geo_zones as $geo_zone) { ?>
          <div class="tab-pane" id="tab-geo-zone<?php echo $geo_zone['geo_zone_id']; ?>">
          
            <div class="form-group">
       <label class="col-sm-2 control-label" for="input-rate<?php echo $geo_zone['geo_zone_id']; ?>">
       <span><?php echo $entry_min_weight; ?></span></label>
            	<div class="col-sm-10">
            <input type="text" name="b_dhl_geo_weight_<?php echo $geo_zone['geo_zone_id']; ?>_min" value="<?php echo ${'b_dhl_geo_weight_' . $geo_zone['geo_zone_id'] . '_min'}; ?>" size="5" /></td>
          	 	</div>
            </div>    
            
            
          <div class="form-group">
            <label class="col-sm-2 control-label"><span><?php echo $entry_max_weight; ?></span></label>
              <div class="col-sm-10">
            <input type="text" name="b_dhl_geo_weight_<?php echo $geo_zone['geo_zone_id']; ?>_max" value="<?php echo ${'b_dhl_geo_weight_' . $geo_zone['geo_zone_id'] . '_max'}; ?>" size="5" />
              </div>
          </div>
          
          
            <div class="form-group">
              <label class="col-sm-2 control-label"><span><?php echo $entry_hand; ?></span></label>
               <div class="col-sm-10">
             <input type="text" name="b_dhl_geo_weight_<?php echo $geo_zone['geo_zone_id']; ?>_hand" value="<?php echo ${'b_dhl_geo_weight_' . $geo_zone['geo_zone_id'] . '_hand'}; ?>" size="5" />
              <?php echo "&nbsp;%"; ?>
               </div>
            </div>
            
          
            <div class="form-group">
              <label class="col-sm-2 control-label"><span><?php echo $entry_rate; ?></span></label>
              <div class="col-sm-10">
              <textarea name="b_dhl_geo_weight_<?php echo $geo_zone['geo_zone_id']; ?>_rate" cols="40" rows="5"><?php echo ${'b_dhl_geo_weight_' . $geo_zone['geo_zone_id'] . '_rate'}; ?></textarea>
             </div>
           </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label"><span><?php echo $entry_status; ?></span></label>
               <div class="col-sm-10">
              <select name="b_dhl_geo_weight_<?php echo $geo_zone['geo_zone_id']; ?>_status">
                  <?php if (${'b_dhl_geo_weight_' . $geo_zone['geo_zone_id'] . '_status'}) { ?>
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
                <?php } ?>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php echo $footer; ?> 