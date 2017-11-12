{{header|raw}}{{content_top|raw}}
<main id="common-home" class="main">
    <div class="container">
        <div class="prod-block mt30 animate">
            <div class="col-md-2">
                <h2>Hot Sale</h2>
                <div class="pre-text">
                    Secure Online <br> Transactions Buy It <br> Now for Fast Dispatch
                </div>
                <a href="{{hotsale_url|raw}}">View More ></a>
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
                        <input type="text" id="home-doc-search" name="search" class="form-control">
                        <span class="input-group-addon"><button id="docSearch" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button></span>
                    </div>
                    <div class="hot-tag">
                        {% for tag in is_search_tags %}
                        <a class="tag label label-default" href="{{search_action|raw}}&keyword={{tag.name}}">{{tag.name}}</a> {% endfor %}
                    </div>
                </div>
                <div class="col-md-6 document-ads-block">
                    <p>FTTX Leased Line Solution For Enterprise</p>
                    <div>FTTX leased Line solution for Enterprise--- FTTx Leased Line Solution Main SlidesOverview ..</div>
                </div>
            </div>
            <div class="section clearfix">
                {% for article in support %}
                <div class="col-md-4 document-slik-block">
                    <a href="{{article.url|raw}}">
                        <div class="col-md-6">
                            {{article.desc_home}}
                        </div>
                        <div class="col-md-6">
                            <img style="max-width:100%" src="{{article.thumb}}" alt="{{article.title_home}}">
                        </div>
                    </a>
                </div>
                {% endfor %}
            </div>
        </div>

        <div class="misrv-block clearfix mt30">
            {% for banner in three_banner%}
            <div class="col-md-4" style="background:url('{{banner.thumb}}') no-repeat center right">
                <p>{{banner.title}}</p>
                <p><a class="btn btn-success" href="{{banner.link|raw}}">Go See It</a></p>
            </div>
            {% endfor %}
        </div>


        <div class="prod-block promotion-block mt30 animate">
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
                        <a data-toggle="modal" 
                        onclick="HomeApp.showPromotion('{{product.product_id}}','{{product.title}}','{{product.thumb}}','{{product.condition}}','{{product.description}}','{{product.price}}','{{product.date_end}}')" 
                        data-target="#home-promotion-modal">
                            <h4>{{product.title}}</h4>
                            <div><strong style="color:#f00;font-size:18px;">{{product.price}}</strong></div>
                            <img src="{{product.thumb}}" alt="{{product.title}}">
                            <div>{{product.condition}}
                                <br> {{product.date_end}}
                            </div>
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
                    <a href="{{support_url|raw}}" class="more">View More »</a>
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
                    <a href="{{solution_url|raw}}" class="more">View More »</a>
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
    var HomeApp;
    Menu.$data.subCategoryVisable = true;
    $(function() {
        $('#promotion_slide').owlCarousel({
            items: 4,
            autoPlay: 3000,
            navigation: true,
            navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
            pagination: true
        });

        HomeApp = new Vue({
            el: '#home-promotion-modal',
            delimiters: ['${', '}'],
            data: {
                promotionModal: {
                    product_id:'',
                    title: '',
                    image: '',
                    condition: '',
                    price: 0,
                    quantity: 0,
                    desc:'',
                    date:''
                }
            },
            watch: {
                'promotionModal.quantity':function(newV) {
                    if (isNaN(newV) || parseInt(newV) < 0) {
                        this.promotionModal.quantity = 0
                    }
                },
                deep:true
            },
            methods:{
                showPromotion:function(product_id,title,image,condition,desc,price,date){
                    this.promotionModal.product_id = product_id;
                    this.promotionModal.title = title;
                    this.promotionModal.image = image,
                    this.promotionModal.condition = condition;
                    this.promotionModal.price = price;
                    this.promotionModal.desc = desc;
                    this.promotionModal.date = date;
                },
                addToCart:function(){
                    cart.add(this.promotionModal.product_id,this.promotionModal.quantity);
                    setTimeout(function(){
                        $('#home-promotion-modal').modal('hide');
                    },1000)
                },
                reset:function(){
                    this.promotionModal = {
                        product_id:'',
                        title: '',
                        image: '',
                        condition: '',
                        price: 0,
                        quantity: 0,
                        desc:'',
                        date:''
                    }
                }
            },
            mounted:function(){
                var _that = this;
                $('#home-promotion-modal').on('hide.bs.modal', function (e) {
                    _that.reset();
                })
            }
        })
    });
</script>
<div id="home-promotion-modal" class="modal fade bs-example-modal-lg promotion-home-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">${promotionModal.title}</h4>
            </div>
            <div class="row modal-body" style="padding:30px;">
                <div class="col-md-3">
                    <img :src="promotionModal.image" style="max-width:100%;" :alt="promotionModal.title">
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-2">Description:</div>
                        <div class="col-md-10">${promotionModal.desc}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Condition:</div>
                        <div class="col-md-10">${promotionModal.condition}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Price:</div>
                        <div class="col-md-10">
                            <div class="col-md-3">
                                ${promotionModal.price}
                            </div>
                            <div class="col-md-3">
                                <div class="input">
                                    <input type="text" name="quantity" v-model.number="promotionModal.quantity" size="2" id="input-quantity" class="form-control" />
                                    <div class="buttons">
                                        <button @click="promotionModal.quantity++"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
                                        <button @click="promotionModal.quantity--"><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button @click="addToCart()" class="btn btn-o-success">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>