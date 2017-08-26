<?php echo $header; ?>
<?php echo $content_top ?>
<main id="_configure" class="main configure">
    <div class="container">
        <div class="eg clearfix mt30">
            <div @click="selectCategory(category)" v-for="category in categories" class="col-md-2">
                <a href="javascript:;" class="eg-block" :class="{actived:category.category_id == choosedCategory.category_id}">
                    <div class="col-md-5">
                        <img :src="category.thumb" alt="${category.name}">
                    </div>
                    <div class="col-md-7">${category.name}</div>
                </a>
            </div>
        </div>

        <div class="packages-setting row">
            <div class="col-md-8 setting-content">
                <div class="col-md-3 tab-menu">
                    <ul>
                        <li @click="selectType(type)" :class="{actived:choosedType.id == type.id}" v-for="type in board_types">
                            <a class="">
                                ${type.name}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 tab-content">
                    <ul>
                        <li>
                            <div class="col-md-7">
                                <div class="title">SSN2GSCC</div>
                                <div class="desc">Description:System Control and Communication Board </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">-</button>
                                            </span>
                                    <input type="text" class="form-control" placeholder="0">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">+</button>
                                            </span>
                                </div>
                            </div>
                            <div class="col-md-2"><button class="btn btn-default">Choose</button></div>
                        </li>
                        <li>
                            <div class="col-md-7">
                                <div class="title">SSN2GSCC</div>
                                <div class="desc">Description:System Control and Communication Board </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">-</button>
                                            </span>
                                    <input type="text" class="form-control" placeholder="0">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">+</button>
                                            </span>
                                </div>
                            </div>
                            <div class="col-md-2"><button class="btn btn-default">Choose</button></div>
                        </li>
                        <li>
                            <div class="col-md-7">
                                <div class="title">SSN2GSCC</div>
                                <div class="desc">Description:System Control and Communication Board </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">-</button>
                                            </span>
                                    <input type="text" class="form-control" placeholder="0">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">+</button>
                                            </span>
                                </div>
                            </div>
                            <div class="col-md-2"><button class="btn btn-default">Choose</button></div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="thumbnail">
                    <h3 class="text-center">${choosedCategory.name}</h3>
                    <img :src="choosedCategory._image" alt="">
                    <div class="boards">
                        <table class="table">
                            <tr>
                                <th>Board type</th>
                                <th>Board name</th>
                                <th>Qty</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Sysrtem Board</td>
                                <td>N4GSCC</td>
                                <td>2</td>
                                <td>DELETE</td>
                            </tr>
                        </table>
                    </div>
                    <div class="caption clearfix">
                        <p><a href="#" class="btn btn-o-success pull-left" role="button">Eliminate</a>
                            <a href="#" class="btn btn-o-success pull-right" role="button">Quote</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    
    var categories = '{{categorys|raw}}'?JSON.parse('{{categorys|raw}}'):[],
        board_types = '{{board_types|raw}}'?JSON.parse('{{board_types|raw}}'):[],
        fech_board_url = '{{fech_board_url}}';
        Vue.config.devtools = true
    new Vue({
        el:'#_configure',
        delimiters: ['${', '}'],
        data:{
            categories:categories,
            board_types:board_types,
            choosedType:board_types && board_types[0],
            choosedCategory:categories && categories[0],
            boards:{},
            showBoard:[]
        },
        methods:{
            selectCategory:function(choose){
                this.choosedCategory = choose;
            },
            selectType:function(choose){
                var _vm = this;
                _vm.choosedType = choose;
                if(_vm.boards[choose.id]){
                    _vm.showBoard = _vm.boards[choose.id];
                }else{
                    serviceGetBoard(choose.id,function(result){
                        _vm.boards[choose.id] = result;
                        _vm.showBoard = result;
                    });
                }
            }
        }
    })

    function serviceGetBoard(type_id,callback){
        if(type_id){
            $.post(fech_board_url,{
                border_type_id:type_id
            },function(result){
                callback(result)
            })
        }
    }

</script>
<?php echo $content_bottom ?>
<?php echo $footer; ?>