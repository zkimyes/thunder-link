<?php echo $header; ?>
<script type="text/javascript" src="view/javascript/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="view/javascript/ueditor/ueditor.all.js"></script>
<?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
            <div class="form-group">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-6">
                    <select name="category_id" class="form-control">
                        <?php foreach($categories as $category){ ?>
                            <?php if($category['category_id'] == $category_id){ ?>
                            <option selected="selected" value="<?php echo $category['category_id'] ?>"><?php echo $category['name'] ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $category['category_id'] ?>"><?php echo $category['name'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" value="<?php echo $name ?>" placeholder="plan name" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" placeholder="Description" id="description_d" rows="6"><?php echo $description ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Quote Description</label>
                <div class="col-sm-10">
                    <textarea name="quote_description" placeholder="Quote Description" id="description_c" rows="6"><?php echo $quote_description ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sort Order</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="sort_order" value="<?php echo $sort_order; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Link Product</label>
                <div class="col-sm-3">
                    <div class="items">
                        <input type="text" name="related"  value="" placeholder="Related product" class="form-control relatiproduct" />
                        <div class="well well-sm related" style="height: 150px; overflow: auto;">
                            <?php if(!empty($link_products)) { ?>
                                <div><i class="fa fa-minus-circle"></i><?php echo $link_products['name']; ?><input type="hidden" name="link_product_id" value="<?php echo $link_products['product_id']; ?>" /></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
      UE.getEditor("description_d");
      UE.getEditor("description_c");
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
              $('.related').empty().append('<div><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="link_product_id" value="' + item['value'] + '" /></div>');
          }
      });

      $('.related').delegate('.fa-minus-circle', 'click', function() {
          $(this).parent().remove();
      });
//--></script>
</div>
<?php echo $footer; ?>