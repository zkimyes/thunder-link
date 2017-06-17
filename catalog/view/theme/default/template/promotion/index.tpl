<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main promotion">
    <div class="container">
        <div class="options row">
            <div class="pull-left">
                <label for="">Sort by</label>
                <select>
                    <option value="">Latest</option>
                    <option value="">Price:Low to High</option>
                    <option value="">Price:High to Low</option>
                </select>
            </div>
            <div class="pull-right">
                <label for="">Showing</label>
                <select name="" id="">
                    <option value="">10</option>
                    <option value="">25</option>
                    <option value="">30</option>
                </select>
            </div>
        </div>
        <div class="promotion-content">
            <div class="row">
                {% for promotion in promotions %}
                <div class="col-md-6">
                    <div class="row">
                        <div class="promotion-list">
                            <div class="col-md-4">
                                <img src="/image/u672.png" alt="">
                            </div>
                            <div class="col-md-5 pro-info">
                                <h3>{{promotion.product_name}}</h3>
                                <div>{{promotion.desc}}</div>
                                <div><span>{{promotion.pcs}} pcs {{promotion.status}}</span> <span>US$ {{promotion.price}}</span></div>
                            </div>
                            <div class="col-md-3 pro-option">
                                <strong><i class="fa fa-clock-o" aria-hidden="true"></i> End by 1st May</strong>
                                <ul>
                                    <li>No Package</li>
                                    <li>Second-hand</li>
                                    <li>31 unti in stock</li>
                                </ul>
                                <div>
                                    <button class="btn btn-o-success">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {% endfor %}
            </div>
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>