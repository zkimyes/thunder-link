{{ header|raw }} {{ column_left|raw }}
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>
                {{title}}
            </h1>
            <div class="pull-right">
                <a class="btn btn-primary" @click="add()">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-list"></i> {{title}}
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-borded">
                    <thead>
                        <tr>
                            {% for col in cols %}
                            <th>{{col}}</th>
                            {% endfor %}
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in documents">
                            <td v-text="item.id">
                            </td>
                            <td>
                                <input placeholder="输入文档名" v-if="item.edit" v-model="item.name" type="text" />
                                <b v-else>${item.name}</b>
                            </td>
                            <td>
                                <select v-model="item.category_id" v-if="item.edit">
                                    <option value="">--选择目录--</option>
                                    <option v-for="cate in category" :value="cate.id">${cate.name}</option>
                                </select>
                                <b>${item.category_name}</b>
                            </td>
                            <td>
                                <b>${item.download_name}</b>
                                <m-download v-if="item.edit == true" :index="index" :callback="chooseDown" :id="item.download_id" />
                            </td>
                            <td>
                                <a v-if="item.edit==true" @click="save(index)" class="btn btn-xs btn-success">保存</a>
                                <a v-if="item.edit==true" @click="cancel(index)" class="btn btn-xs btn-default">取消</a>
                                <a v-else @click="edit(index)" class="btn btn-xs btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button @click="delt(index)" class="btn btn-xs btn-danger">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </td>
                    </tbody>
                </table>
            </div>
            <div id="laypage"></div>
        </div>
    </div>
</div>
<script>
    Vue.config.devtools = true
    var delt = function (id) {
        $.post("{{delt_url|raw}}".replace("amp;", ''), {
            id: id
        }, function (data) {
            if (data.return) {
                loaction.reload();
            }
        }, 'json')
    }

    Vue.component('m-download', {
        delimiters: ['@{', '}'],
        template: `
            <div>
                <div>
                    <input v-model="text" type="text">
                </div>
                <div v-if="status == 'loading'">查询中...</div>
                <div v-if="status == 'empty'">没有结果</div>
                <ul class="list-unstyled" style="margin:5px;">
                    <li title='点击选择' @click="choose(l)" v-for="l in list"><a href="javascript:;">@{l.name}</a></li>
                </ul>
            </div>
        `,
        props: ['id','callback','index'],
        data:function(){
            return {
                text: '',
                status:'',
                list: []
            }
        },
        watch:{
            text:function(newV){
                if(newV){
                    this.search();
                }
            }
        },
        methods: {
            search() {
                let _that = this;
                _that.status = 'loading';
                $.ajax({
                    url: 'index.php?route=catalog/download/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(this.text),
                    dataType: 'json',
                    success: function (json) {
                        _that.status = json.length>0?'':'empty';
                        _that.list = json;
                    }
                });
            },
            choose(download){
                this.list = [];
                this.status = "";
                this.callback(download,this.index);
            }
        },
        mounted() {
        }
    })


    var hotsale = new Vue({
        delimiters: ['${', '}'],
        el: '#content',
        data: {
            category: JSON.parse('{{categories|raw}}'),
            documents: JSON.parse('{{documents|raw}}'),
            id: null
        },
        methods: {
            add: function () {
                this.documents.push({
                    category_id: "",
                    category_name: "",
                    download_id: "",
                    download_name: "",
                    id: "",
                    name: "",
                    sort: "",
                    edit:true
                })
            },
            edit: function (index) {
                this.documents.splice(index, 1, Object.assign(this.documents[index], { edit: true }));
            },
            cancel: function (index) {
                this.documents.splice(index, 1, Object.assign(this.documents[index], { edit: null }));
            },
            delt: function (index) {
                var _id = this.documents[index].id;
                this.documents.splice(index, 1);
                delt(_id);
            },
            save: function (index) {
                var _data = this.documents[index];
                this.cancel(index);
                $.post("{{save_url|raw}}".replace("amp;", ''), _data, function (res) {
                    location.reload();
                })
            },
            chooseDown:function(download,index){
                this.documents.splice(index,1,Object.assign(this.documents[index],{ download_id: download.download_id, download_name: download.name}))
            }
        },
        mounted() {
        }
    })

</script> {{footer|raw}}