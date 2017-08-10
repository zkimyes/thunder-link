<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
        <li>
            <a href="http://localhost:8080/admin/index.php?route=commom/dashboard&amp;token=vEngFBN6BSJKoG5o6vCrbNwcsA2QPO52">
                    Home                    </a>
        </li>
        <li>
            <a href="javascript:;">Support Article</a>
        </li>
    </ul>
</div>
<?php echo $content_top ?>
<main class="main support">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <section style="border:0 none;">
                    <div class="doc-list-content">
                        <!--doc list start-->
                        {% for article in result%}
                        <div class="doc-list">
                            <div class="col-md-3">
                                <img src="{{article.thumb}}" alt="{{article.title}}">
                            </div>
                            <div class="col-md-9">
                                <div class="title"><a href="{{article.url|raw}}">{{article.title}}</a></div>
                                <div class="tags">
                                    Tags:{% for tag in article.tags%}<a href="">{{tag}}</a>{% endfor %}
                                </div>
                                <div class="desc">{{article.summary}}</div>
                                <div class="info">
                                    <span><i class="fa fa-eye"></i>500</span>
                                    <span><i class="fa fa-comments"></i>50</span>
                                    <span><i class="fa fa-share"></i></span>
                                </div>
                            </div>
                        </div>
                        {% endfor %} {% if not result %}
                        <div class="non-reuslt">
                            No Result
                        </div>
                        {% endif %}
                    </div>
                </section>

            </div>

            <div class="col-md-3">
                <div class="support-right-white su-mb10">
                    {% for sider_category in sider_categories %}
                    <div class="support-right-block">
                        <div class="title"><a href="{{sider_category.url|raw}}">{{sider_category.title}}</a></div>
                        <ul class="list-unstyled">
                            {% for child in sider_category['child'] %}
                            <li><a href="{{child.url|raw}}">{{child.title}}</a></li>
                            {% endfor %}
                        </ul>
                    </div>
                    {% endfor %}
                </div>
                <div class="support-right-white su-pd10 su-mb10">
                    <div class="s-title">Support Search</div>
                    <div class="input-group">
                        <input type="text" class="form-control" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
                <div class="support-right-white su-pd10">
                    <div class="s-title">Tags</div>
                    <div>
                        {% for tag in is_hot_tags%}
                            <a class="tag-t"
                                style="font-size:{{tag.hot_level*1.3+12}}px"
                            href="{{search_action|raw}}&search={{tag.name}}">{{tag.name}}</a>
                        {% endfor %}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    var searchUrl = '{{search_action|raw}}';
</script>
<?php echo $content_bottom ?>
<?php echo $footer; ?>