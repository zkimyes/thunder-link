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
                <h3 class="panel-title"><i class="fa "></i>Typical Form</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <input type="hidden" name="id" v-model="id">
                        <div class="form-group">
                            <label>Config Category</label>
                            <select v-model="category_id" name="category_id" class="form-control">
                                <option value="">--请选择--</option>
                                {% for category in categorys %}
                                    <option value="{{category.category_id}}">{{category.name}}</option>
                                {% endfor %}
                            </select>
                        </div>
                        <div class="form-group" style="overflow:hidden">
                            <div class="pull-left">
                                <label>Image</label>
                                <div>
                                    <a href="javascript:;" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input v-model="image" type="hidden" name="image" value="{{article.image}}" id="input-image" />
                                </div>
                            </div>
                            <div class="pull-left" style="margin-left:100px;">
                                <label>Blueprint</label>
                                <div>
                                    <a href="javascript:;" id="thumb-blueprint" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb_blueprint; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input v-model="blueprint" type="hidden" name="blueprint" id="input-blueprint" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" v-model="name" placeholder="输入标题">
                        </div>
                        <div class="form-group">
                            <label>Parameter <button @click="addParameter()" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i>增加</button> </label>
                            <div class="parameter">
                                <div class="parameter-item" v-for="(param,index) in parameter">参数名：<input v-model="param.name" type="text"> 值：<input v-model="param.value" type="text"> 最小值：<input v-model="param.min" type="text">最大值：<input v-model="param.max" type="text"> <button @click="removeParameter(index)" class="btn btn-xs btn-warning"><i class="fa fa-close"></i></button></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-related">系统板</label>
                                    <div>
                                        <input type="text" name="related" value="" placeholder="筛选" id="input-related" class="form-control" />
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <label class="input-group" style="margin-bottom:10px;" v-for="board in system_board">
                                                <input class="col-md-1" v-model="system.id" :value="board.id" type="radio"> 
                                                <span class="col-md-8">${board.name}</span>
                                                <input v-if="system.id == board.id" class="col-md-2" style="padding:0" placeholder="数量" v-model="system.qty" type="text">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-related">配置板</label>
                                    <div>
                                        <input type="text" name="related" value="" placeholder="筛选" id="input-related" class="form-control" />
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                              <label v-for="(board,key) in other_board">
                                                <input class="col-md-1" v-model="other" :value="board.id" type="checkbox"> 
                                                <span class="col-md-6">${board.name} ${key}</span>
                                                <input class="col-md-2" placeholder="数量" v-model="other.qty" class="col-md-2" style="padding:0" type="text">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button onclick="submit()" class="btn btn-primary">提交</button>
                        <a href="{{back_url}}&token={{token}}" class="btn btn-default">取消</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        Vue.config.devtools = true
        var typical = new Vue({
            el: '#content',
            delimiters: ['${', '}'],
            data: {
                id: '{{typical.id}}',
                category_id: '{{typical.category_id}}',
                image: '{{typical.image}}',
                name: '{{typical.name}}',
                link_product_id: '{{typical.link_product_id}}',
                parameter: [{
                    name: 'Speed',
                    min: 0,
                    value: 1,
                    max: 1
                }],
                blueprint: '{{typical.blueprint}}',
                link_boards: '{{typical.link_boards}}',
                sort_order: '{{typical.sort_order}}',
                system:{
                    id:0,
                    qty:0
                },
                other:[{
                    id:0,
                    qty:0
                }],
                boards:JSON.parse('{{boards|raw}}')
            },
            computed:{
                system_board:function(){
                    return this.boards.filter(function(item){
                        return item.type == 1;
                    });
                },
                other_board:function(){
                    return this.boards.filter(function(item){
                        return item.type == 2;
                    });
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
                submit: function() {
                    let data = {}

                    if (data.title == "") {
                        return layer.msg('标题不能为空');
                    }

                    if (data.title == "") {
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