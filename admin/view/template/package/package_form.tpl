<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-attribute" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-attribute" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
            <div class="col-sm-5">
                <input class="form-control" type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>" placeholder="<?php echo $entry_name; ?>" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-attribute-group"><?php echo $entry_attribute_group; ?></label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description" rows="3"><?php echo isset($description)?$description : "" ?></textarea>
            </div>
          </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-attribute-group">main product introduction</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="main_product" rows="3"><?php echo isset($main_product)?$main_product : "" ?></textarea>
                </div>
            </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-attribute-group">Detail</label>
            <div class="col-sm-10">
                <input type="text" name="related" value="" placeholder="Search for prodcuts" id="input-related" class="form-control" />
                <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php if(!empty($detail)) { ?>
                        <?php foreach ($detail['product_id'] as $k=>$d) { ?>
                        <div id="product-related<?php echo $d; ?>"><i class="fa fa-minus-circle"></i> <?php echo $detail['product_name'][$k]; ?>
                            <input type="hidden" name="detail[product_name][]" value="<?php echo $detail['product_name'][$k]; ?>" />
                            <input type="hidden" name="detail[product_id][]" value="<?php echo $d; ?>" />&nbsp;
                            <input type="text" class="form-inline" style="width:40px;text-align: center" name="detail[product_nub][]" value="<?php echo isset($detail['product_nub'][$k])?$detail['product_nub'][$k]:0 ; ?>" />
                        </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
          </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Link Config Categroy</label>
            <div class="col-sm-10">
                <input type="text" name="configCategory" value="" placeholder="Link Congfig Category"  class="form-control" />
                <div id="product-config" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php if(!empty($configCategory)) { ?>
                        <div id="product-related<?php echo $configCategory['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $configCategory['name']; ?>
                            <input type="hidden" name="config_category" value="<?php echo $configCategory['category_id']; ?>" />
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

    // Related
    $('input[name=\'related\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=package/package/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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

            $('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i>' + item['label'] + '<input type="hidden" name="detail[product_id][]" value="' + item['value'] + '" /><input type="hidden" name="detail[product_name][]" value="' + item['label'] + '" />&nbsp;<input type="text" class="form-inline" style="width:40px;text-align: center" name="detail[product_nub][]" value="1" /></div>');
        }
    });

    $('#product-related').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });


    $('input[name=\'configCategory\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=package/package/getconfigcatalog&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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
            $('input[name=\'configCategory\']').val('');

            $('#product-config').empty().append('<div id="config-related' + item['value'] + '"><i class="fa fa-minus-circle"></i>' + item['label'] + '<input type="hidden" name="config_category" value="' + item['value'] + '" /></div>');
        }
    });

    $('#product-config').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });

</script>
<?php echo $footer; ?>