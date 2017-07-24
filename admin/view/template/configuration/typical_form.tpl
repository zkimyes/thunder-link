<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>Solution Typical </h1>
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
                <h3 class="panel-title"><i class="fa "></i>Typical Form</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <input type="hidden" name="id" value="{{article.id}}">
                        <div class="form-group">
                            <label>Config Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">--请选择--</option>
                                {% for category in categorys %}
                                    <option value="{{category.category_id}}">{{category.name}}</option>
                                {% endfor %}
                            </select>
                        </div>
                        <div class="form-group" style="overflow:hidden">
                            <div class="pull-left">
                                <label>Image</label>
                                <div>
                                    <a href="javascript:;" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden" name="image" value="{{article.image}}" id="input-image" />
                                </div>
                            </div>
                            <div class="pull-left" style="margin-left:100px;">
                                <label>Blueprint</label>
                                <div>
                                    <a href="javascript:;" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden" name="image" value="{{article.blueprint}}" id="input-image" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="title" value="{{article.title}}" placeholder="title">
                        </div>
                        <div class="form-group">
                            <label>Summary</label>
                            <textarea class="form-control" name="summary" placeholder="summary">{{article.summary}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control" id="editor" name="content" placeholder="meta description">{{article.content|raw}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-related">Sysrtem Board</label>
                                    <div>
                                        <input type="text" name="related" value="" placeholder="输入名字搜索产品" id="input-related" class="form-control" />
                                        <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($product_relateds as $product_related) { ?>
                                            <div id="product-related<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i>
                                                <?php echo $product_related['name']; ?>
                                                <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-related">Config Board</label>
                                    <div>
                                        <input type="text" name="related" value="" placeholder="输入名字搜索产品" id="input-related" class="form-control" />
                                        <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($product_relateds as $product_related) { ?>
                                            <div id="product-related<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i>
                                                <?php echo $product_related['name']; ?>
                                                <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        var editor = CKEDITOR.replace('editor', {
            toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            }, {
                "name": "links",
                "groups": ["links"]
            }, {
                "name": "paragraph",
                "groups": ["list", "blocks"]
            }, {
                "name": "document",
                "groups": ["mode"]
            }, {
                "name": "insert",
                "groups": ["insert"]
            }, {
                "name": "styles",
                "groups": ["styles"]
            }, {
                "name": "about",
                "groups": ["about"]
            }]
        });
    </script>
    <script>
        Vue.config.devtools = true
        var category = new Vue({
            el:'#content',
            data:{
                category_id:'{{}}'
            },
            methods:{
                submit(){
                    let data = {
                    }

                    if(data.title == ""){
                        return layer.msg('标题不能为空');
                    }

                    if(data.title == ""){
                        return layer.msg('标题不能为空');
                    }

                    $.post('{{submit_url|raw}}&token={{token}}',data,function(res){
                        if(res){
                            location.href="{{back_url|raw}}&token={{token}}";
                        }
                    },'json')
                }
            }
        });
    </script>
    <?php echo $footer; ?>