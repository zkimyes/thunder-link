<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <div class="table-responsive">
            {% for review in reviews %}
              <div>
                <h3>{{review.name}}</h3>
                <div class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object" src="{{review.image|raw}}" alt="{{review.name}}">
                      </a>
                    </div>
                    <div class="media-body">
                      <div class="rating">
                        {% for rat in 0..review.rating%}
                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                        {% endfor %}
                      </div>
                      <div style="word-wrap:break-word;word-break:break-all;">
                          {{review.text}}
                      </div>
                      <div class="reply">
                         {% for rep in review.reply%}
                          <div style="margin:10px 0;border:1px #ddd solid;padding:10px;word-wrap:break-word;word-break:break-all;">
                            <div>From:<i class="fa fa-user"></i>  {{rep.author}}<br><i class="fa fa-clock-o"></i> {{rep.date_added}} &nbsp; </div>
                            {{rep.content}}
                            <div class="text-right">
                              <a class="reply_btn" data-target-id="reply_{{rep.review_id}}"><i class="fa fa-reply"></i> Reply</a>
                            </div>
                            <div style="display:none"  id="reply_{{rep.review_id}}" class="textarea">
                                <textarea onkeydown="handelTypeing(this)" class="form-control" cols="30" rows="8"></textarea>
                                <div style="margin:5px 0" class="button-group text-right">
                                  <button disabled onclick="send" class="btn btn-primary"><i class="fa fa-send-o"></i> &nbsp; Send</button>
                                </div>
                            </div>
                          </div>
                         {% endfor %}
                      </div>
                    </div>
                  </div>
              </div>
            {% endfor %}
      </div>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script>
    $('.reply_btn').on('click',function(){
      var _id = $(this).data('target-id');
          $('#'+_id).show();
    });
    function handelTypeing(tagret){
      var _value = $(tagret).val(),
          e = event||window.event;
          if(_value.length == 0){
            handelDisable($(tagret).next().find('button'));
          }
    }

    function handelDisable(btn){
      if(btn.attr('disabled')){
        btn.removeAttr('disabled')
      }else{
        btn.attr('disabled',true)
      }
    }

    function sendReply(target){
      var _textarea = $(target).parent().prev('textarea');
      $.post('{{reply_url|raw}}'.replace('&amp;','&'),{
        reivew_id:1,
        content:''
      })
    }
</script>
<?php echo $footer; ?>