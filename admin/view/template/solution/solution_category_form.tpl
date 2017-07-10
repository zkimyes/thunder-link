<?php echo $header; ?>
<script type="text/javascript" src="view/javascript/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="view/javascript/ueditor/ueditor.all.js"></script>
<?php echo $column_left; ?>
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
          </ul>
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
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
                      <input type="text" name="solution_title" value="<?php echo isset($solution_title) ? $solution_title : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="description" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>"><?php echo isset($description) ? $description : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="meta_title" value="<?php echo isset($meta_title) ? $meta_title : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="meta_description" rows="5" cols="" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($meta_description) ? $meta_description : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                    <div class="col-sm-10">
                      <input name="meta_keyword" class="form-control" placeholder="meta_keyword" value="<?php echo isset($meta_keyword) ? $meta_keyword : ''; ?>">
                    </div>
                  </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Seo Keyword</label>
                        <div class="col-sm-10">
                            <input name="seo_keyword" class="form-control" placeholder="Seo Keyword" value="<?php echo isset($seo_keyword) ? $seo_keyword : ''; ?>">
                        </div>
                    </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane fade" id="tab-data">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">sort order</label>
                <div class="col-sm-10">
                  <input type="text" name="order" value="<?php echo isset($order) ? $order:0 ; ?>" placeholder="sort order" id="input-sort-order" class="form-control" />
                </div>
              </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-related">Related Solution</label>
                    <div class="col-sm-10">
                        <input type="text" name="related" value="" placeholder="Related Solution" class="form-control" />
                        <div id="relatiedSolution" class="well well-sm" style="height: 150px; overflow: auto;">
                            <?php foreach ($related_product_id as $product) { ?>
                            <div id="product-related<?php echo $product_related['solution_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['solution_title']; ?>
                                <input type="hidden" name="related_product_id[]" value="<?php echo $product['solution_id']; ?>" />
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
          UE.getEditor("input-description<?php echo $language['language_id']; ?>");
<?php } ?>
//--></script>
  <script type="text/javascript"><!--

      // Related
      $('input[name=\'related\']').autocomplete({
          'source': function(request, response) {
              $.ajax({
                  url: 'index.php?route=solution/solution/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                  dataType: 'json',
                  success: function(json) {
                      response($.map(json, function(item) {
                          return {
                              label: item['name'],
                              value: item['solution_id']
                          }
                      }));
                  }
              });
          },
          'select': function(item) {
              $('input[name=\'related\']').val('');

              $('#relatiedSolution' + item['value']).remove();

              $('#relatiedSolution').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="related_product_id[]" value="' + item['value'] + '" /></div>');
          }
      });
//--></script>
  <script type="text/javascript"><!--
      $('#relatiedSolution').delegate('.fa-minus-circle', 'click', function() {
          $(this).parent().remove();
      });
//--></script>
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?>