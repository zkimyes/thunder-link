<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>
                Solution Category
            </h1>
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
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banners</label>
                            <select v-model="banner" name="banner_id" class="form-control">
                                <option value="0">--请选择--</option>
                                {%for banner in banners%}
                                <option value="{{banner.banner_id}}">{{banner.name}}</option>
                                {%endfor%}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" v-model="name" class="form-control" placeholder="填写标题">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea v-model="description" class="form-control" placeholder="填写标题"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" v-model="meta_title" class="form-control" placeholder="Meta Title">
                        </div>
                        <div class="form-group">
                            <label>Meta Keyword</label>
                            <input type="text" v-model="meta_keyword" class="form-control" placeholder="Meta Keyword">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea v-model="meta_description" class="form-control" placeholder="Meta Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div>
                                <a href="javascript:;" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" data-placeholder="<?php echo $placeholder; ?>" alt="" title=""/></a>
                                <input type="hidden" name="image" v-model="image" id="input-image" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="text" v-model="sort_order" class="form-control" placeholder="0">
                            <p class="help-text">数字越大排序越靠前</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button @click="submit()" class="btn btn-primary">提交</button>
                        <a class="btn btn-default" href="{{back_url|raw}}&token={{token}}">取消</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Vue.config.devtools = true
    var category = new Vue({
        delimiters: ['${', '}'],
        el: '#content',
        data: {
            banner: "{{category.banner}}",
            category_id: '{{category.category_id}}',
            name: '{{category.name}}',
            description: '{{category.description}}',
            meta_title: '{{category.meta_title}}',
            meta_keyword: '{{category.meta_keyword}}',
            meta_description: '{{category.meta_description}}',
            sort_order: '{{category.sort_order}}',
            image: '{{category.image}}'
        },
        methods: {
            submit() {
                let data = {
                    category_id: this.category_id,
                    name: this.name,
                    description: this.description,
                    meta_title: this.meta_title,
                    meta_keyword: this.meta_keyword,
                    meta_description: this.meta_description,
                    sort_order: this.sort_order,
                    banner: this.banner,
                    image: $('#input-image').val()
                }

                if (data.name == "") {
                    return layer.msg('标题不能为空');
                }

                $.post('{{submit_url|raw}}&token={{token}}', data, function(res) {
                    if (res) {
                        location.href = "{{back_url|raw}}&token={{token}}";
                    }
                }, 'json')
            }
        }
    });
</script>
<?php echo $footer; ?>