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
                    {% for category in hot_sale_category%}
                    <li class="col-md-2" role="presentation"><a href="#{{category.name}}" aria-controls="{{category.name}}" role="tab" data-toggle="tab">{{category.name}}</a></li>
                    {% endfor %}
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                        {% for category in hot_sale_category%}
                            <div role="tabpanel" class="tab-pane" id="{{category.name}}">
                                    {% for product in category.products%}
                                        <div class="col-md-3">
                                            <a href="">
                                                <img src="/image/u135.png" alt="">
                                                <div><strong>US ￥ 35000</strong></div>
                                                <div>Huawei OptiX OSN3500</div>
                                            </a>
                                        </div>
                                    {% endfor %}
                                </div>
                        {% endfor %}
                </div>
            </div>
        </div>

        <div class="document-block mt30">
            <div class="section clearfix">
                <div class="col-md-6">
                    <h4>Support doucument Search</h4>
                    <div class="main-search-bar input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                    <div class="hot-tag">
                        <a class="label" href="">OTN Configuration</a>
                        <a class="label" href="">OTN Configuration</a>
                        <a class="label" href="">OTN Configuration</a>
                        <a class="label" href="">OTN Configuration</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <p>FTTX Leased Line Solution For Enterprise</p>
                    <div>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</div>
                </div>
            </div>
            <div class="section clearfix">
                <div class="col-md-4">
                    <div class="col-md-7">
                        <p>FTTX Leased Line Solution For Enterprise</p>
                        <p>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</p>
                    </div>
                    <div class="col-md-5">
                        <img src="/image/u646.png" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-7">
                        <p>FTTX Leased Line Solution For Enterprise</p>
                        <p>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</p>
                    </div>
                    <div class="col-md-5">
                        <img src="/image/u646.png" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-7">
                        <p>FTTX Leased Line Solution For Enterprise</p>
                        <p>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</p>
                    </div>
                    <div class="col-md-5">
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
                <a href="">View More ></a>
            </div>
            <div class="col-md-10">
                <div class="col-md-3">
                    <a href="">
                        <img src="/image/u135.png" alt="">
                        <div><strong>US ￥ 35000</strong></div>
                        <div>Huawei OptiX OSN3500</div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="">
                        <img src="/image/u135.png" alt="">
                        <div><strong>US ￥ 35000</strong></div>
                        <div>Huawei OptiX OSN3500</div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="">
                        <img src="/image/u135.png" alt="">
                        <div><strong>US ￥ 35000</strong></div>
                        <div>Huawei OptiX OSN3500</div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="">
                        <img src="/image/u135.png" alt="">
                        <div><strong>US ￥ 35000</strong></div>
                        <div>Huawei OptiX OSN3500</div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</main>
<?php echo $footer; ?>