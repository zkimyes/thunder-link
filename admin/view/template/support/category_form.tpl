<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>
                Support Category
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
                            <label>Parent Category</label>
                            <select v-model="parent_id" class="form-control">
                                <option value="0">-- 没有父级目录 --</option>
                                <option v-for="category in categories" :value="category.id">${category.title}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" v-model="title" class="form-control" placeholder="输入目录名">
                        </div>
                        <div class="form-group">
                            <label>Meta Keyword</label>
                            <input type="text" v-model="meta_keyword" class="form-control" placeholder="输入关键词">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea v-model="meta_desc" class="form-control" placeholder="输入描述"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Link Url</label>
                            <input type="text" v-model="url" class="form-control" placeholder="关联url">
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
        el: '#content',
        delimiters: ['${', '}'],
        data: {
            id: '{{category.id}}',
            title: '{{category.title}}',
            meta_keyword: '{{category.meta_keyword}}',
            meta_desc: '{{category.meta_desc}}',
            url: '{{category.url}}',
            parent_id:'{{category.parent_id}}'||0,
            categories:'{{categories|raw}}'?JSON.parse('{{categories|raw}}'):[]
        },
        methods: {
            submit() {
                let data = {
                    id: this.id,
                    title: this.title,
                    meta_keyword: this.meta_keyword,
                    meta_desc: this.meta_desc,
                    parent_id:this.parent_id,
                    url: this.url
                }

                if (data.title == "") {
                    return layer.msg('标题不能为空');
                }

                if (data.meta_keyword == "") {
                    return layer.msg('关键词不能为空');
                }

                if (data.meta_desc == "") {
                    return layer.msg('文档描述不能为空')
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