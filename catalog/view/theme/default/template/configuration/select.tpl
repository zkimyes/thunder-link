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
                        <li v-for="board in showBoard">
                            <div class="col-md-7">
                                <div class="title">${board.name}</div>
                                <div class="desc">${board.content}</div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span v-if="board.type != 1" @click="board.quantity>0 && board.quantity--" class="input-group-btn">
                                        <button class="btn btn-default" type="button">-</button>
                                    </span>
                                    <input v-number-only v-if="board.type != 1" v-model.number="board.quantity" value="0" type="text" class="form-control" placeholder="0">
                                    <input v-if="board.type == 1" readonly class="form-control" v-model="board.quantity" type="text">
                                    <span v-if="board.type != 1" @click="board.quantity++" class="input-group-btn">
                                        <button class="btn btn-default" type="button">+</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2"><button @click="selectBoards(board)" class="btn btn-default">Choose</button></div>
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
                                <th>Action</th>
                            </tr>
                            <tr v-for="boards in selectedBoards">
                                <td style="vertical-align: middle;"><span>${boards.name}</span></td>
                                <td style="vertical-align: middle;"><span>${boards.name}</span></td>
                                <td style="vertical-align: middle;"><span>${boards.quantity||0}</span></td>
                                <td v-if="boards.type !=1"><a @click="removeBoards(boards)" class="btn btn-link"><i class="fa fa-remove"></i> Delete</a></td>
                            </tr>
                        </table>
                    </div>
                    <div class="caption clearfix">
                        <p><a @click="clearBoards()" class="btn btn-o-success pull-left" role="button">Eliminate</a>
                            <a @click="quote()" class="btn btn-o-success pull-right" role="button">Quote</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>
<script>
    
    var categories = '{{categorys|raw}}'?JSON.parse('{{categorys|raw}}'):[],
        board_types = '{{board_types|raw}}'?JSON.parse('{{board_types|raw}}'):[],
        boards = '{{board_list|raw}}'?JSON.parse('{{board_list|raw}}'):[],
        fech_board_url = '{{fech_board_url}}';
        Vue.config.devtools = true
    Vue.directive('numberOnly', {
        bind: function (el) {
            this.handler = function () {
                el.value = el.value.replace(/\D+/, '')
            }.bind(this)
            el.addEventListener('input', this.handler)
        },
        unbind: function (el) {
            el.removeEventListener('input', this.handler)
        }
    })
    new Vue({
        el:'#_configure',
        delimiters: ['${', '}'],
        data:{
            categories:categories,
            board_types:board_types,
            choosedType:board_types && board_types[0],
            choosedCategory:categories && categories[0],
            boards:{},
            showBoard:boards,
            selectedBoards:[]
        },
        methods:{
            selectCategory:function(choose){
                this.choosedCategory = choose;
                this.selectedBoards = [];
                this.showBoard.map(function(item){
                    item.quantity = 0;
                })
            },
            selectType:function(choose){
                var _vm = this;
                _vm.choosedType = choose;
                if(_vm.boards[choose.id]){
                    _vm.showBoard = _vm.boards[choose.id];
                }else{
                    serviceGetBoard(choose.id,function(result){
                        if(result){
                            _vm.showBoard = result;
                            _vm.boards[choose.id] = result;
                        }
                    });
                }
            },
            selectBoards:function(boards){
                var _vm = this;
                var _find = _vm.selectedBoards.find(function(item){
                    return item.id == boards.id
                })
                if(!_find){
                    _vm.selectedBoards.push(boards);
                }
            },
            removeBoards:function(boards){
                var _vm = this;
                var _filterBoars = _vm.selectedBoards.filter(function(item){
                    return item.id != boards.id
                })
                boards.quantity = 0;
                _vm.selectedBoards = _filterBoars;
            },
            clearBoards:function(){
                var _vm = this;
                var _filterBoars = _vm.selectedBoards.filter(function(item){
                    item.quantity = 0;
                    return item.type == 1;
                })
                _vm.selectedBoards = _filterBoars;
            },
            checkInput:function(model){
                var e = event || window.event;
                if(isNaN(e.target.value)){
                    model = 0;
                }
            },
            quote:function(){
                layer.msg('adasd');
            }
        }
    })

    function serviceGetBoard(type_id,callback){
        if(type_id){
            $.post(fech_board_url,{
                border_type_id:type_id
            },function(result){
                callback(result)
            },'json')
        }
    }

</script>
<?php echo $content_bottom ?>
<?php echo $footer; ?>