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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <div>asdasdasd</div>
                </div>
                <div class="form-group">
                    <label>关联产品</label>
                    <div style="position:relative">
                        <input type="text" value="" placeholder="输入名字搜索,按@显示所有产品..." v-model="product_search" @input="searchProduct()" class="form-control" />
                        <ul class="dropdown-menu" v-if="product_search != ''" style="left:0;top:32px;display:block;">
                            <li @click="chooseProduct(product)" v-for="product in products"><a href="javascript:;">${product.name}</a>
                            </li>
                            <li style="text-indent:2em" v-if="isAjax">搜索中...</li>
                            <li style="text-indent:2em;" v-if="isAjax == false && product_search != '' && products.length ==0">没有结果</li>
                        </ul>
                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                            <div v-if="link_product">
                                <div class="col-md-3">
                                    <img :src="link_product.thumb" alt="">
                                </div>
                                <div class="col-md-6"><strong>${link_product.name}</strong></div>
                                <div class="col-md-2"><button @click="removeRelatedProduct()" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Banner Center</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Banner Right Top</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Banner Right Bottom</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{back_url|raw}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>