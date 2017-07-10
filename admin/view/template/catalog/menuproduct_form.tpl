<?php echo $header; ?>
<script type="text/javascript" src="view/javascript/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="view/javascript/ueditor/ueditor.all.js"></script>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i>Edit Menu Product</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <input type="text" value="" placeholder="Category" id="input-category" class="form-control" />
                    <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
                        <?php if(!empty($category)) { ?>
                            <div id="product-category<?php echo $category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                                <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>" />
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Product</label>
                <div class="col-sm-10">
                     <textarea name="product" id="input-description1" style="width:99%;"><?php echo $product ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" id="input-description" style="width:99%;"><?php echo $description ?></textarea>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
      UE.getEditor("input-description1");
      UE.getEditor("input-description");
      // Category
      $('#input-category').autocomplete({
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


              $('#product-category').empty().append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_id" value="' + item['value'] + '" /></div>');
          }
      });
      $('#product-category').delegate('.fa-minus-circle', 'click', function() {
          $(this).parent().remove();
      });

      // Related
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
              $('#product-related').empty().append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id" value="' + item['value'] + '" /></div>');
          }
      });

      $('#product-related').delegate('.fa-minus-circle', 'click', function() {
          $(this).parent().remove();
      });

//--></script>
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
      $('select[name=categroy]').val("<?php echo $categroy ?>");
//--></script></div>
<?php echo $footer; ?>