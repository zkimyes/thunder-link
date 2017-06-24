{{ header|raw }} {{ column_left|raw }}
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>
                Hot Sale List -- {{action}}
            </h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{backurl|raw}}"><i class="fa fa-back"></i></a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Hot Sale Category
                </h3>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">category name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" v-model="name" placeholder="category name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">meta keywords</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" v-model="meta_keywords" placeholder="meta keywords">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">meta description</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" v-model="meta_desc" placeholder="meta description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button @click="submit()" type="submit" class="btn btn-success">Submit</button>
                            <button @click="cancel()" type="submit" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Vue.config.devtools = true
    var postData = function(data) {
        $.post('{{post_url|raw}}'.replace("amp;", ''), {
            data: data
        }, function(res) {
            if (res) {
                location.href = "{{backurl|raw}}".replace("amp;", '');
            }
        }, 'json')
    }
    var hotsale = new Vue({
        delimiters: ['${', '}'],
        el: '#content',
        data: {
            name: '{{data.row.name}}',
            meta_keywords: '{{data.row.meta_keywords}}',
            meta_desc: '{{data.row.meta_desc}}',
            id: '{{data.row.id}}'
        },
        methods: {
            submit: function() {
                postData({
                    id: this.id,
                    name: this.name,
                    meta_keywords: this.meta_keywords,
                    meta_desc: this.meta_desc
                })
            },
            cancel: function() {
                location.href = "{{backurl|raw}}".replace("amp;", '');
            }
        },
        mounted() {}
    })
</script>
{{footer|raw}}