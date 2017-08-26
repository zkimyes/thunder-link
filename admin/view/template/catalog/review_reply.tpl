<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1>Reply Form</h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-body">
          <div class="media">
            <div class="media-body">
              <h3 class="media-heading">{{review_info.product}}</h3>
              <p><i class="fa fa-clock-o"></i> {{review_info.date_added}} &nbsp; <i class="fa fa-user"></i>  {{review_info.author}}</p>
              <div style="margin:10px 0;word-wrap: break-word;word-break: break-all;">
                {{review_info.text}}
              </div>
            </div>
          </div>
          {% for rep in reply%}
            <div class="panel">
                <div class="panel-heading"><i class="fa fa-clock-o"></i> {{rep.date_added}} &nbsp; <i class="fa fa-user"></i>  {{rep.author}}
                  <a class="btn btn-link" href="{{rep.delete_reply|raw}}"><i class="fa fa-remove"></i> 删除</a>
                </div>
                <div style="margin:10px;word-wrap: break-word;word-break: break-all;">
                    {{rep.content}}
                </div>
            </div>
          {% endfor %}
          <hr>
          <div class="panel">
              <h4>Reply:</h4>
              <form action="{{add_reply|raw}}" method="POST">
                  <input name="review_id" value="{{review_info.review_id}}" type="hidden">
                  <input name="product_id" value="{{review_info.product_id}}" type="hidden">
                  <textarea name="content" rows="10" class="form-control"></textarea>
              </form>
              
          </div>
          <div class="button-group">
            <a class="btn btn-default">返回</a>
            <button onclick="submit()" class="btn btn-primary">提交</button>
          </div>
      </div>
    </div>
  </div></div>

  <script>
    function submit(){
      $('form').submit();
    }
  </script>
<?php echo $footer; ?>
