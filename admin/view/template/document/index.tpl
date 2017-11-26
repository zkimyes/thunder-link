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
                        <tr v-for="(item,index) in category">
                            <td v-text="item.id">
                            </td>
                            <td>
                                <input placeholder="输入目录名" v-if="item.edit" v-model="item.name" type="text" />
                                <b v-else>${item.name}</b>
                                <download/>
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

    var hotsale = new Vue({
        delimiters: ['${', '}'],
        el: '#content',
        data: {
            category: JSON.parse('{{categories|raw}}'),
            id: null
        },
        methods: {
            add: function () {
                this.category.push({
                    id: 0,
                    name: '',
                    edit: true
                })
            },
            edit: function (index) {
                this.category.splice(index, 1, Object.assign(this.category[index], { edit: true }));
            },
            cancel: function (index) {
                this.category.splice(index, 1, Object.assign(this.category[index], { edit: null }));
                console.log(this.category[index]);
            },
            delt: function (index) {
                var _id = this.category[index].id;
                this.category.splice(index, 1);
                delt(_id);
            },
            save: function (index) {
                var _data = this.category[index];
                $.post("{{save_url|raw}}".replace("amp;", ''), _data, function (res) {
                    location.reload();
                })
            }
        },
        mounted() {
        }
    });



</script> {{footer|raw}}