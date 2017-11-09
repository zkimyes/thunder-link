<?php echo $header; ?>
<?php echo $content_top ?>
<script>
    var activeWindow = 'support';
</script>
<main class="main support">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <section>
                    <div class="title">Support Services <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.
                    <div class="support-search input-group input-group-lg">
                        <input type="text" id="support_search" class="form-control" name="keyword" value="{{support_search}}" placeholder="VPN Client drivers,firmware,NOS,and application software">
                        <span class="input-group-btn">
                            <button id="support_search_btn" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </span>
                    </div>
                    <div class="support-search-hot-tag">
                         {% for tag in is_search_tags %}
                               <a {% if support_search == tag.name %}
                                    class="tag label label-default checked"
                                    {% else %}
                                    class="tag label label-default"
                                {% endif %}
                            href="{{search_action|raw}}&keyword={{tag.name}}">{{tag.name}}</a>
                        {% endfor %}
                    </div>
                </section>
                <div id="loading" style="display:none;background:#aeb0af;line-height: 50%;text-align: center;" class="loader-inner ball-clip-rotate">
                    <div></div>
                </div>
                {% if support_search %}
                    <section>
                        <div class="title">Search {{support_search}}</div>
                        <div class="doc-list-content">
                            <!--doc list start-->
                            {% for article in result%}
                                <div class="doc-list">
                                    <div class="col-md-3">
                                        <a href="{{article.url|raw}}"><img src="/image/u20733.png" alt=""></a>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="title"><a href="{{article.url|raw}}">{{article.title}}</a></div>
                                        <div class="tags">
                                            Tags:{% for tag in article.tags%}<a class="label label-default" style="margin-right:5px" href="{{search_action|raw}}&keyword={{tag}}">{{tag}}</a>{% endfor %}
                                        </div>
                                        <div class="desc">{{article.summary}}</div>
                                        <div class="info">
                                            <span><i class="fa fa-eye"></i>500</span>
                                            <span><i class="fa fa-comments"></i>  {{article.comments}}</span>
                                            <span><i class="fa fa-share"></i></span>
                                        </div>
                                    </div>
                                </div>
                            {% endfor %}

                            {% if search and not result %}
                                <div class="non-reuslt">
                                    No Result
                                </div>
                            {% endif %}
                        </div>
                    </section>
                {% endif %}
                <section>
                    <div class="title">Documentation <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
                    <div class="support-document-block">
                        <a href="">AI</a>
                        <a href="">Huawei OSN 3500 Documentation</a>
                        <a href="">Huawei OSN 500 Documentation</a>
                    </div>
                </section>
            </div>

            <div class="support-right col-md-3">
                {% for sider_category in sider_categories %}
                <div class="support-right-block">
                    <div class="title"><a href="{{sider_category|raw}}">{{sider_category.title}}</a></div>
                    <ul class="list-unstyled">
                        {% for child in sider_category['child'] %}
                        <li><a href="{{child.url|raw}}">{{child.title}}</a></li>
                        {% endfor %}
                    </ul>
                </div>
                {% endfor %}
            </div>
        </div>
    </div>
</main>
<script>
    var searchUrl = '{{search_action|raw}}';
</script>
<?php echo $content_bottom ?>
<?php echo $footer; ?>