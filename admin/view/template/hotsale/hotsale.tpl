<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a  class="btn btn-primary editdata"><i class="fa fa-plus"></i></a>
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
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i>Category List</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-download">
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
                      <a data-id="<?php echo $hot['id'] ?>" data-sort="<?php echo $hot['sort_order'] ?>" data-name="<?php echo $hot['name']; ?>" data-home="<?php echo $hot['home'] ?>"  class="editdata btn btn-primary"><i class="fa fa-pencil"></i></a>
                      <a data-cid="<?php echo $hot['id'] ?>"  class="delete btn btn-danger"><i class="fa fa-remove"></i></a>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="6">No Hot Sale Category</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
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
        $('.editdata').on('click',function(){
            var name = $(this).data('name');
            var id = $(this).data('id');
            var sort_order = $(this).data('sort');
            var home = $(this).data('home')||1;
            $("#category_name").val(name);
            $("#id").val(id);
            $('#sort_order').val(sort_order);
            $("#home").val(home);
            $("#modals").modal('show');
        });

        $('#savechanges').on('click',function(){
            var name =  $("#category_name").val();
            var id = $('#id').val();
            var sort = $('#sort_order').val();
            var home = $("#home").val();
            if(name == ""){
                alert("category name can't be empty!");
                return false;
            }
            $.post("index.php?route=hotsale/index/cadd&token=<?php echo $token ?>",{id:id,name:name,sort_order:sort,home:home},function(res){
                if(res){
                    alert("success");
                    location.reload();
                }
            },'json');
        });

        $('.delete').on('click',function(){
            var cid = $(this).data('cid');
            $.get('index.php?route=hotsale/index/cdelt&token=<?php echo $_GET["token"] ?>',{cid:cid},function(res){
                if(res){
                    alert("success");
                    location.reload();
                }
            },'json');
        });

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
                <input type="hidden" class="form-control" id="id">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" placeholder="Category Name">
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