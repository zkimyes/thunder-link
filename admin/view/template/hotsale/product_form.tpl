{{ header|raw }} {{ column_left|raw }}
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>
                Hot Sale Product -- {{action}}
            </h1>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Hot Sale Product
                </h3>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-5">
                            <select class="form-control" v-model="category_id">
                                <option value="">--选择目录--</option>
                                <option v-for="item in categories" :value="item.id">${item.name}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">关联产品</label>
                        <div class="col-sm-5" style="position:relative">
                            <input type="text" value="" placeholder="输入名字搜索,按@显示所有产品..." v-model="product_search" @input="searchProduct()" class="form-control" />
                            <ul class="dropdown-menu" v-if="product_search != ''" style="left:0;top:32px;display:block;">
                                <li @click="chooseProduct(product)" v-for="product in products"><a href="javascript:;">${product.name}</a>
                                </li>
                                <li style="text-indent:2em" v-if="isAjax">搜索中...</li>
                                <li style="text-indent:2em;" v-if="isAjax == false && product_search != '' && products.length ==0">没有结果</li>
                            </ul>
                            <div class="well well-sm" style="height: 150px; overflow: auto;">
                                <div v-if="link_product">
                                    <strong>${link_product.name}</strong><button @click="removeRelatedProduct()" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sort Order</label>
                        <div class="col-sm-5">
                            <input class="form-control" v-model="sort_order" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Is Home</label>
                            <div class="col-sm-5">
                                <select class="form-control" v-model="is_home">
                                    <option value="0">NO</option>
                                    <option value="1">YES</option>
                                </select>
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
            id:'{{data.row.id}}',
            categories:'{{categoris|raw}}'?JSON.parse('{{categoris|raw}}'):[],
            category_id:'{{data.row.category_id}}',
            product_id:'{{data.row.product_id}}',
            sort_order:'{{data.row.sort_order}}',
            is_home:'{{data.row.is_home}}',
            product_search: '',
            products: [],
            link_product: '{{data.row.product_id}}' ? {
                product_id: '{{data.row.product_id}}',
                name: '{{data.row.name}}'
            } : '',
            isAjax: false
        },
        methods: {
            submit: function() {
                postData({
                    id: this.id,
                    category_id:this.category_id,
                    product_id:this.product_id,
                    sort_order:this.sort_order,
                    is_home:this.is_home
                })
            },
            cancel: function() {
                location.href = "{{backurl|raw}}".replace("amp;", '');
            },
            chooseProduct: function(product) {
                var _vm = this;
                if (product) {
                    _vm.link_product = {
                        product_id: product.product_id,
                        name: product.name,
                    }
                    _vm.product_id = product.product_id;
                    _vm.product_search = '';
                    _vm.products = [];
                }
            },
            removeRelatedProduct: function() {
                var _vm = this;
                _vm.link_product = {
                    product_id: '',
                    name: ''
                }
                _vm.product_id = '';
            },
            searchProduct: _.debounce(function() {
                var _vm = this;
                _vm.isAjax = true;
                $.get('{{product_search_url|raw}}&token={{token}}', {
                    search: _vm.product_search
                }, function(res) {
                    _vm.isAjax = false;
                    if (res.products) {
                        _vm.products= res.products.map(function(item){
                            item.name = _.unescape(item.name);
                            return item;
                        })
                    }
                }, 'json')
            }, 500)
        },
        mounted() {}
    })
</script>
{{footer|raw}}