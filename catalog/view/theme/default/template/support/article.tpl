<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main bg-white contact_us">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="solution-content-article">
                    <div class="article-header">
                        <h1 class="text-center">{{article.title}}</h1>
                    </div>
                    <div class="article-body mtt30">
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
                            <td>
                                <a class="btn btn-o-success" href="">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart</a>
                            </td>
                        </tr>
                        {% endfor %}
                    </table>

                    {% endif %} {% if article.is_comment == 123456 %}
                    <div class="row">
                        <div class="panel-heading">
                            <h3>Comments</h3>
                        </div>
                        <div class="panel-body">
                            {% for comment in comments %}
                            <div class="media">
                                <div>
                                    <i class="fa fa-user"></i> {{comment.arthor}} publish at
                                    <i class="fa fa-clock-o"></i> {{comment.createAt}}</div>
                                <div class="media-body">
                                    {{comment.content|raw}}
                                </div>
                            </div>
                            {% endfor %}

                            <div id="comment">
                                <div>Comment</div>
                                <textarea v-model="comment" class="form-control"></textarea>
                                <div class="btn-group">
                                    <button @click="submit()" class="btn btn-primary">submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {% endif %} {% if related_articles %}
                    <h4>Related Articles</h4>
                    <div class="row">
                        {% for rartilce in related_articles %}
                        <div class="col-md-4">
                            <div>
                                <a href="{{rartilce.link}}">
                                    <img src="{{rartilce.thumb}}" alt="{{rartilce.title}}">
                                </a>
                            </div>
                            <div>
                                <a href="{{rartilce.link}}">{{rartilce.title}}</a>
                            </div>
                        </div>
                        {% endfor %}
                    </div>
                    {% endif %}
                </div>
            </div>
            <div class="col-md-4">
                <?php echo $column_right ?>
            </div>
        </div>
    </div>


</main>
<script>
    Vue.config.devtools = true
    var comment = new Vue({
        el: "#comment",
        data: {
            comment: ''
        },
        methods: {
            submit: function () {
                var _vm = this;
                if (_vm.comment.length == '') {
                    return layer.msg('请输入内容');
                }
                $.post('{{add_comments|raw}}', {
                    article_id: '{{article.id}}',
                    content: _vm.comment
                }, function (res) {
                    if (res) {
                        location.reload();
                    }
                }, 'json')
            }
        }
    })
</script>
<?php echo $content_bottom ?>
<?php echo $footer; ?>