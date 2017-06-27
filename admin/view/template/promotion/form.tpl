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
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" enctype="multipart/form-data" id="form-attribute">
                            <div class="form-group">
                                <label for="exampleInputEmail1">title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">condition</label>
                                <textarea class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">date_end</label>
                                <input type="date">
                            </div>
                        </form>
                    </div>
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