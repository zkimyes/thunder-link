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
                <h3 class="panel-title"><i class="fa "></i>Article Form</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <input type="hidden" name="id" value="{{article.id}}">
                        <div class="form-group">
                            <label>Banners</label>
                            <select name="banner_id" class="form-control">
                                <option value="">--请选择--</option>
                                {% for banner in banners %}
                                    <option value="{{banner.banner_id}}">{{banner.name}}</option>
                                {% endfor %}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Solution Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">--请选择--</option>
                                {% for category in categorys %}
                                    <option value="{{category.id}}">{{category.title}}</option>
                                {% endfor %}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div>
                                <a href="javascript:;" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                <input type="hidden" name="image" value="{{article.image}}" id="input-image" />
                            </div>
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
                        <div class="form-group">
                            <label for="input-related">Related Products</label>
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
        var editor = CKEDITOR.replace('editor');
        $('[name="category_id"]').val("{{article.category_id}}");
        $('[name="banner_id"]').val("{{article.banner_id}}");

        function submit() {
            var _title = $('[name="title"]').val(),
                _meta_keywords = $('[name="meta_keywords"]').val(),
                _meta_desc = $('[name="meta_desc"]').val(),
                _summary = $('[name="summary"]').val(),
                _id = $('[name="id"]').val(),
                _image = $('[name="image"]').val(),
                _banner_id = $('[name="banner_id"]').val(),
                _category_id = $('[name="category_id"]').val(),
                _related_product = [];
            $('[name^="product_related"]').each(function(item) {
                _related_product[item] = $(this).val();
            })
            _related_product = _related_product.join(',');
            $.post('{{submit_url}}&token={{token}}', {
                id: _id,
                title: _title,
                image: _image,
                banner_id: _banner_id,
                category_id: _category_id,
                meta_keywords: _meta_keywords,
                meta_desc: _meta_desc,
                summary: _summary,
                related_product_ids: _related_product,
                content: editor.getData()
            }, function(res) {
                debugger
                if (res) {
                    location.href = "{{back_url}}&token={{token}}";
                }
            })
        }


        // Related
        $('input[name=\'related\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
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

                $('#product-related' + item['value']).remove();

                $('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_related[]" value="' + item['value'] + '" /></div>');
            }
        });

        $('#product-related').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
    </script>
    <?php echo $footer; ?>