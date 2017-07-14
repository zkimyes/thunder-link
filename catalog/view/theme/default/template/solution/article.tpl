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
                
            {% endif %}
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>