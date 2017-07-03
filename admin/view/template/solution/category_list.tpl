<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $url->link('solution/category/add'); ?>" data-toggle="tooltip" title="Category Add" class="btn btn-primary"><i class="fa fa-plus"></i></a></div>
      <h1>Solution Category</h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
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
                <td style="width: 1px;" class="text-center"><input type="checkbox"/></td>
                <td>title</td>
                <td>link</td>
                <td class="text-right">Actions</td>
              </tr>
            </thead>
            <tbody>
                <tr v-for="list in category">
                    <td><input type="checkbox"/></td>
                    <td>${list.name}</td>
                    <td>${list.link}</td>
                    <td> 
                      <button class="btn btn-danger btn-xs">删除</button>
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
        $.post("{{delt_url|raw}}".replace("amp;", ''), {
            id: id
        }, function(data) {
            if (data.return) {
            }
        }, 'json')
    }
    var solution = new Vue({
        delimiters: ['${', '}'],
        el: '#content',
        data: {
            category: category,
            id: null
        },
        methods: {
            delt: function(id) {
                this.id = id;
                delt(id);
            },
            update: function(id) {
                location.href = "{{update_url|raw}}&id=" + id+"&token={{token}}";
            }
        }
    })
</script>
<?php echo $footer; ?> 
