<?php echo $header; ?>
<link rel="stylesheet" href="/catalog/view/javascript/jquery/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="/catalog/view/javascript/jquery/magnific/magnific-popup.css">
<style>
    .owl-wrapper-outer{
        border:0;
        -webkit-box-shadow:none;
        box-shadow: none;
    }
</style>
<div class="container">
    <ul class="breadcrumb">
        {% for breadcrumb in breadcrumbs %}
        <li>
            <a href="{{breadcrumb['href']}}">
                {{breadcrumb['text']|raw}}
            </a>
        </li>
        {% endfor %}
    </ul>
    <div class="row">
        <div id="content" class="container">
            <?php echo $content_top; ?>
            <div class="row">
                <div class="col-md-5">
                    <div class="dd">
                        <?php if ($thumb) { ?>
                        <div><a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                        <?php } ?>
                        <div class="imagelist">
                            {% for image in images%}
                            <div style="padding:5px;" class="image-additional item"><a class="thumbnail" href="{{image.popup}}" title="{{heading_title}}"> <img src="{{image.thumb}}" title="{{heading_title}}" alt="{{heading_title}}" /></a></div>
                            {% endfor %}
                        </div>
                    </div>
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style" data-url="<?php echo $share; ?>"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
                      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
                    <!-- AddThis Button END -->
                </div>
                <div class="col-md-7">
                    <h1>
                        <?php echo $heading_title; ?>
                    </h1>
                    <p class="model">
                        <?php echo $model; ?>
                    </p>
                    <div class="reviews">
                        <?php if ($review_status) { ?>
                        <div class="rating">
                            <p>
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <?php if ($rating < $i) { ?>
                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                <?php } else { ?>
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                <?php } ?>
                                <?php } ?>
                                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">
                                    <?php echo $reviews; ?>
                                </a> /
                                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">
                                    <?php echo $text_write; ?>
                                </a>
                            </p>
                        </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="list-prop row">
                        <div class="label-text">
                            Description:
                        </div>
                        <div class="content">
                        </div>
                    </div>

                    {% if options%}
                        {% for option in options %}
                            {% if option.type == 'select' %}
                                <div class="form-group{{option.required ? 'required' : ''}} list-prop row">
                                    <div class="label-text">
                                        <label for="input-option{{option.product_option_id}}">{{option.name}}：</label>
                                    </div>
                                    <div class="content">
                                        <select name="option[{{option.product_option_id}}]" id="input-option{{option.product_option_id}}" class="form-control">
                                            <option value="">Please select a software</option>
                                            {% for option_value in option.product_option_value %}
                                                <option value="{{option_value.product_option_value_id}}">{{option_value.name}}
                                                    {% if option_value.price%}
                                                        ({{option_value.price_prefix}}{{option_value.price}})
                                                    {% endif %}
                                                </option>
                                            {% endfor %}
                                        </select>
                                    </div>
                                </div>
                            {% endif %}
                            {% if option.type == 'checkbox' %}
                                <div class="form-group{{option.required ? 'required' : ''}} list-prop row">
                                    <div class="label-text">
                                        <label for="input-option{{option.product_option_id}}">{{option.name}}：</label>
                                    </div>
                                    <div class="content">
                                            {% for option_value in option.product_option_value %}
                                                <a class="btn btn-o-success" href="">
                                                        {{option_value.name}}
                                                        {% if option_value.price%}
                                                            ({{option_value.price_prefix}}{{option_value.price}})
                                                        {% endif %}
                                                </a>
                                                    
                                            {% endfor %}
                                    </div>
                                </div>
                            {% endif %}

                        {% endfor %}
                    {% endif %}

                    <div class="list-prop row">
                        <div class="label-text">
                            Unit Price:
                        </div>
                        <div class="content">
                            <span class="price">US $35000</span>
                            <span class="saved-price">$ 45000</span>
                        </div>
                    </div>
                    <div class="list-prop row">
                        <div class="label-text">
                            <label class="control-label" for="input-quantity">{{entry_qty}}</label>
                        </div>
                        <div class="content">
                            <input type="number" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                            <br />
                        </div>
                    </div>
                    <div class="list-prop row">
                        <div class="content">
                            <a class="btn btn-o-success">Quote</a>
                            <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-o-success"><?php echo $button_cart; ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="tab-header">
                    <ul>
                        <li>Relevant items</li>
                        <li>Overview</li>
                        <li>Tech Specs</li>
                        <li>FAQ</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="tab-content" id="relevant-items">
                            <div class="title">
                                <h3>Relevant items</h3>
                            </div>
                        </div>
                        <div class="tab-content" id="overview">
                            <div class="title">
                                <h3>Overview</h3>
                            </div>
                            <?php 
                                    foreach($attribute_groups as $attrs){
                                        if($attrs['name'] == 'Overview'){
                                            foreach($attrs['attribute'] as $attr){?>
                            <div>
                                <?php echo $attr['text'];?>
                            </div>
                            <?php 
                                    }}} 
                                ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="panel panel-ghost">
                            <div class="panel-heading">Buyer Guide</div>
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    <li><span class="glyphicon glyphicon-question-sign"></span><a href="">Why Buy From US</a></li>
                                    <li><span class="glyphicons glyphicons-usd"></span><a href="">How To Buy</a></li>
                                    <li><span class="glyphicons glyphicons-fees-payments"></span><a href="">Payment</a></li>
                                    <li><span class="glyphicons glyphicons-vr-maintenance"></span><a href="">Technical Support</a></li>
                                    <li><span class="glyphicons glyphicons-suitcase"></span><a href="">Warranty</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel panel-ghost">
                            <div class="panel-heading">Downloads</div>
                            <div class="panel-body">
                                <ul>
                                    <li><a href="">Why Buy From US</a></li>
                                    <li><a href="">How To Buy</a></li>
                                    <li><a href="">Payment</a></li>
                                    <li><a href="">Technical Support</a></li>
                                    <li><a href="">Warranty</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php echo $content_bottom; ?>
        </div>
        <?php echo $column_right; ?>
    </div>
</div>
<script src="/catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
<script src="/catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
<script>
    $(function() {
        $('.imagelist').owlCarousel({
            items: 6,
            navigation: true,
            navigationText: ['<i class="fa fa-chevron-left fa-4x"></i>', '<i class="fa fa-chevron-right fa-4x"></i>'],
            pagination: true
        });

        $('.thumbnail').magnificPopup({
            type:'image',
            delegate: 'a',
            gallery: {
                enabled:true
            }
        });
    })
</script>
<?php echo $footer; ?>