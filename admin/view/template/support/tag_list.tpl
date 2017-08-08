<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="{{add_url}}&token={{token}}" data-toggle="tooltip" title="Article Add" class="btn btn-primary"><i class="fa fa-plus"></i></a></div>
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
                                <td>Id</td>
                                <td width='50%'>Name</td>
                                <td class="text-right">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            {% for list in lists %}
                            <tr>
                                <td>{{list.id}}</td>
                                <td>{{list.name}}</td>
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
    }
</script>
<?php echo $footer; ?>