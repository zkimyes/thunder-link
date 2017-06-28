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
                                <label>title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="title">
                            </div>
                            <div class="form-group">
                                <label>condition</label>
                                <textarea placeholder="dddd" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label>product</label>
                                <select class="form-control">
                                    <option value="">--select--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="input-date-available">date_end</label>
                                <div class="input-group date">
                                    <input type="text" name="date_available" value="" placeholder="asdas" data-date-format="YYYY-MM-DD" id="input-date-available" class="form-control" />
                                    <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                </div>
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
<script>
    $('.date').datetimepicker({
        pickTime: false
    });
</script>
<?php echo $footer; ?>