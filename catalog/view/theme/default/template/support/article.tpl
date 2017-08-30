<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main bg-white contact_us">
    <div class="container">
        <div class="solution-content-article">
            <div class="article-header">
                <h1>{{article.title}}</h1>
            </div>
            <div class="article-body">
                {{article.content|raw}}
            </div>
            {% if related_products %}
            <table class="table">
                <thead style="background:#f1f1f1;">
                    <tr>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Model</td>
                        <td></td>
                    </tr>
                </thead>
                {% for product in related_products %}
                <tr>
                    <td>{{product.name}}</td>
                    <td>{{product.price}}</td>
                    <td>{{product.model}}</td>
                    <td><a class="btn btn-o-success" href=""><i class="fa fa-shopping-cart"></i> Add To Cart</a></td>
                </tr>
                {% endfor %}
            </table>

            {% endif %} {% if article.is_comment == 1 %}
            <div class="row">
                <div class="panel-heading">
                    <h4>Comments</h4>
                </div>
                <div class="panel-body">
                    {% for comment in comments %}
                    <div class="media">
                        <div><i class="fa fa-user"></i> {{comment.arthor}} publish at <i class="fa fa-clock-o"></i> {{comment.createAt}}</div>
                        <div class="media-body">
                            {{comment.content|raw}}
                        </div>
                    </div>
                    {% endfor %}

                    <div id="comment">
                        <div>Comment</div>
                        <textarea v-model="comment" class="form-control"></textarea>
                        <div class="btn-group"><button @click="submit()" class="btn btn-primary">submit</button></div>
                    </div>
                </div>
            </div>
            {% endif %}
        </div>
    </div>
</main>
<script>
    Vue.config.devtools = true
    var comment = new Vue({
        el:"#comment",
        data:{
            comment:''
        },
        methods:{
            submit:function(){
                var _vm = this;
                if(_vm.comment.length == ''){
                    return layer.msg('请输入内容');
                }
                $.post('{{add_comments|raw}}',{
                    article_id:'{{article.id}}',
                    content:_vm.comment
                },function(res){
                    console.log(res)
                },'json')
            }
        }
    })
</script>
<?php echo $content_bottom ?>
<?php echo $footer; ?>