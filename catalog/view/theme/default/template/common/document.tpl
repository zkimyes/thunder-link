<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main bg-white contact_us">
    <div class="container">
        <div class="document-category">
            <a href="{{index_link}}">All</a>
            {% for cate in document_category%} {% if id == cate.id %}
            <a class="actived" href="{{cate.link|raw}}">{{cate.name}}</a>
            {% else %}
            <a href="{{cate.link|raw}}">{{cate.name}}</a>
            {% endif %} {% endfor %}
        </div>
        <div class="row">
            {% if loop.index%2 == 0 %}
            <div class="col-md-6" style="border-right:1px #ddd solid;min-height:300px">
                <ul class="list-unstyled">
                    {% for docuemnt in documents %}
                    <li><a href="{{docuemnt.link|raw}}">{{docuemnt.name}}</a></li>
                    {% endfor %}
                </ul>
            </div>
            {% else %}
            <div class="col-md-6">
                <ul class="list-unstyled">
                     {% for docuemnt in documents %}
                    <li>
                        <a href="{{docuemnt.link|raw}}">{{docuemnt.name}}</a>
                    </li>
                    {% endfor %}
                </ul>
            </div>
            {% endif %}
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>