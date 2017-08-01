<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>Solution Typical </h1>
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
    <div class="container-fluid" id="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa "></i>典型配置表单</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <input type="hidden" name="id" v-model="id">
                        <div class="form-group">
                            <label>所属目录</label>
                            <select v-model="category_id" name="category_id" class="form-control">
                                <option value="">--请选择--</option>
                                {% for category in categorys %}
                                    <option value="{{category.category_id}}">{{category.name}}</option>
                                {% endfor %}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>关联产品</label>
                            <div style="position:relative">
                                <input type="text" value="" placeholder="输入名字搜索,按@显示所有主板..." v-model="product_search" @input="searchProduct()" class="form-control" />
                                <ul class="dropdown-menu" v-if="product_search != ''" style="left:0;top:32px;display:block;">
                                    <li @click="chooseProduct(product)" v-for="product in products"><a href="javascript:;">${product.name}</a>
                                    </li>
                                    <li style="text-indent:2em" v-if="isAjax">搜索中...</li>
                                    <li style="text-indent:2em;" v-if="isAjax == false && product_search != '' && products.length ==0">没有结果</li>
                                </ul>
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    <div v-if="link_product.product_id != ''">
                                        <div class="col-md-3">
                                            <img :src="link_product.thumb" alt="">
                                        </div>
                                        <div class="col-md-6"><strong>${link_product.name}</strong></div>
                                        <div class="col-md-2"><button @click="removeRelatedProduct()" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="overflow:hidden">
                            <label>配置图</label>
                            <div>
                                <a href="javascript:;" id="thumb-blueprint" data-toggle="image" class="img-thumbnail"><img src="{{typical.thumb_blueprint}}"  data-placeholder="<?php echo $placeholder; ?>" /></a>
                                <input v-model="blueprint" type="hidden" name="blueprint" id="input-blueprint" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>名字</label>
                            <input type="text" class="form-control" name="name" v-model="name" placeholder="输入标题">
                        </div>
                        <div class="form-group">
                            <label>参数 <button @click="addParameter()" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i>增加</button> </label>
                            <div class="parameter">
                                <div class="parameter-item" v-for="(param,index) in parameter">参数名：<input v-model="param.name" type="text"> 值：<input v-model="param.value" type="text"> 最小值：<input v-model="param.min" type="text">最大值：<input v-model="param.max" type="text"> <button @click="removeParameter(index)" class="btn btn-xs btn-warning"><i class="fa fa-close"></i></button></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-related">板卡</label>
                            <div style="position:relative">
                                <input type="text" value="" placeholder="输入名字搜索,按@显示所有主板..." id="input-related" v-model="search" class="form-control" />
                                <ul class="dropdown-menu" v-if="search != ''" style="left:0;top:32px;display:block;">
                                    <li @click="chooseBoard({id:board.id,name:board.name,type:board.type,qty:0})" v-for="board in boardResult"><a href="javascript:;">${board.name}</a>
                                    </li>
                                    <li style="text-indent:2em;" v-if="boardResult == ''">没有结果</li>
                                </ul>
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    <div v-for="board in link_boards" style="margin-bottom:5px;overflow:hidden;">
                                        <div class="col-md-7">
                                            <span class="label label-default" v-if="board.type == 1">系统板</span>
                                            <span class="label label-success" v-else>配置板</span> ${board.name}
                                        </div>
                                        <div class="col-md-1"><input v-number style="width:100%;" style="padding:0" v-model="board.qty" placeholder="数量" type="text"></div>
                                        <div class="col-md-2"><button @click="removeBoard(board)" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-related">排序值</label>
                            <div>
                                <input class="form-control" v-model="sort_order" placeholder="输入排序值" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button @click="submit()" class="btn btn-primary">提交</button>
                        <a href="{{back_url}}&token={{token}}" class="btn btn-default">取消</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.bootcss.com/lodash.js/4.17.4/lodash.min.js"></script>
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
                parameter: JSON.parse('{{typical.parameter|raw}}'),
                blueprint: '{{typical.blueprint}}',
                link_boards: '{{typical.link_boards}}',
                sort_order: '{{typical.sort_order}}',
                search: '',
                link_boards: JSON.parse('{{typical.link_boards|raw}}'),
                product_search: '',
                products: [],
                link_product: {
                    product_id: '{{typical.link_product_id}}',
                    name: '{{typical.product_name}}',
                    image: '{{typical.image}}',
                    thumb: '{{typical.thumb}}'
                },
                boards: JSON.parse('{{boards|raw}}'),
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
                removeBoard:function(board){
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
                    _vm.link_product = {
                        product_id: '',
                        name: ''
                    }
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

                    if(data.blueprint == ""){
                        return layer.msg("产品空配置图必选");
                    }

                    if(data.blueprint == ""){
                        return layer.msg("产品空配置图必选");
                    }

                    if(data.link_boards.length == 0){
                        return layer.msg("产品板卡必选");
                    }else{
                        var flag = false;
                        for(var i=0;i<data.link_boards.length;i++){
                            if(data.link_boards[i].type == 1){
                                flag = true
                            }
                        }
                        if(!flag){
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