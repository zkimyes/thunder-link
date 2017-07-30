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
                        <div class="form-group" style="overflow:hidden">
                            <div class="pull-left">
                                <label>图片</label>
                                <div>
                                    <a href="javascript:;" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input v-model="image" type="hidden" name="image" value="{{article.image}}" id="input-image" />
                                </div>
                            </div>
                            <div class="pull-left" style="margin-left:100px;">
                                <label>布线图</label>
                                <div>
                                    <a href="javascript:;" id="thumb-blueprint" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb_blueprint; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input v-model="blueprint" type="hidden" name="blueprint" id="input-blueprint" />
                                </div>
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
                            <label for="input-related">系统板</label>
                            <div style="position:relative">
                                <input type="text" value="" placeholder="输入名字搜索,按@显示所有主板..." id="input-related" v-model="search" class="form-control" />
                                <ul class="dropdown-menu" v-if="search != ''" style="left:0;top:32px;display:block;">
                                    <li @click="choose({id:board.id,name:board.name,type:board.type,qty:0})" v-for="board in boardResult"><a href="javascript:;">${board.name}</a>
                                    </li>
                                    <li style="text-indent:2em;" v-if="boardResult == ''">没有结果</li>
                                </ul>
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    <div v-for="board in choosedBoards" style="margin-bottom:5px;overflow:hidden;" >
                                        <div class="col-md-7">
                                            <span class="label label-default" v-if="board.type == 1">系统板</span>
                                            <span class="label label-success" v-else>配置板</span>
                                            ${board.name}
                                        </div>
                                        <div class="col-md-1"><input v-number style="width:100%;" style="padding:0" v-model="board.qty" placeholder="数量" type="text"></div>
                                        <div class="col-md-2"><button class="btn btn-xs btn-danger" ><i class="fa fa-remove"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-related">板卡</label>
                            <div style="position:relative">
                                <input type="text" value="" placeholder="输入名字搜索,按@显示所有主板..." id="input-related" v-model="search" class="form-control" />
                                <ul class="dropdown-menu" v-if="search != ''" style="left:0;top:32px;display:block;">
                                    <li @click="choose({id:board.id,name:board.name,type:board.type,qty:0})" v-for="board in boardResult"><a href="javascript:;">${board.name}</a>
                                    </li>
                                    <li style="text-indent:2em;" v-if="boardResult == ''">没有结果</li>
                                </ul>
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    <div v-for="board in choosedBoards" style="margin-bottom:5px;overflow:hidden;" >
                                        <div class="col-md-7">
                                            <span class="label label-default" v-if="board.type == 1">系统板</span>
                                            <span class="label label-success" v-else>配置板</span>
                                            ${board.name}
                                        </div>
                                        <div class="col-md-1"><input v-number style="width:100%;" style="padding:0" v-model="board.qty" placeholder="数量" type="text"></div>
                                        <div class="col-md-2"><button class="btn btn-xs btn-danger" ><i class="fa fa-remove"></i></button></div>
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
        Vue.config.devtools = true;
        Vue.directive('number',function(el){
            if(isNaN(el.value)){
                el.value = 0;
            }else{
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
                parameter: [{
                    name: '',
                    min: 0,
                    value: 1,
                    max: 1
                }],
                search:'',
                choosedBoards:[],
                blueprint: '{{typical.blueprint}}',
                link_boards: '{{typical.link_boards}}',
                sort_order: '{{typical.sort_order}}',
                boards:JSON.parse('{{boards|raw}}')
            },
            computed:{
                boardResult:function(){
                    var _vm = this;
                    var data;
                    if(_vm.search != ''){
                       data  = _vm.boards.filter(function(item){
                            return item.name.toLocaleUpperCase().indexOf(_vm.search.toLocaleUpperCase())>=0
                        })
                    }

                    if(_vm.search == '@'){
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
                choose:function(choosed){
                    var _vm = this;
                    if(choosed){
                        var data = _vm.choosedBoards.filter(function(item){
                            return item.id != choosed.id
                        }).concat(choosed);
                        data.sort(function(item){
                            console.log(item);
                        })
                        _vm.choosedBoards = data;
                        _vm.search = '';
                    }
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