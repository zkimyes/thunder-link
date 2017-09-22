<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main bg-white all_category">
    <div class="container">
        <div class="header">
            <h2>All Categories</h2>
            Thunder-link.com is a leading Huawei optical network product supplier in china, we have rich experience and well reputation in the field over 4 years and offers to global companies like ICT, ISP, Distributors, Nework engineering, Telecom Operators ect.
            Thunder-link.com supply original new Huawei optical network equipments, offering all series Huawei OSN, Huawei OLT, Huawei Switch, Huawei SDH, Huawei WDM products with good quality and one year warranty. We are doing our utmost to provide
            first-rate service to every customer. Comparing with other suppliers, Thunder-link.com have the following outstanding points: Competitive price (better than local representative office) ,Fast delivery (standard lead time 3~5days) Original
            product guarantee (professional ethics)Professional technical advise (Hardware/Software compatibility)
        </div>
        <div class="categories">
            {% for category in all_category %}
            <section class="category" class="row">
                <div class="header"><a href="{{category.link|raw}}">{{category.name|raw}}</a> | {{category.description}}</div>
                <div class="body">
                    <div class="category_list">
                        <ul>
                            {% for child_category in category.child_category %}
                            <li> <a href="{{child_category.link|raw}}">{{child_category.name|raw}}</a></li>
                            {% endfor %}
                        </ul>
                    </div>
                    <div class="content">
                        <div class="bl1">
                            <div class="description">
                                <h3>{{category.banner_center.title}}</h3>
                                {{category.banner_center.content}}
                                <div class="buttons">
                                        <a href="{{category.banner_center.thumb}}" class="btn btn-success">Learn More</a>
                                </div>
                            </div>
                            <img src="{{category.banner_center.thumb}}" alt="">
                            
                        </div>
                        <div class="bl2">
                            <a href="{{category.product.link}}">
                                <img src="{{category.product.thumb}}" alt="">
                            </a>
                            <h4><a href="{{category.product.link}}">{{category.product.name}}</a></h4>
                            <div class="text-center">
                                <button class="btn btn-success">Add To Cart</button>
                            </div>
                        </div>
                        <div class="bl3">
                            <div class="banner-block">
                                <a href="">
                                    <img src="{{category.banner_right_top.thumb}}" alt="">
                                </a>
                            </div>
                            <div class="banner-block">
                                <a href="">
                                    <img src="{{category.banner_right_bottom.thumb}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {% endfor %}
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>