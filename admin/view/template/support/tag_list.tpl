<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="{{add_url}}&token={{token}}" data-toggle="tooltip" title="Tag Add" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            </div>
            <h1>Support Tags</h1>
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
                <h3 class="panel-title"><i class="fa fa-list"></i>Tag List</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td width="40">Id</td>
                                <td>Name</td>
                                <td width="200"><input id="is_search_checkall"  onchange="checkAll('is_search')" type="checkbox"> &nbsp;是否推荐搜索词
                                    &nbsp;<button onclick="saveChecked('is_search')" class="btn btn-xs btn-primary">保存</button>
                                </td>
                                <td width="200"><input id="is_hot_checkall" onchange="checkAll('is_hot')" type="checkbox"> &nbsp;是否推荐热搜词
                                    &nbsp;<button onclick="saveChecked('is_hot')" class="btn btn-xs btn-primary">保存</button>
                                    <div class="hot_level_tips">1到10个级别对应标签的大小<div>
                                </td>
                                <td width="150">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            {% for list in lists %}
                            <tr>
                                <td>{{list.id}}</td>
                                <td>{{list.name}}</td>
                                <td>
                                    
                                    <input onchange="checkAll()"
                                        {% if list.is_search == 1%}
                                            checked
                                        {% endif %}
                                        name="is_search[]" value="{{list.id}}" type="checkbox">
                                </td>
                                <td>
                                    <input onchange="checkAll()" 
                                        {% if list.is_hot == 1%}
                                            checked
                                        {% endif %}
                                    name="is_hot[]" value="{{list.id}}" type="checkbox">
                                    <div class="hot_level"
                                         {% if list.is_hot == 1%}
                                            style="display:block"
                                        {% endif %}
                                    >
                                        级别：<select>
                                            {% for item in [1,2,3,4,5,6,7,8,9,10]%}
                                            <option 
                                                {% if list.hot_level == item%}
                                                    selected
                                                {% endif %}
                                            value="{{item}}">{{item}}</option>
                                            {% endfor %}
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button onclick="delt('{{list.id}}')" class="btn btn-danger btn-xs">删除</button>
                                    <a href="{{update_url|raw}}&id={{list.id}}&token={{token}}" class="btn btn-info btn-xs">更新</a>
                                </td>
                            </tr>

                            {% endfor %}
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var delt = function(id) {
        $.post("{{delt_url|raw}}".replace("amp;", '') + '&token={{token}}', {
            selected: [id]
        }, function(data) {
            location.reload();
        }, 'json')
    };

    if($('input[name^=is_search]:checked').length == $('input[name^=is_search]').length){
        $('#is_search_checkall')[0].checked=true;
    }

    if($('input[name^=is_hot]:checked').length == $('input[name^=is_hot]').length){
        $('#is_hot_checkall')[0].checked=true;
    }

    var checkAll = function(name){
        var e = event || window.event;
        if(name){
            if(e.target.checked){
                $('input[name^='+name+'').each(function(){
                    this.checked = true;
                });
                if(name == 'is_hot'){
                    $('input[name^='+name+'').next('.hot_level').show();
                    $('.hot_level_tips').show();
                }
            }else{
                $('input[name^='+name+'').each(function(){
                    this.checked = false;
                })
                if(name == 'is_hot'){
                    $('input[name^='+name+'').next('.hot_level').hide();
                    $('.hot_level_tips').hide();
                }
            }
        }else{
            var _name = $(e.target).attr('name');
            if(!e.target.checked){
                if(_name){
                    $('#'+_name.replace('[]','')+'_checkall')[0].checked = false;
                }
                if(_name == 'is_hot[]'){
                    $(e.target).next('.hot_level').hide();
                }
            }else{
                if(_name == 'is_hot[]'){
                    $(e.target).next('.hot_level').show();
                    $('.hot_level_tips').show();
                }
            }
        }
    }

    var saveChecked = function(name){
        var data = {};
        if(name == 'is_search'){
            data.attr = 'is_search';
            data.selected = [];
            $('input[name^=is_search]').each(function(key,item){
                data.selected[key] = {
                    id:item.value,
                    checked:item.checked?1:0
                };
            })
        }else{
            data.attr = 'is_hot';
            data.selected = [];
             $('input[name^=is_hot]').each(function(key,item){
                data.selected[key] = {
                    id:item.value,
                    checked:item.checked?1:0,
                    level:$(item).next('.hot_level').find('select').val()
                };
            })
        }
        $.post("{{save_attr|raw}}".replace("amp;", '') + '&token={{token}}',data,function(res){
            if(res){
                location.reload();
            }
        },'json');
    }
</script>
<?php echo $footer; ?>