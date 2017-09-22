<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <a href="<?php echo $repair; ?>" data-toggle="tooltip" title="<?php echo $button_rebuild; ?>" class="btn btn-default"><i class="fa fa-refresh"></i></a>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1>
                <?php echo $heading_title; ?>
            </h1>
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
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>
            <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i>
            <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i>
                    <?php echo $text_list; ?>
                </h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-category">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td>ID</td>
                                    <td class="text-left">
                                        <?php if ($sort == 'name') { ?>
                                        <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>">
                                            <?php echo $column_name; ?>
                                        </a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_name; ?>">
                                            <?php echo $column_name; ?>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-right">
                                        <?php if ($sort == 'sort_order') { ?>
                                        <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>">
                                            <?php echo $column_sort_order; ?>
                                        </a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_sort_order; ?>">
                                            <?php echo $column_sort_order; ?>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-right">
                                        <?php echo $column_action; ?>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($categories) { ?>
                                <?php foreach ($categories as $category) { ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if (in_array($category['category_id'], $selected)) { ?>
                                        <input type="checkbox" name="selected[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                                        <?php } else { ?>
                                        <input type="checkbox" name="selected[]" value="<?php echo $category['category_id']; ?>" />
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $category['category_id'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?php echo $category['name']; ?>
                                    </td>
                                    <td class="text-right">
                                        <?php echo $category['sort_order']; ?>
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-link" href="<?php echo $category['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>">编辑</a>
                                        <a class="btn btn-link" data-categoryId="<?php echo $category['category_id']; ?>" data-toggle="modal" data-target="#tab-solution">绑定菜单solution</a>
                                        <a class="btn btn-link" data-categoryId="<?php echo $category['category_id']; ?>" data-toggle="modal" data-target="#tab-menu-ads">绑定菜单广告</a>
                                        <a class="btn btn-link" data-categoryId="<?php echo $category['category_id']; ?>" data-toggle="modal" data-target="#tab-ads">绑定all category页面广告和产品</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="4">
                                        <?php echo $text_no_results; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <?php echo $pagination; ?>
                    </div>
                    <div class="col-sm-6 text-right">
                        <?php echo $results; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 目录上关联的广告 -->
<div class="modal fade" id="tab-menu-ads" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">绑定菜单广告</h4>
            </div>
            <div class="modal-body row">
                <!--目录上的广告-->
                <div class="col-md-6">
                    <div>
                        <p>三个小广告1</p>
                        <div class="search-box">
                            <input class="form-control" v-model="searchText1" placeholder="输入名字搜索广告..." type="text">
                            <div v-if="loading && position == 1">${loading}</div>
                            <ul class="autocompelet-list">
                                <li @click="selete(result)" v-if="position == 1" v-for="result in search_result">${result.name}</li>
                            </ul>
                        </div>
                        <div class="result well">
                            <div v-if="banner1" class="checked"><i class="fa fa-remove"></i> ${banner1.name}</div>
                        </div>
                    </div>
                    <div>
                        <p>三个小广告2</p>
                        <div class="search-box">
                            <input class="form-control" v-model="searchText2" placeholder="输入名字搜索广告..." type="text">
                            <div v-if="loading && position == 2">${loading}</div>
                            <ul class="autocompelet-list">
                                <li @click="selete(result)" v-if="position == 2" v-for="result in search_result">${result.name}</li>
                            </ul>
                        </div>
                        <div class="result well">
                            <div v-if="banner2" class="checked"><i class="fa fa-remove"></i> ${banner2.name}</div>
                        </div>
                    </div>
                    <div>
                        <p>三个小广告3</p>
                        <div class="search-box">
                            <input class="form-control" v-model="searchText3" placeholder="输入名字搜索广告..." type="text">
                            <div v-if="loading && position == 3">${loading}</div>
                            <ul class="autocompelet-list">
                                <li @click="selete(result)" v-if="position == 3" v-for="result in search_result">${result.name}</li>
                            </ul>
                        </div>
                        <div class="result well">
                            <div v-if="banner3" class="checked"><i class="fa fa-remove"></i> ${banner3.name}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p>右侧大广告</p>
                    <div class="search-box">
                        <input class="form-control" v-model="searchText4" placeholder="输入名字搜索广告..." type="text">
                        <div v-if="loading && position == 4">${loading}</div>
                        <ul class="autocompelet-list">
                            <li @click="selete(result)" v-if="position == 4" v-for="result in search_result">${result.name}</li>
                        </ul>
                    </div>
                    <div class="result well">
                        <div v-if="banner4" class="checked"><i class="fa fa-remove"></i> ${banner4.name}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-save btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- all category页面的设置 -->
<div class="modal fade" id="tab-ads" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">all category页面广告和产品</h4>
            </div>
            <div class="modal-body row">

                <!--all category 页面关联的广告-->
                <div class="col-md-6">
                    <div>
                        <p>all category 页面中部大图广告</p>
                        <div class="search-box">
                            <input class="form-control" v-model="searchText1" placeholder="输入广告标题搜索..." type="text">
                            <div v-if="loading && type == 1">${loading}</div>
                            <ul class="autocompelet-list">
                                <li @click="selete(result)" v-if="type == 1" v-for="result in search_result">${result.name}</li>
                            </ul>
                        </div>
                        <div class="result well">
                            <div v-if="banner1" class="checked"><i class="fa fa-remove"></i> ${banner1.name}</div>
                        </div>
                    </div>
                    <div>
                        <p>all category 页面中部关联的产品</p>
                        <div class="search-box">
                            <input class="form-control" v-model="searchText" placeholder="输入名字搜索产品..." type="text">
                            <div v-if="loading && type == 4">${loading}</div>
                            <ul class="autocompelet-list">
                                <li @click="selete(result)" v-if="type == 4" v-for="result in search_result">${result.name}</li>
                            </ul>
                        </div>
                        <div class="result well">
                            <div v-if="product" class="checked"><i class="fa fa-remove"></i> ${product.name}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <p>all category 页面右侧小图广告上</p>
                        <div class="search-box">
                            <input class="form-control" v-model="searchText2" placeholder="输入广告标题搜索..." type="text">
                            <div v-if="loading && type == 2">${loading}</div>
                            <ul class="autocompelet-list">
                                <li @click="selete(result)" v-if="type == 2" v-for="result in search_result">${result.name}</li>
                            </ul>
                        </div>
                        <div class="result well">
                            <div v-if="banner2" class="checked"><i class="fa fa-remove"></i> ${banner2.name}</div>
                        </div>
                    </div>

                    <div>
                        <p>all category 页面右侧小图广告下</p>
                        <div class="search-box">
                            <input class="form-control" v-model="searchText3" placeholder="输入广告标题搜索..." type="text">
                            <div v-if="loading && type == 3">${loading}</div>
                            <ul class="autocompelet-list">
                                <li @click="selete(result)" v-if="type == 3" v-for="result in search_result">${result.name}</li>
                            </ul>
                        </div>
                        <div class="result well">
                            <div v-if="banner3" class="checked"><i class="fa fa-remove"></i> ${banner3.name}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-save  btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--目录上关联的解决方案-->
<div class="modal fade" id="tab-solution" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">绑定菜单solution</h4>
            </div>
            <div class="modal-body">

                <div class="search-box">
                    <input class="form-control" v-model="searchText" placeholder="输入标题搜索解决方案..." type="text">
                    <div v-if="loading">${loading}</div>
                    <ul class="autocompelet-list">
                        <li @click="selectSoltuion(result)" v-for="result in search_result">${result.title}</li>
                    </ul>
                </div>
                <div class="result well">
                    <div v-for="so in solution" @click="remove(so)" title="点击清除" class="checked"><i class="fa fa-remove"></i> ${so.title}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-save btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
  $(function(){
    Vue.config.devtools = true;
    category_id = null;
    var solutonA = new Vue({
        el: '#tab-solution',
        delimiters: ['${', '}'],
        data: {
            solution: [],
            searchText: '',
            loading: '',
            search_result: []
        },
        watch: {
            searchText: function(newText) {
                if (newText) {
                    this.loading = '搜索中...'
                    this.search()
                }else{
                  this.loading = ''
                }
            }
        },
        methods: {
            selectSoltuion: function(solution) {
                this.solution && this.solution.length < 3 && this.solution.push(solution) || layer.msg('最多选择3个solution')
                this.search_result = []
                this.searchText = ''
                this.loading = ''
            },
            search: _.debounce(function() {
                var _vm = this;
                $.post('{{get_solution}}&token={{token}}', {
                    name: _vm.searchText
                }, function(res) {
                    if (res) {
                        _vm.loading = ''
                        _vm.search_result = res.rows
                    }
                }, 'json')
            }, 500),
            remove:function(item){
                this.solution = this.solution.filter(function(ch){
                    return ch.id != item.id
                })
            }
        }
    });


    var adsInMenu = new Vue({
        el: '#tab-menu-ads',
        delimiters: ['${', '}'],
        data: {
            banner1: null,
            banner2: null,
            banner3: null,
            banner4: null,
            searchText1: '',
            searchText2: '',
            searchText3: '',
            searchText4: '',
            position: 1,
            loading: '',
            search_result: []
        },
        watch: {
            searchText1: function(newText) {
                if (newText) {
                    this.loading = '搜索中...'
                    this.position = 1
                    this.search()
                }
            },
            searchText2: function(newText) {
                if (newText) {
                    this.loading = '搜索中...'
                    this.position = 2
                    this.search()
                }
            },
            searchText3: function(newText) {
                if (newText) {
                    this.loading = '搜索中...'
                    this.position = 3
                    this.search()
                }
            },
            searchText4: function(newText) {
                if (newText) {
                    this.loading = '搜索中...'
                    this.position = 4
                    this.search()
                }
            }
        },
        methods: {
            selete: function(banner) {
                this.search_result = []

                this.loading = ''
                switch (this.position) {
                    case 1:
                        this.searchText1 = ''
                        this.banner1 = banner
                        break;
                    case 2:
                        this.searchText2 = ''
                        this.banner2 = banner
                        break;
                    case 3:
                        this.searchText3 = ''
                        this.banner3 = banner
                        break;
                    case 4:
                        this.searchText4 = ''
                        this.banner4 = banner
                        break;
                }
            },
            search: _.debounce(function() {
                var _vm = this,
                    _name = '';
                switch (this.position) {
                    case 1:
                        _name = _vm.searchText1
                        break
                    case 2:
                        _name = _vm.searchText2
                        break
                    case 3:
                        _name = _vm.searchText3
                        break
                    case 4:
                        _name = _vm.searchText4
                }
                $.post('{{get_banner}}&token={{token}}', {
                    name: _name
                }, function(res) {
                    if (res) {
                        _vm.loading = ''
                        _vm.search_result = res.rows
                    }
                }, 'json')
            }, 500)
        }
    });

    var bannerInAllCategory = new Vue({
        el: '#tab-ads',
        delimiters: ['${', '}'],
        data: {
            banner1: '{{all_category_banner_center}}' ? JSON.parse('{{all_category_banner_center|raw}}') : null,
            banner2: '{{all_category_banner_right_top}}' ? JSON.parse('{{all_category_banner_right_top|raw}}') : null,
            banner3: '{{all_category_banner_right_bottom}}' ? JSON.parse('{{all_category_banner_right_bottom|raw}}') : null,
            product: '{{all_category_product_id}}' ? JSON.parse('{{all_category_product_id|raw}}') : null,
            type: 1,
            searchText: '',
            searchText1: '',
            searchText2: '',
            searchText3: '',
            loading: '',
            search_result: []
        },
        watch: {
            searchText: function(newText) {
                if (newText) {
                    this.loading = '搜索中...'
                    this.type = 4
                    this.search()
                }
            },
            searchText1: function(newText) {
                if (newText) {
                    this.loading = '搜索中...'
                    this.type = 1
                    this.search()
                }
            },
            searchText2: function(newText) {
                if (newText) {
                    this.loading = '搜索中...'
                    this.type = 2
                    this.search()
                }
            },
            searchText3: function(newText) {
                if (newText) {
                    this.loadings = '搜索中...'
                    this.type = 3
                    this.search()
                }
            }
        },
        methods: {
            selete: function(select) {
                this.search_result = []
                this.searchText = ''
                this.loading = ''
                switch (this.type) {
                    case 1:
                        this.banner1 = select
                        break;
                    case 2:
                        this.banner2 = select
                        break;
                    case 3:
                        this.banner3 = select
                        break;
                    case 4:
                        this.product = select
                        break;
                }
            },
            search: _.debounce(function(type) {
                var _vm = this;
                if (_vm.type == 4) {
                    $.post('{{get_product}}&token={{token}}', {
                        name: _vm.searchText
                    }, function(res) {
                        if (res) {
                            _vm.loading = ''
                            _vm.search_result = res.rows
                        }
                    }, 'json')
                } else {
                    $.post('{{get_banner}}&token={{token}}', {
                        name: _vm.searchText
                    }, function(res) {
                        if (res) {
                            _vm.loading = ''
                            _vm.search_result = res.rows
                        }
                    }, 'json')
                }
            }, 500)
        }
    })


    $('#tab-solution').on('show.bs.modal', function (event) {
      if(event && event.relatedTarget){
        category_id = event.relatedTarget.dataset.categoryid;
        $.post('{{getSolutionByCategory|raw}}&token={{token}}',{
          category_id:category_id
        },function(res){
          if(res.status == 'success'){
            solutonA.$data.solution = res.data.rows
          }
        },'json')
      }
    });

    $('#tab-solution .btn-save').on('click',function(){
        if(solutonA.$data.solution.length == 0){
          return layer.msg('至少选择一个解决方案');
        }
        $.post('{{save_solutions}}&token={{token}}',{
          category_id:category_id,
          solutions:solutonA.$data.solution.map(function(item){
            return item.id
          })
        },function(res){
            if(res){
              $('#tab-solution').modal('hide');
            }
        })
    })


    $('#tab-solution').on('show.bs.modal', function (event) {
      if(event && event.relatedTarget){
        category_id = event.relatedTarget.dataset.categoryid;
        $.post('{{getSolutionByCategory|raw}}&token={{token}}',{
          category_id:category_id
        },function(res){
          if(res.status == 'success'){
            solutonA.$data.solution = res.data.rows
          }
        },'json')
      }
    });

    $('#tab-solution .btn-save').on('click',function(){
        if(solutonA.$data.solution.length == 0){
          return layer.msg('至少选择一个解决方案');
        }
        $.post('{{save_solutions}}&token={{token}}',{
          category_id:category_id,
          solutions:solutonA.$data.solution.map(function(item){
            return item.id
          })
        },function(res){
            if(res){
              $('#tab-solution').modal('hide');
            }
        })
    })


    $('#tab-menu-ads').on('show.bs.modal', function (event) {
      if(event && event.relatedTarget){
        category_id = event.relatedTarget.dataset.categoryid;
        $.post('{{getMenuAdsByCategory|raw}}&token={{token}}',{
          category_id:category_id
        },function(res){
          if(res.status == 'success'){
            adsInMenu.$data.banner4 = res.data.rows[0] || null
            adsInMenu.$data.banner1 = res.data.rows[1] || null
            adsInMenu.$data.banner2 = res.data.rows[2] || null
            adsInMenu.$data.banner3 = res.data.rows[3] || null
          }
        },'json')
      }
    })


    $('#tab-menu-ads .btn-save').on('click',function(){
       
        $.post('{{save_menu_category}}&token={{token}}',{
          category_id:category_id,
          banner_big:adsInMenu.$data.banner4.banner_id,
          banner_product_1:adsInMenu.$data.banner1.banner_id,
          banner_product_2:adsInMenu.$data.banner2.banner_id,
          banner_product_3:adsInMenu.$data.banner3.banner_id
        },function(res){
            if(res){
              $('#tab-menu-ads').modal('hide');
            }
        })
    })



    $('#tab-ads').on('show.bs.modal', function (event) {
      if(event && event.relatedTarget){
        category_id = event.relatedTarget.dataset.categoryid;
        $.post('{{getAllCategoryByCategory|raw}}&token={{token}}',{
          category_id:category_id
        },function(res){
          if(res.status == 'success'){
            bannerInAllCategory.$data.product = res.data.rows[0] || null
            bannerInAllCategory.$data.banner1 = res.data.rows[1] || null
            bannerInAllCategory.$data.banner2 = res.data.rows[2] || null
            bannerInAllCategory.$data.banner3 = res.data.rows[3] || null
          }
        },'json')
      }
    })


    $('#tab-ads .btn-save').on('click',function(){
       
        $.post('{{save_all_category}}&token={{token}}',{
          category_id:category_id,
          all_category_product_id:bannerInAllCategory.$data.product.product_id,
          all_category_banner_center:bannerInAllCategory.$data.banner1.banner_id ||bannerInAllCategory.$data.banner1.product_id,
          all_category_banner_right_top:bannerInAllCategory.$data.banner2.banner_id ||bannerInAllCategory.$data.banner2.product_id,
          all_category_banner_right_bottom:bannerInAllCategory.$data.banner3.banner_id || bannerInAllCategory.$data.banner3.product_id
        },function(res){
            if(res){
              $('#tab-ads').modal('hide');
            }
        })
    })


  })

</script>
<?php echo $footer; ?>