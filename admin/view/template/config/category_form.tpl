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
            <li><a href="#tab-items" data-toggle="tab">Data</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
              <div class="tab-content">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="description" rows="5" placeholder="<?php echo $entry_description; ?>" class="form-control"><?php echo isset($description) ? $description : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-description">操作说明 </label>
                      <div class="col-sm-10">
                          <textarea name="main_intro" rows="5" placeholder="main product introduction" class="form-control"><?php echo isset($main_intro) ? $main_intro : ''; ?></textarea>
                      </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title"><?php echo $entry_meta_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="meta_title" value="<?php echo isset($meta_title) ? $meta_title : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description"><?php echo $entry_meta_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="meta_description" rows="5" placeholder="<?php echo $entry_meta_description; ?>" class="form-control"><?php echo isset($meta_description) ? $meta_description : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword"><?php echo $entry_meta_keyword; ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="meta_keyword" placeholder="<?php echo $entry_meta_keyword; ?>"  value="<?php echo isset($meta_keyword) ? $meta_keyword : ''; ?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-meta-keyword">Seo Keyword</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="seo_keyword" placeholder="Seo Keyword"  value="<?php echo isset($seo_keyword) ? $seo_keyword : ''; ?>"/>
                      </div>
                  </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status">show </label>
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

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                        <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                            <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-meta-title">Sort Order</label>
                        <div class="col-sm-10">
                            <input type="text" name="sort_order" value="<?php echo isset($sort_order) ? $sort_order : ''; ?>" placeholder="Sort Order" id="input-meta-title" class="form-control" />
                        </div>
                    </div>
              </div>
            </div>
            <div class="tab-pane in" id="tab-items">
                <div class="tab-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Apply to system:</label>
                        <div class="col-sm-10">
                            <div class="items">
                                <input type="text" value=""  placeholder="Apply to system" class="applytosystem form-control" />
                                <div class="well well-sm product_borad" id="applytosystem_content" style="height: 150px; overflow: auto;">
                                    <?php if(!empty($item)) { ?>
                                        <div><i class="fa fa-minus-circle"></i> <?php echo $item['name']; ?>
                                            <input type="hidden" name="applytosystem" value="<?php echo $item['filter_id']; ?>" />
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Board Function:</label>
                        <div class="col-sm-10">
                            <div class="items">
                                <input type="text" value=""  placeholder="Apply to system" class="boardfunction form-control" />
                                <div class="well well-sm product_borad" id="boardfunction_content" style="height: 150px; overflow: auto;">
                                    <?php if(!empty($board)) { ?>
                                        <?php foreach ($board as $product) { ?>
                                            <div id="product-related<?php echo $product['filter_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                                                <input type="hidden" name="boardfunction[]" value="<?php echo $product['filter_id']; ?>" />
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Link Category</label>
                        <div class="col-sm-10">
                            <input type="text" name="category" value="" placeholder="Link Category" id="input-category" class="form-control" />
                            <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php if(isset($link_category)) { ?>
                                    <div id="product-category<?php echo $link_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $link_category['name']; ?>
                                        <input type="hidden" name="link_category" value="<?php echo $link_category['category_id']; ?>" />
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Link Product</label>
                        <div class="col-sm-3">
                            <div class="linkproduct">
                                <input type="text" name="related"  value="" placeholder="Related product" class="form-control relatiproduct" />
                                <div class="well well-sm related" style="height: 150px; overflow: auto;">
                                    <?php if(!empty($link_products)) { ?>
                                        <?php foreach($link_products as $product){ ?>
                                            <div id="product-related<?php echo $product['product_id']?>"><i class="fa fa-minus-circle"></i><?php echo $product['name']; ?><input type="hidden" name="link_product_id[]" value="<?php echo $product['product_id']; ?>" /></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="关联的banner">Banner</span></label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <select name="banner" id="input-banner" class="form-control">
                                    <?php foreach ($banners as $b) { ?>
                                    <?php if ($b['banner_id'] == $banner) { ?>
                                    <option value="<?php echo $b['banner_id']; ?>" selected="selected"><?php echo $b['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $b['banner_id']; ?>"><?php echo $b['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
      // Related
      $('.applytosystem').autocomplete({
          'source': function(request, response) {
              $.ajax({
                  url: 'index.php?route=config/category/applytosystem&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                  dataType: 'json',
                  success: function(json) {
                      response($.map(json, function(item) {
                          return {
                              label: item['name'],
                              value: item['item_id']
                          }
                      }));
                  }
              });
          },
          'select': function(item) {
              $(this).val('');
              $("#applytosystem_content").empty().append('<div><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="applytosystem" value="' + item['value'] + '" /></div>');
          }
      });

      $('.boardfunction').autocomplete({
          'source': function(request, response) {
              $.ajax({
                  url: 'index.php?route=config/category/boardfunction&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                  dataType: 'json',
                  success: function(json) {
                      response($.map(json, function(item) {
                          return {
                              label: item['name'],
                              value: item['item_id']
                          }
                      }));
                  }
              });
          },
          'select': function(item) {
              $(this).val('');
              $("#function_"+item['value']).remove();
              $("#boardfunction_content").append('<div id="function_'+item['value']+'"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="boardfunction[]" value="' + item['value'] + '" /></div>');
          }
      });


      $('input[name=\'related\']').autocomplete({
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
              $('input[name=\'related\']').val('');

              $('#product-related' + item['value']).remove();

              $('.related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="link_product_id[]" value="' + item['value'] + '" /></div>');
          }
      });

      $('.linkproduct').delegate('.fa-minus-circle', 'click', function() {
          $(this).parent().remove();
      });

      $('.product_borad').delegate('.fa-minus-circle', 'click', function() {
          $(this).parent().remove();
      });

      $(".items_check").click(function(){
          if($(this).prop('checked') == true){
              $(this).parents().next('.relatiproduct').removeAttr('disabled');
          }else{
              $(this).parents().next('.relatiproduct').attr('disabled',true);
              $(this).parents().next().next().next('.product_borad').empty();
          }
      });


      // Category
      $('input[name=\'category\']').autocomplete({
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
              $('input[name=\'category\']').val('');

              $('#product-category').empty().append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="link_category" value="' + item['value'] + '" /></div>');
          }
      });

      $('#product-category').delegate('.fa-minus-circle', 'click', function() {
          $(this).parent().remove();
      });
  </script>
</div>
<?php echo $footer; ?>