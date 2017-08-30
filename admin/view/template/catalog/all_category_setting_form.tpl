<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
            </div>
            <h1>All Categories List Seting</h1>
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
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">目录</label>
                    <div>{{category.name}}</div>
                </div>
                <div class="form-group">
                    <label>关联产品</label>
                    <div style="position:relative">
                        <input type="text" value="" placeholder="输入名字搜索,按@显示所有产品..." v-model="product_search" @input="searchProduct()" class="form-control" />
                        <ul class="dropdown-menu" v-if="product_search != ''" style="left:0;top:32px;display:block;">
                            <li @click="chooseProduct(product)" v-for="product in products"><a href="javascript:;">${product.name}</a>
                            </li>
                            <li style="text-indent:2em" v-if="isAjax">搜索中...</li>
                            <li style="text-indent:2em;" v-if="isAjax == false && product_search != '' && products.length ==0">没有结果</li>
                        </ul>
                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                            <div v-if="link_product">
                                <div class="col-md-3">
                                    <img :src="link_product.thumb" alt="">
                                    <div>${link_product.name}</div>
                                    <button @click="removeRelatedProduct()" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>中部Banner</label>
                </div>
                <div class="form-group">
                    <label>右边顶部Banner</label>
                </div>
                <div class="form-group">
                    <label>右边底部Banner</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{back_url|raw}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<script>
    Vue.config.devtools = true;
    Vue.directive('number', function(el) {
        if (isNaN(el.value)) {
            el.value = 0;
        } else {
            el.value = parseInt(el.value);
        }
    })
    var typical = new Vue({
        el: '#content',
        delimiters: ['${', '}'],
        data: {
            id: '{{typical.id}}',
            category_id: '{{typical.category_id}}',
            image: '{{typical.image}}',
            name: '{{typical.name}}',
            link_product_id: '{{typical.link_product_id}}',
            parameter: '{{typical.parameter|raw}}' ? JSON.parse('{{typical.parameter|raw}}') : '',
            link_boards: '{{typical.link_boards}}',
            sort_order: '{{typical.sort_order}}',
            search: '',
            link_boards: '{{typical.link_boards|raw}}' ? JSON.parse('{{typical.link_boards|raw}}') : [],
            product_search: '',
            products: [],
            link_product: '{{typical.product_name}}' ? {
                product_id: '{{typical.link_product_id}}',
                name: '{{typical.product_name}}',
                image: '{{typical.image}}',
                thumb: '{{typical.thumb}}'
            } : '',
            boards: '{{boards}}'?JSON.parse('{{boards|raw}}'):'',
            isAjax: false
        },
        computed: {
            boardResult: function() {
                var _vm = this;
                var data;
                if (_vm.search != '') {
                    data = _vm.boards.filter(function(item) {
                        return item.name.toLocaleUpperCase().indexOf(_vm.search.toLocaleUpperCase()) >= 0
                    })
                }

                if (_vm.search == '@') {
                    data = _vm.boards;
                }

                return data
            }
        },
        methods: {
            addParameter: function() {
                this.parameter.push({
                    name: '',
                    value: '',
                    min: 0,
                    max: 1
                })
            },
            removeParameter: function(index) {
                this.parameter = this.parameter.filter(function(item, key) {
                    return key != index
                })
            },
            chooseBoard: function(choosed) {
                var _vm = this;
                if (choosed) {
                    var data = _vm.link_boards.filter(function(item) {
                        return item.id != choosed.id
                    }).concat(choosed);
                    data.sort(function(a, b) {
                        return a.type - b.type
                    })
                    _vm.link_boards = data;
                    _vm.search = '';
                }
            },
            removeBoard: function(board) {
                this.link_boards = this.link_boards.filter(function(item) {
                    return item.id != board.id
                })
            },
            chooseProduct: function(product) {
                var _vm = this;
                if (product) {
                    _vm.link_product = {
                        product_id: product.product_id,
                        name: product.name,
                        thumb: product.thumb
                    }
                    _vm.link_product_id = product.product_id
                    _vm.product_search = '';
                    _vm.products = [];
                }
            },
            removeRelatedProduct: function() {
                var _vm = this;
                _vm.link_product = ''
                _vm.link_product_id = '';
            },
            searchProduct: _.debounce(function() {
                var _vm = this;
                _vm.isAjax = true;
                $.get('{{product_search_url|raw}}&token={{token}}', {
                    search: _vm.product_search
                }, function(res) {
                    _vm.isAjax = false;
                    if (res.products) {
                        _vm.products = res.products
                    }
                }, 'json')
            }, 500),
            submit: function() {
                var data = {
                    id: this.id,
                    category_id: this.category_id,
                    name: this.name,
                    link_product_id: this.link_product_id,
                    parameter: this.parameter,
                    blueprint: $('#input-blueprint').val(),
                    link_boards: this.link_boards,
                    sort_order: this.sort_order
                }
                if (data.name == "") {
                    return layer.msg('产品名称不能为空');
                }

                if (data.blueprint == "") {
                    return layer.msg("产品空配置图必选");
                }

                if (data.blueprint == "") {
                    return layer.msg("产品空配置图必选");
                }

                if (data.link_boards.length == 0) {
                    return layer.msg("产品板卡必选");
                } else {
                    var flag = false;
                    for (var i = 0; i < data.link_boards.length; i++) {
                        if (data.link_boards[i].type == 1) {
                            flag = true
                        }
                    }
                    if (!flag) {
                        layer.msg('必选系统板卡');
                    }
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