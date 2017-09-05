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
                            <input type="text" v-model="name" class="form-control" placeholder="输入板卡名">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea v-model="content" placeholder="填写描述" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Board Type</label>
                            <select class="form-control" v-model="border_type_id">
                                <option value="">--选择板卡类型--</option>
                                <option v-for="board_type in board_types" :value="board_type.id">${board_type.name}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="text" v-model="order" class="form-control" placeholder="排序值">
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
    var app = new Vue({
        delimiters: ['${', '}'],
        el: '#content',
        data: {
            id: '{{board.id}}',
            name: '{{board.name}}',
            content:'{{board.content}}',
            border_type_id:'{{board.border_type_id}}',
            board_types:JSON.parse('{{board_types|raw}}'),
            order: '{{board.order}}'
        },
        methods: {
            submit() {
                let data = {
                    id: this.id,
                    name: this.name,
                    content:this.content,
                    border_type_id: this.border_type_id,
                    order: this.order
                }

                if (data.name == "") {
                    return layer.msg('板卡名字不能为空');
                }

                if (data.content == "") {
                    return layer.msg('请输入办卡描述');
                }

                if (data.border_type_id == "") {
                    return layer.msg('请选择办卡类型');
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