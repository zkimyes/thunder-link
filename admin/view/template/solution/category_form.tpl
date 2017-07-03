<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>
                Solution Category
            </h1>
            <ul class="breadcrumb">
                <li>
                    <a></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>title</label>
                            <input type="text" v-model="title" class="form-control" placeholder="title">
                            <div v-if="title === ''" class="help-block text-danger">title 不能为空</div>
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
                            <label>link url</label>
                            <input type="text" v-model="url" class="form-control" placeholder="link url">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button class="btn btn-primary">提交</button>
                        <a class="btn btn-default" href="{{back_url|raw}}">取消</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Vue.config.devtools = true
    var category = new Vue({
        el:'#content',
        data:{
            title:'',
            meta_keyword:'',
            meta_desc:'',
            url:''
        },
        methods:{
            submit(){
                if(this.title == ''){
                }
            }
        }
    });
</script>
<?php echo $footer; ?>