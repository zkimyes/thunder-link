<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="{{add_url}}&token={{token}}" data-toggle="tooltip" title="Article Add" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h1>Support Article</h1>
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
                <h3 class="panel-title">
                    <i class="fa fa-list"></i>Article List</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td width='50%'>Title</td>
                                <td>Category</td>
                                <td>Image</td>
                                <td>位置</td>
                                <td>CreateAt</td>
                                <td class="text-right">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            {% for list in lists %}
                            <tr>
                                <td>{{list.id}}</td>
                                <td>{{list.title}}</td>
                                <td>{{list.category_name}}</td>
                                <td>
                                    <img src="{{list.thumb}}" alt="">
                                </td>
                                <td>
                                    <script>
                                        var a = "{{list.is_home}}".split(',');
                                        if (a.indexOf('1') >= 0) {
                                            document.write('<span class="label label-default">首页</span><br style="margin:5px 0"/>');
                                        }
                                        if (a.indexOf('2') >= 0) {
                                            document.write('<span class="label label-default">搜索页推荐</span><br style="margin:5px 0"/>');
                                        }
                                    </script>
                                </td>
                                <td>{{list.createAt}}</td>
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
                    <div class="col-sm-6 text-left"></div>
                    <div class="col-sm-6 text-right"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var delt = function (id) {
        $.post("{{delt_url|raw}}".replace("amp;", '') + '&token={{token}}', {
            selected: [id]
        }, function (data) {
            location.reload();
        }, 'json')
    }
</script>
<?php echo $footer; ?>