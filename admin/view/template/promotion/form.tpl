<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
            </div>
            <h1>
                {{heading_title}}
            </h1>
            <ul class="breadcrumb">
                <li>
                    <a></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i></h3>
            </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data" id="form-attribute">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td width="40"><input type="checkbox"></td>
                                    <td>product_name</td>
                                    <td>price</td>
                                    <td>condition</td>
                                    <td>option</td>
                                </tr>
                            </thead>
                            <tbody>
                                {% for list in lists %}
                                <tr>
                                    <td>{{list.id}}</td>
                                    <td>{{list.name}}</td>
                                    <td>{{list.condition}}</td>
                                    <td>{{list.date_end}}</td>
                                    <td><button class="btn btn-warning">编辑</button></td>
                                </tr>
                                {% endfor %}
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"></div>
                    <div class="col-sm-6 text-right"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>