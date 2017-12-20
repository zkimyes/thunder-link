<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main bg-white contact_us">
    <div class="container">
        <div class="about-block mt30 row">
            Thunder-link.com solution page can provide the most accurate problem solution for customers according to the problem customers meet. if can not find your case here,or just need a quick technical advice . please mail to Supports@Thunder-link.com, we will
            come back to you in 48 hours
        </div>

        <div class="solution-nav">
            <ul>
                {% for category in solution_categoris %}
                 {% if category.id == get_id %}
                 <li class="active"><a href="javascript:;">{{category.title}}</a></li>
                 {% else %}
                 <li><a href="{{category.link|raw}}">{{category.title}}</a></li>
                 {% endif %}
                
                {% endfor %}
            </ul>
        </div>
        <div class="solution-content">
            {% for article in articles %}
            <div class="solution">
                <div class="s-img">
                    <img src="{{article.thumb}}" alt="{{article.title}}">
                </div>
                <div class="s-content">
                    <h4><a href="{{article.link|raw}}">{{article.title}}</a></h4>
                    <p>{{article.summary}}</p>
                    <a class="btn btn-link" href="{{article.link|raw}}">Learn More</a>
                </div>
            </div>
            {% endfor %}
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>