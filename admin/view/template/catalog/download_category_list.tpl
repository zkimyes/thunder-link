<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a  class="btn btn-primary editdata"><i class="fa fa-plus"></i></a>
        <button type="button" id="deletc" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-download">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php echo $column_name; ?></td>
                  <td class="text-right">sort order</td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($downloads) { ?>
                <?php foreach ($downloads as $download) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($download['download_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $download['download_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $download['download_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $download['name']; ?></td>
                  <td class="text-right"><?php echo $download['sort_order']; ?></td>
                  <td class="text-right"><a data-cid="<?php echo $download['download_id'] ?>" data-sort="<?php echo $download['sort_order'] ?>" data-catename="<?php echo $download['name']; ?>"  class="editdata btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
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
            var catename = $(this).data('catename');
            var cid = $(this).data('cid');
            var sort = $(this).data('sort');
            $("#category_name").val(catename);
            $("#cid").val(cid);
            $('#sort_order').val(sort);
            $("#modals").modal('show');
        });

        $('#savechanges').on('click',function(){
            var name =  $("#category_name").val();
            var cid = $('#cid').val();
            var sort = $('#sort_order').val();
            if(name == ""){
                alert("category name can't be empty!");
                return false;
            }
            $.get("index.php?route=catalog/download/cedit&cid="+cid+"&name="+name+"&sort="+sort+"&token=<?php echo $_GET['token'] ?>",function(res){
                alert("success");
                location.reload();
            },'json');
        });

        $('#deletc').on('click',function(){
            var select =  $('input[name*=selected]:checked');
            if(typeof select != "undefiend" && select.length >0){
                var cids = "";
                select.each(function(k,v){
                   cids += ","+ $(v).val();
                });

                cids = cids.substr(1);
                $.post('index.php?route=catalog/download/cdelt&token=<?php echo $_GET["token"] ?>',{cid:cids},function(res){
                    alert("success");
                    location.reload();
                },'json');
            }
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
                <input type="hidden" class="form-control" id="cid">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" placeholder="Category Name">
                </div>
                <div class="form-group">
                    <label for="category_name">Sort Order</label>
                    <input type="text" class="form-control" id="sort_order" placeholder="Sort Order">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="savechanges" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>