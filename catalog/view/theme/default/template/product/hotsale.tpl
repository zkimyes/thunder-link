<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main hot_sale">
    <div class="container">
        {% for category in hot_sale_category%}
        <section>
            <div class="title">
                <h3>{{category.name}}</h3>
            </div>
            <div class="body row">
                {% for product in category.products %}
                <div class="col-md-3 product_list">
                    <a href="{{product.href|raw}}">
                        <div class="thumb">
                            <img src="{{product.thumb|raw}}" alt="{{product.name}}">
                        </div>
                        <h4>{{product.name}}</h4>
                        <div class="info">
                            {{product.description}}
                        </div>
                        <div class="price">
                            <span class="in">
                                            {{product.price}}
                                        </span>
                            <span class="pull-right"> {{product.stock_status}}</span>
                        </div>
                    </a>

                </div>
                {% endfor %}
            </div>
        </section>

        {% endfor %}
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>