{{header|raw}}{{content_top|raw}}
<main class="main">
    <div class="container">
        <div class="prod-block mt30">
            <div class="col-md-2">
                <h2>Hot Sale</h2>
                <div class="pre-text">
                    Secure Online <br> Transactions Buy It <br> Now for Fast Dispatch
                </div>
                <a href="">View More ></a>
            </div>
            <div class="col-md-10">
                <ul class="nav nav-tabs th-tabs" role="tablist">
                    {% for category in hot_sale_category%} {% if loop.index == 1 %}
                    <li class="col-md-2 active" role="presentation"><a href="#{{category.name}}" aria-controls="{{category.name}}" role="tab" data-toggle="tab">{{category.name}}</a></li>
                    {% else %}
                    <li class="col-md-2" role="presentation"><a href="#{{category.name}}" aria-controls="{{category.name}}" role="tab" data-toggle="tab">{{category.name}}</a></li>
                    {% endif %} {% endfor %}
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    {% for category in hot_sale_category%} {% if loop.index == 1%}
                    <div role="tabpanel" class="tab-pane active" id="{{category.name}}">
                        {% for product in category.products%}
                        <div class="animate-1 col-md-3">
                            <a href="{{product.url|raw}}">
                                <img src="{{product.thumb}}" alt="{{product.name}}">
                                <div><strong>{{product.price}}</strong></div>
                                <div>{{product.name}}</div>
                            </a>
                        </div>
                        {% endfor %}
                    </div>
                    {% else %}
                    <div role="tabpanel" class="tab-pane" id="{{category.name}}">
                        {% for product in category.products%}
                        <div class="animate-1 col-md-3">
                            <a href="{{product.url|raw}}">
                                <img src="{{product.thumb}}" alt="{{product.name}}">
                                <div><strong>{{product.price}}</strong></div>
                                <div>{{product.name}}</div>
                            </a>
                        </div>
                        {% endfor %}
                    </div>
                    {% endif %} {% endfor %}
                </div>
            </div>
        </div>

        <div class="document-block mt30">
            <div class="section clearfix">
                <div class="col-md-6 document-search-block">
                    <h4>Support Doucument Search</h4>
                    <div class="main-search-bar input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                    <div class="hot-tag">
                        <a class="label label-default" href="">OTN Configuration</a>
                        <a class="label label-default" href="">OTN Configuration</a>
                        <a class="label label-default" href="">OTN Configuration</a>
                        <a class="label label-default" href="">OTN Configuration</a>
                    </div>
                </div>
                <div class="col-md-6 document-ads-block">
                    <p>FTTX Leased Line Solution For Enterprise</p>
                    <div>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</div>
                </div>
            </div>
            <div class="section clearfix">
                <div class="col-md-4 document-slik-block">
                    <div class="col-md-5">
                        <p>FTTX Leased Line Solution For Enterprise</p>
                        <p>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</p>
                    </div>
                    <div class="col-md-7">
                        <img src="/image/u646.png" alt="">
                    </div>
                </div>
                <div class="col-md-4 document-slik-block">
                    <div class="col-md-5">
                        <p>FTTX Leased Line Solution For Enterprise</p>
                        <p>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</p>
                    </div>
                    <div class="col-md-7">
                        <img src="/image/u646.png" alt="">
                    </div>
                </div>
                <div class="col-md-4 document-slik-block">
                    <div class="col-md-5">
                        <p>FTTX Leased Line Solution For Enterprise</p>
                        <p>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</p>
                    </div>
                    <div class="col-md-7">
                        <img src="/image/u646.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="misrv-block clearfix mt30">
            <div class="col-md-4">
                <p>MA5603T Typical Configuration</p>
                <p><a class="btn btn-success" href="">Go See It</a></p>
            </div>
            <div class="col-md-4">
                <p>MA5603T Typical Configuration</p>
                <p><a class="btn btn-success" href="">Go See It</a></p>
            </div>
            <div class="col-md-4">
                <p>MA5603T Typical Configuration</p>
                <p><a class="btn btn-success" href="">Go See It</a></p>
            </div>
        </div>


        <div class="prod-block promotion-block mt30">
            <div class="col-md-2">
                <h2>Promotion</h2>
                <div>
                    Secure Online <br> Transactions Buy It <br> Now for Fast Dispatch
                </div>
                <a href="{{promotion_url|raw}}">View More ></a>
            </div>
            <div class="col-md-10">
                <div id="promotion_slide" class="owl-carousel owl-theme">
                    {% for product in promotion %}
                    <div class="animate-1 item">
                        <a href="{{product.url|raw}}">
                            <img src="{{product.thumb}}" alt="{{product.title}}">
                            <div><strong>{{product.price}}</strong></div>
                            <div>{{product.title}}</div>
                        </a>
                    </div>
                    {% endfor %}
                </div>
            </div>
        </div>

    </div>

</main>
<div class="bottom-helper">
    <div class="container">
        <div class="col-md-4">
            <div class="help-block">
                <div class="header">
                    <strong>Support</strong>
                    <a href="" class="more">View More »</a>
                </div>
                <div class="body">
                    <div class="col-md-4">
                        <img src="/image/u831.png" alt="">
                    </div>
                    <div class="col-md-8">
                        Data Center Solutions Thunder-link.com offers a variety of integrated holistic physical infrastructure solutions ...
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="help-block">
                <div class="header">
                    <strong>Solution</strong>
                    <a href="" class="more">View More »</a>
                </div>
                <div class="body">
                    <div class="col-md-4">
                        <img src="/image/u842.png" alt="">
                    </div>
                    <div class="col-md-8">
                        Data Center Solutions Thunder-link.com offers a variety of integrated holistic physical infrastructure solutions ...
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="help-block">
                <div class="header">
                    <strong>Documents</strong>
                    <a href="" class="more">View More »</a>
                </div>
                <div class="body">
                    <div class="col-md-4">
                        <img src="/image/u855.png" alt="">
                    </div>
                    <div class="col-md-8">
                        Data Center Solutions Thunder-link.com offers a variety of integrated holistic physical infrastructure solutions ...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    isHome = true;
    Menu.$data.subCategoryVisable = true;
    $(function() {
        $('#promotion_slide').owlCarousel({
            items: 4,
            autoPlay: 3000,
            navigation: true,
            navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
            pagination: true
        })
    })
</script>
<?php echo $footer; ?>