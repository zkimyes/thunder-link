{{ header|raw }} {{ column_left|raw }}
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>
                Hot Sale List
            </h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{add_url|raw}}"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Hot Sale Porducts
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-borded">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sort Order</th>
                            <th>Is Home</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in products">
                            <td v-text="item.id"></td>
                            <td v-text="item.name"></td>
                            <td v-text="item.sort_order"></td>
                            <td v-if="item.is_home == 1">Yes</td>
                            <td v-if="item.is_home == 0">No</td>
                            <td>
                                <a @click="update(item.id)" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                <button @click="delt(item.id)" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button>
                            </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    //Vue.config.delimiters = ['${', '}']
    Vue.config.devtools = true
    var hotsale = new Vue({
        delimiters: ['${', '}'],
        el: '#content',
        data: {
            products: null,
            id: null
        },
        methods: {
            delt: function(id) {
                var _vm = this;
                _vm.id = id;
                $.post("{{delt_url|raw}}".replace("amp;", ''), {
                    id: id
                }, function(data) {
                    if (data.return) {
                        _vm.getList();
                    }
                }, 'json')
            },
            getList:function(){
                var _vm = this;
                $.get("{{getList_url|raw}}".replace('amp;', ''), function(data) {
                    _vm.products = data.product;
                }, 'json');
            },
            update: function(id) {
                location.href = "{{update_url|raw}}".replace("amp;", '') + "&id=" + id;
            }
        },
        mounted() {
            this.getList();
        }
    })
</script>
{{footer|raw}}