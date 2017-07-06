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
                        <input type="hidden" name="id" value="{{article.id}}">
                        <div class="form-group">
                            <label>Solution Category</label>
                            <select name="category_id" class="form-control">
                                {% for category in categorys %}
                                    <option value="{{category.id}}">{{category.title}}</option>
                                {% endfor %}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{article.title}}" placeholder="title">
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <input type="text" class="form-control" name="meta_keywords" value="{{article.meta_keywords}}" placeholder="meta keyword">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_desc" placeholder="meta description">{{article.meta_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Summary</label>
                            <textarea class="form-control" name="summary" placeholder="summary">{{article.summary}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control" id="editor" name="content" placeholder="meta description">{{article.content|raw}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                      <button onclick="submit()" class="btn btn-primary">提交</button>
                      <a href="{{back_url}}&token={{token}}" class="btn btn-default">取消</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var editor = CKEDITOR.replace( 'editor' );
        $('[name="category_id"]').val("{{article.category_id}}");
        function submit(){
            var _title = $('[name="title"]').val(),
                _meta_keywords = $('[name="meta_keywords"]').val(),
                _meta_desc = $('[name="meta_desc"]').val(),
                _summary = $('[name="summary"]').val(),
                _id = $('[name="id"]').val(),
                _category_id = $('[name="category_id"]').val();

                $.post('{{submit_url}}&token={{token}}',{
                    id:_id,
                    title:_title,
                    category_id:_category_id,
                    meta_keywords:_meta_keywords,
                    meta_desc:_meta_desc,
                    summary:_summary,
                    content:editor.getData()
                },function(res){
                    if(res){
                        location.href = "{{back_url}}&token={{token}}";
                    }
                })
        }

    </script>
    <?php echo $footer; ?>