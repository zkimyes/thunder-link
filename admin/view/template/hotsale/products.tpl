<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a  class="btn btn-primary adddata"><i class="fa fa-plus"></i></a>
      </div>
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
        <h3 class="panel-title"><i class="fa fa-list"></i>Products List</h3>
      </div>
      <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-left">name</td>
                  <td class="text-right">sort order</td>
                  <td class="text-right">actions</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($hotsale) { ?>
                <?php foreach ($hotsale as $hot) { ?>
                <tr>
                  <td class="text-left"><?php echo $hot['name']; ?></td>
                  <td class="text-right"><?php echo $hot['sort_order']; ?></td>
                  <td class="text-right">
                      <a data-product_id="<?php echo $hot['product_id'] ?>" data-hotsale_category="<?php echo $hot['hotsale_category'] ?>" data-sort_order="<?php echo $hot['sort_order'] ?>" data-name="<?php echo $hot['name']; ?>" data-description="<?php echo $hot['description'] ?>" data-home="<?php echo $hot['home'] ?>"  class="editdata btn btn-primary"><i class="fa fa-pencil"></i></a>
                      <a data-product_id="<?php echo $hot['product_id'] ?>"  class="delete btn btn-danger"><i class="fa fa-remove"></i></a>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="6">No Hot Sale Products</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript">
    $(function(){

        $('.adddata').on('click',function(){
            $("#modals").modal('show');
        });


        $('.editdata').on('click',function(){
            var name = $(this).data('name');
            var description = $(this).data('description');
            var product_id = $(this).data('product_id');
            var hotsale_category = $(this).data('hotsale_category');
            var sort_order = $(this).data('sort_order');
            var home = $(this).data('home');
            $("#category_name").val(name);
            $("#product-related").empty().html('<div id="product-related' + product_id + '"><i class="fa fa-minus-circle"></i> ' + name + '<input type="hidden" name="product_id" value="' + product_id + '" /></div>');
            $("#hotsale_category").val(hotsale_category);
            $('#sort_order').val(sort_order);
            $("#product_description").val(description);
            $("#home").val(home);
            $("#modals").modal('show');
        });

        $('#savechanges').on('click',function(){
            var hotsale_category =  $("#hotsale_category").val();
            var product_id = $('input[name=product_id]').val();
            var description = $("#product_description").val();
            var sort = $('#sort_order').val();
            var home = $("#home").val();
            if(hotsale_category == ""){
                alert("category can't be empty!");
                return false;
            }

            if(typeof product_id == "undefined"){
                alert("product can't be empty!");
                return false;
            }

            if(description == ""){
                alert("description can't be empty!");
                return false;
            }
            var data = {};
            data.product_id = product_id;
            data.hotsale_category = hotsale_category;
            data.description = description;
            data.sort_order = sort;
            data.home = home;

            $.post("index.php?route=hotsale/index/padd&token=<?php echo $token ?>",data,function(res){
                if(res){
                    alert("success");
                    location.reload();
                }
            },'json');
        });

        $('.delete').on('click',function(){
            var product_id = $(this).data('product_id');
            $.get('index.php?route=hotsale/index/pdelt&token=<?php echo $_GET["token"] ?>',{product_id:product_id},function(res){
                if(res){
                    alert("success");
                    location.reload();
                }
            },'json');
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

                $('#product-related').empty().append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id" value="' + item['value'] + '" /></div>');
            }
        });
        $('#product-related').on("click",'.fa',function(){
            var product_id = $(this).next('input').val();
            $(this).parent().remove();
            $.get('index.php?route=hotsale/index/pdelt&token=<?php echo $_GET["token"] ?>',{product_id:product_id},'json');
        })
    })
</script>

<div class="modal" id="modals">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="category_name">Category</label>
                    <select name="hotsale_category" id="hotsale_category" class="form-control">
                        <?php if(isset($categorys)){ foreach($categorys as $category){  ?>
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                       <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_name">Product</label>
                    <input type="text" name="related" value="" placeholder="Products" id="input-related" class="form-control" />
                    <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_name">Description</label>
                    <textarea name="description" id="product_description"  class="form-control" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="category_name">Sort Order</label>
                    <input type="text" class="form-control" id="sort_order" autocomplete="off" placeholder="Sort Order">
                </div>
                <div class="form-group">
                    <label for="category_name">Show Home</label>
                    <select class="form-control" id="home">
                        <option value="0">None</option>
                        <option value="1">Show Home</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="savechanges" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>