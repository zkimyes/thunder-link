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
                <h3 class="panel-title"><i class="fa fa-list"></i> All Categories List Seting</h3>
            </div>
            <div class="panel-body">
                <div class="table">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:5%">ID</th>
                                <th>Name</th>
                                <th style="width:20%;">Product</th>
                                <th>Banner Center</th>
                                <th>Banner Right Top</th>
                                <th>Banner Right Bottom</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for category in categories%}
                            <tr>
                                <td>{{category.category_id}}</td>
                                <td>{{category.name|raw}}</td>
                                <td>
                                   {{category.product_name|raw}}
                                </td>
                                <td>
                                    {{category.banner_center|raw}}
                                </td>
                                <td>
                                    {{category.banner_right_top|raw}}
                                </td>
                                <td>
                                    {{category.banner_right_bottom|raw}}
                                </td>
                                <td>
                                    <a href="{{edit_url|raw}}&category_id={{category.category_id}}" class="btn btn-xs btn-warning">编辑</a>
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
<?php echo $footer; ?>