<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="{{add_url}}&token={{token}}" data-toggle="tooltip" title="Category Add" class="btn btn-primary"><i class="fa fa-plus"></i></a></div>
            <h1>Solution Category</h1>
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
                <h3 class="panel-title"><i class="fa fa-list"></i>Category List</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center"><input @click="checkAll()" type="checkbox" /></td>
                                <td>Name</td>
                                <td width="200" class="text-right">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in category">
                                <td><input :checked="checked" type="checkbox" /></td>
                                <td>${list.title}</td>
                                <td>
                                    <button @click="delt(list.id)" class="btn btn-danger btn-xs">删除</button>
                                    <button @click="update(list.id)" class="btn btn-info btn-xs">更新</button>
                                </td>
                            </tr>
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
    Vue.config.devtools = true
    var category = JSON.parse('{{lists|raw}}');

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
            category: category,
            id: null,
            checked: false
        },
        methods: {
            delt: function(id) {
                this.id = id;
                delt(id);
            },
            checkAll: function() {
                this.checked = window.event.target.checked
            },
            update: function(id) {
                location.href = "{{update_url|raw}}&id=" + id + "&token={{token}}";
            }
        }
    })
</script>
<?php echo $footer; ?>