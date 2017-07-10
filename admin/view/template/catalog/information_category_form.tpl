<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" onclick="$('form').submit()" form="form-category" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel ?>" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a></div>
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
        <h3 class="panel-title"><i class="fa fa-list"></i>Edit Category</h3>
      </div>
      <div class="panel-body">
          <form action="<?php echo $action ?>" method="post" class="form-horizontal">
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-5">
                      <input type="text" name="name" class="form-control" value="<?php echo isset($categroy['name'])? $categroy['name'] : "" ?>"  placeholder="Name">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">装饰图片</label>
                  <div class="col-sm-10">
                      <a href="javascript:;" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="" /></a>
                      <input type="hidden" name="banner" value="<?php echo $banner ?>" id="input-image" />
                  </div>
              </div>


              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                      <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Description"><?php echo isset($categroy['description'])?$categroy['description']:"" ?></textarea>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Meta Title</label>
                  <div class="col-sm-10">
                      <input type="text" name="meta_title" class="form-control" value="<?php echo isset($categroy['meta_title'])?$categroy['meta_title']:'' ?>"  placeholder="Meta Title">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Meta Keyword</label>
                  <div class="col-sm-10">
                      <input type="text" name="meta_keyword" class="form-control" value="<?php echo isset($categroy['meta_keyword'])?$categroy['meta_keyword']:'' ?>"  placeholder="Meta Keyword">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Seo Keyword</label>
                  <div class="col-sm-10">
                      <input type="text" name="seo_keyword" class="form-control" value="<?php echo isset($seo_keyword)?$seo_keyword:'' ?>"  placeholder="Seo Keyword">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Meta Description</label>
                  <div class="col-sm-10">
                      <textarea name="meta_description" class="form-control" cols="30" rows="10" placeholder="Meta Description"><?php echo isset($categroy['meta_description'])?$categroy['meta_description']:'' ?></textarea>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
                  <div class="col-sm-5">
                      <select name="type" class="form-control">
                          <option value="1">aboutus</option>
                          <option value="2">support</option>
                      </select>
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Sort_Order</label>
                  <div class="col-sm-5">
                      <input name="sort_order" value="<?php echo isset($categroy['sort_order'])? $categroy['sort_order'] : 0 ?>" class="form-control" placeholder="Sort_Order" type="text"/>
                  </div>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript">
    $(function(){
        type = '<?php echo isset($categroy["type"])?$categroy["type"]:0 ?>'=="0"?1:'<?php echo $categroy["type"] ?>';
        $('select[name=type]').val(type);
    })
</script>