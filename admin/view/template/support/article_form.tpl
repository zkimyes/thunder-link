<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>Support Article</h1>
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
                        <div class="form-group">
                            <label>Banners</label>
                            <select v-model="banner_id" name="banner_id" class="form-control">
                                <option value="">--请选择--</option>
                                {% for banner in banners %}
                                    <option value="{{banner.banner_id}}">{{banner.name}}</option>
                                {% endfor %}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Support Category</label>
                            <select v-model="category_id" name="category_id" class="form-control">
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
                            <input v-model="title" type="text" class="form-control" name="title" placeholder="标题">
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <input v-model="meta_keywords" type="text" class="form-control" name="meta_keywords" placeholder="关键词">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea v-model="meta_desc" class="form-control" name="meta_desc" placeholder="meta description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Summary</label>
                            <textarea v-model="summary" class="form-control" name="summary" placeholder="summary"></textarea>
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
                        <div id="tags" class="form-group">
                            <label for="input-related">Tags</label>
                            <div style="position:relative">
                                <input type="text" v-model="tag" @keyup="findTag()" @keyup.enter="addTag()" placeholder="输入标签" class="form-control" />
                                <ul class="dropdown-menu" v-if="tag != ''" style="left:0;top:32px;display:block;">
                                    <li @click="chooseTag(tag)" v-for="tag in tagList"><a href="javascript:;">${tag.name}</a>
                                    </li>
                                    <li v-if="isFetch" style="text-indent:2em;">检索中...</li>
                                    <li style="text-indent:2em;" v-if="!isFetch && tagList == ''">没有结果,回车添加标签</li>
                                </ul>
                                <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                                    <span style="margin:0 5px 0 0;" v-for="tag in tags" title="点击清除" @click="removeTag(tag)" v-for="tag in tagList" class="label label-info">${tag.name}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button @click="submit()" class="btn btn-primary">提交</button>
                        <a href="{{back_url}}&token={{token}}" class="btn btn-default">取消</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        Vue.config.devtools = true
        new Vue({
            el: '#content',
            delimiters: ['${', '}'],
            data: {
                id: '{{article.id}}',
                title: '{{article.title}}',
                banner_id: '{{article.banner_id}}',
                category_id: '{{article.category_id}}',
                meta_keywords: '{{article.meta_keywords}}',
                meta_desc: '{{article.meta_desc}}',
                summary: '{{article.summary}}',
                tags: '{{article.tags|raw}}' ? JSON.parse('{{article.tags|raw}}') : [],
                tagList: [],
                tag: '',
                isFetch: false,
                editor: null
            },
            methods: {
                removeTag: function(tag) {
                    this.tags = this.tags.filter(function(item) {
                        return item.id != tag.id;
                    })
                },
                addTag: function() {
                    var _vm = this;
                    var flag = null;
                    flag = _vm.tags.find(function(item) {
                        return item.name == _vm.tag;
                    })
                    if (!flag) {
                        $.get('{{ajaxGetTags|raw}}&token={{token}}', {
                            name: _vm.tag
                        }, function(res) {
                            if (!res || res.length == 0) {
                                $.post('{{ajaxAddTags|raw}}&token={{token}}', {
                                    name: _vm.tag,
                                    token: '{{token}}'
                                }, function(rt) {
                                    if (rt && rt.msg && rt.msg == 'succ') {
                                        _vm.tags.push({
                                            id: rt.id,
                                            name: _vm.tag
                                        })
                                    } else {
                                        return layer.msg('添加错误，请联系管理员')
                                    }
                                    _vm.tag = '';
                                }, 'json')
                            }
                        }, 'json')
                    }
                },
                findTag: _.debounce(function() {
                    var _vm = this;
                    var flag = null
                    flag = _vm.tags.find(function(item) {
                        return item.name == _vm.tag;
                    })
                    if (!flag) {
                        _vm.isFetch = true;
                        $.get('{{ajaxGetTags|raw}}&token={{token}}', {
                            name: _vm.tag
                        }, function(res) {
                            _vm.isFetch = false;
                            if (res && res.length > 0) {
                                _vm.tagList = res;
                            } else {
                                _vm.tagList = []
                            }
                        }, 'json')
                    }
                }, 300),
                chooseTag: function(tag) {
                    var _vm = this;
                    var flag = null;
                    flag = _vm.tags.find(function(item) {
                        return item.name == tag.name;
                    })
                    if (!flag) {
                        _vm.tags.push(tag);
                    }
                    _vm.tag = '';
                },
                submit: function() {
                    var _vm = this,
                        _image = $('[name="image"]').val(),
                        _related_product = [];
                    $('[name^="product_related"]').each(function(item) {
                        _related_product[item] = $(this).val();
                    })
                    _related_product = _related_product.join(',');
                    $.post('{{submit_url}}&token={{token}}', {
                        id: _vm.id,
                        title: _vm.title,
                        image: _image,
                        banner_id: _vm.banner_id,
                        category_id: _vm.category_id,
                        meta_keywords: _vm.meta_keywords,
                        meta_desc: _vm.meta_desc,
                        summary: _vm.summary,
                        related_product_ids: _related_product,
                        tag_ids: _vm.tags.map(item => {
                            return item.id
                        }),
                        content: _vm.editor.getData()
                    }, function(res) {
                        if (res) {
                            location.href = "{{back_url}}&token={{token}}";
                        }
                    })
                }

            },
            mounted: function() {
                this.editor = CKEDITOR.replace('editor');
            }
        })


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