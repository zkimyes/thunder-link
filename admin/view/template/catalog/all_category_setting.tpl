<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
            </div>
            <h1>All Categories List Setting</h1>
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
                <h3 class="panel-title"><i class="fa fa-list"></i> All Categories List Setting</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-category">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width:5%">ID</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Banner Center</th>
                                    <th>Banner Right Top</th>
                                    <th>Banner Right Bottom</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories">
                                    <td>${category.category_id}</td>
                                    <td>${category.name|unscape}</td>
                                    <td>
                                        <div v-if="category.product_id != ''">
                                            <input class="form-control" type="text">
                                            <ul class="related">
                                                <li>asdasd</li>
                                            </ul>
                                        </div>
                                        <div v-else>${category.product_id}</div>
                                    </td>
                                    <td>
                                        <div v-if="category.banner_center != ''">
                                            <input class="form-control" type="text">
                                        </div>
                                        <div v-else>${category.banner_center}</div>
                                    </td>
                                    <td>
                                        <div v-if="category.banner_right_top != ''">
                                            <input class="form-control" type="text">
                                        </div>
                                        <div v-else>${category.banner_right_top}</div>
                                    </td>
                                    <td>
                                        <div v-if="category.banner_right_bottom != ''">
                                            <input class="form-control" type="text">
                                        </div>
                                        <div v-else>${category.banner_right_bottom}</div>
                                    </td>
                                </tr>
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
<script>
    Vue.config.devtools = true
    var categories = JSON.parse('{{categories|raw}}');
    Vue.filter("unscape", function(value) {
        return _.unescape(value);
    })

    var delt = function(id) {
        $.post("{{delt_url|raw}}".replace("amp;", '') + '&token={{token}}', {
            selected: [id]
        }, function(data) {
            location.reload();
        }, 'json')
    }
    var solution = new Vue({ 
        delimiters: ['${', '}'],
        el: '#content',
        data: {
            categories: categories
        },
        methods: {
            searchProduct: _.debounce(function() {
                var _vm = this;
                _vm.isAjax = true;
                $.get('{{product_search_url|raw}}&token={{token}}', {
                    search: _vm.product_search
                }, function(res) {
                    _vm.isAjax = false;
                    if (res.products) {
                        _vm.products = res.products
                    }
                }, 'json')
            }, 500),
        }
    })
</script>
<?php echo $footer; ?>