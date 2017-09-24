<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main hot_sale">
    <div class="container">
        <section>
            <div class="title"><strong>MSTP</strong></div>
            <div class="body row">
                {% for item in [1,2,3,4,5,6] %}
                <div class="col-md-3 product_list">
                    <div class="thumb">
                        <img src="/image/u135.png" alt="">
                    </div>
                    <h4>Huawei OptiX OSN3500</h4>
                    <div class="info">
                        OSN3500 Subrack with 2*STM-64, 11*STM-16 four-fiber MSP rings.11*STM-16 four-fiber MSP rings
                    </div>
                    <div class="price">
                        <span class="in">
                            US$ 350000
                        </span>
                        <span class="pull-right"> In Stock</span>
                    </div>
                </div>
                {% endfor %}
            </div>
        </section>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>