<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>
                {{breadcrumbs[1].text}}
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
                            <label>Name</label>
                            <input :disabled="type == 1" type="text" v-model="name" class="form-control" placeholder="填写标题">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" v-model="type">
                                <option value="1">System Board</option>
                                <option value="2">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="text" v-model="order" class="form-control" placeholder="0">
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
            id: '{{board_type.id}}',
            name: '{{board_type.name}}',
            type: '{{board_type.type}}',
            order: '{{board_type.order}}'
        },
        methods: {
            submit() {
                let data = {
                    id: this.id,
                    name: this.name,
                    type: this.type,
                    order: this.order
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