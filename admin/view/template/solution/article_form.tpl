<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>Solution Article</h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li>
                    <a href="<?php echo $breadcrumb['href']; ?>">
                        <?php echo $breadcrumb['text']; ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid" id="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i>Article List</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>title</label>
                            <input type="text" v-model="title" class="form-control" placeholder="title">
                        </div>
                        <div class="form-group">
                            <label>meta keyword</label>
                            <input type="text" v-model="meta_keyword" class="form-control" placeholder="meta keyword">
                        </div>
                        <div class="form-group">
                            <label>meta description</label>
                            <textarea v-model="meta_desc" class="form-control" placeholder="meta description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>summary</label>
                            <textarea v-model="meta_desc" class="form-control" placeholder="summary"></textarea>
                        </div>
                        <div class="form-group">
                            <label>content</label>
                            <textarea class="form-control" id="editor" placeholder="meta description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                      <button class="btn btn-primary">提交</button>
                      <a class="btn btn-default">取消</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      CKEDITOR.replace( 'editor' );
    </script>
    <?php echo $footer; ?>