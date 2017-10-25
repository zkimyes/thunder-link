<?php echo $header; ?>
<style>
    .owl-wrapper-outer {
        border: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
</style>
<div id="products_detail" class="container">
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
                        <div id="thumb-big"><a class="thumbnail" href="<?php echo $popup; ?>" data-lightbox="roadtrip" data-title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                        <?php } ?>
                        <div class="imagelist">
                            {% for image in images%}
                            <div style="padding:5px;" class="image-additional item">
                                <a class="thumbnail image-items" href="{{image.popup}}" data-lightbox="roadtrip" data-title="{{heading_title}}"> <img src="{{image.thumb}}" title="{{heading_title}}" alt="{{heading_title}}" /></a>
                            </div>
                            {% endfor %}
                        </div>
                    </div>
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style" data-url="<?php echo $share; ?>">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_button_pinterest_pinit"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
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
                                <a onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">
                                    <?php echo $reviews; ?>
                                </a> /
                                <a onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">
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
                            {{description|raw}}
                        </div>
                    </div>
                    {% if options%} {% for option in options %} {% if option.type == 'select' %}
                    <div class="form-group{{option.required ? 'required' : ''}} list-prop row">
                        <div class="label-text">
                            <label for="input-option{{option.product_option_id}}">{{option.name}}：</label>
                        </div>
                        <div class="content">
                            <select v-model="options.select" name="option[{{option.product_option_id}}]" id="input-option{{option.product_option_id}}" class="form-control">
                                <option value="">--Please Select--</option>
                                {% for option_value in option.product_option_value %}
                                    <option value="{{option_value.option_value_id}}">{{option_value.name}}
                                        {% if option_value.price%}
                                            ({{option_value.price_prefix}}{{option_value.price}})
                                        {% endif %}
                                    </option>
                                {% endfor %}
                            </select>
                        </div>
                    </div>
                    {% endif %} {% if option.type == 'radio' %}
                    <div class="form-group{{option.required ? 'required' : ''}} list-prop row">
                        <div class="label-text">
                            <label for="input-option{{option.product_option_id}}">{{option.name}}：</label>
                        </div>
                        <div class="content">
                            {% for option_value in option.product_option_value %}
                            <label class="btn btn-o-success" :class="{actived:options.radio == '{{ option_value.product_option_value_id }}'}">
                                    <input style="display:none;" v-model="options.radio"  type="radio" name="option[{{ option.product_option_id }}][]" value="{{ option_value.product_option_value_id }}" />
                                    {% if option_value.image %}
                                    <img src="{{ option_value.image }}" alt="{{ option_value.name }}" class="img-thumbnail" /> 
                                    {% endif %}
                                    {{ option_value.name }}
                                    {% if option_value.price %}
                                    ({{ option_value.price_prefix }} {{ option_value.price }})
                                    {% endif %}
                            </label> {% endfor %}
                        </div>
                    </div>
                    {% endif %} {% if option.type == 'checkbox' %}
                    <div class="form-group{{option.required ? 'required' : ''}} list-prop row">
                        <div class="label-text">
                            <label for="input-option{{option.product_option_id}}">{{option.name}}：</label>
                        </div>
                        <div class="content">
                            {% for option_value in option.product_option_value %}
                            <label class="btn btn-o-success" :class="{actived:options.checkbox.indexOf('{{ option_value.product_option_value_id }}') >=0}">
                                    <input style="display:none" v-model="options.checkbox"  type="checkbox" name="option[{{ option.product_option_id }}][]" value="{{ option_value.product_option_value_id }}" />
                                    {% if option_value.image %}
                                    <img src="{{ option_value.image }}" alt="{{ option_value.name }}" class="img-thumbnail" /> 
                                    {% endif %}
                                    {{ option_value.name }}
                                    {% if option_value.price %}
                                    ({{ option_value.price_prefix }} {{ option_value.price }})
                                    {% endif %}
                            </label> {% endfor %}
                        </div>
                    </div>
                    {% endif %} {% endfor %} {% endif %}

                    <div class="list-prop row">
                        <div class="label-text">
                            Unit Price:
                        </div>
                        <div class="content">
                            <span class="price">{{special?special:price}}</span>
                            <span class="saved-price">{{special?price:null}}</span>
                        </div>
                    </div>
                    <div class="list-prop row">
                        <div class="label-text">
                            <label class="control-label" for="input-quantity">{{entry_qty}}</label>
                        </div>
                        <div class="content">
                            <div class="input">
                                <input type="text" name="quantity" v-model.number="quantity" size="2" id="input-quantity" class="form-control" />
                                <div class="buttons">
                                    <button @click="quantity++"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
                                    <button @click="quantity--"><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <?php echo $stock; ?>
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                            <br />
                        </div>
                    </div>
                    <div class="list-prop row">
                        <div class="content">
                            <a class="btn btn-o-success">Quote</a>
                            <button type="button" @click="addCard()" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-o-success"><?php echo $button_cart; ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="tab-header">
                    <ul role="tablist">
                        <li :class="{actived:activeTab=='relevantitems'}" role="presentation">
                           <a href="{{url|raw}}#relevantitems">Relevant items</a> 
                        </li>
                        <li :class="{actived:activeTab=='overview'}" role="presentation">
                            <a href="{{url|raw}}#overview">Overview</a>
                        </li>
                        <li :class="{actived:activeTab=='techspecs'}" role="presentation">
                            <a href="{{url|raw}}#techspecs">Tech Specs</a>
                        </li>
                        <li :class="{actived:activeTab=='faq'}" role="presentation">
                            <a href="{{url|raw}}#faq">
                                FAQ
                            </a>
                        </li>
                    </ul>
                </div>
                <?php if ($products) { ?>
                <div class="row" id="relevantitems" style="margin-top:10px;">
                    <?php $i = 0; ?>
                    <?php foreach ($products as $product) { ?>
                    <?php if ($column_left && $column_right) { ?>
                    <?php $class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12'; ?>
                    <?php } elseif ($column_left || $column_right) { ?>
                    <?php $class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12'; ?>
                    <?php } else { ?>
                    <?php $class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; ?>
                    <?php } ?>
                    <div class="<?php echo $class; ?>">
                        <div class="product-thumb transition">
                            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4>
                                    <a href="<?php echo $product['href']; ?>">
                                        <?php echo $product['name']; ?>
                                    </a>
                                </h4>
                                <?php if ($product['rating']) { ?>
                                <div class="rating">
                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if ($product['rating'] < $i) { ?>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <?php } else { ?>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php if ($product['price']) { ?>
                                <p class="price">
                                    <?php if (!$product['special']) { ?>
                                    <?php echo $product['price']; ?>
                                    <?php } else { ?>
                                    <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                                    <?php } ?>
                                    <?php if ($product['tax']) { ?>
                                    <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                                    <?php } ?>
                                </p>
                                <?php } ?>
                            </div>
                            <div class="button-group">
                                <button type="button" class="btn btn-o-success" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');"><span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span> <i class="fa fa-shopping-cart"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php if (($column_left && $column_right) && ($i % 2 == 0)) { ?>
                    <div class="clearfix visible-md visible-sm"></div>
                    <?php } elseif (($column_left || $column_right) && ($i % 3 == 0)) { ?>
                    <div class="clearfix visible-md"></div>
                    <?php } elseif ($i % 4 == 0) { ?>
                    <div class="clearfix visible-md"></div>
                    <?php } ?>
                    <?php $i++; ?>
                    <?php } ?>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="tab-content" id="overview">
                            <div class="title">
                                <h3>Overview</h3>
                            </div>
                            <?php foreach($attribute_groups as $group){ ?>
                                <?php if(strtolower($group['name']) == 'overview'){?>
                                    <?php foreach($group['attribute'] as $attr){ ?>
                                        <h4 class="text-center"><?php echo $attr['name']; ?></h4>
                                        <?php echo htmlspecialchars_decode($attr['text']); ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="tab-content" id="techspecs">
                            <div class="title">
                                <h3>Tech Specs</h3>
                            </div>
                            <?php foreach($attribute_groups as $group){ ?>
                                <?php if(strtolower($group['name']) == 'techspecs'){?>
                                    <?php foreach($group['attribute'] as $attr){ ?>
                                        <h4 class="text-center"><?php echo $attr['name']; ?></h4>
                                        <?php echo htmlspecialchars_decode($attr['text']); ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-3 product-right" style="margin-top:50px">
                        <div class="panel panel-ghost">
                            <div class="panel-heading">
                                <h3> Buyer Guide </h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled buyer-guide">
                                    <li><i style="font-size:22px;" class="fa fa-question-circle" aria-hidden="true"></i><a href="">Why Buy From US</a></li>
                                    <li><i style="font-size:22px;" class="fa fa-usd" aria-hidden="true"></i><a href="">How To Buy</a></li>
                                    <li><i style="font-size:16px;" class="fa fa-credit-card-alt" aria-hidden="true"></i><a href="">Payment</a></li>
                                    <li><i style="font-size:16px;" class="fa fa-life-ring" aria-hidden="true"></i><a href="">Technical Support</a></li>
                                    <li><i style="font-size:16px;" class="fa fa-handshake-o" aria-hidden="true"></i><a href="">Warranty</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel panel-ghost">
                            <div class="panel-heading">
                                <h3> Downloads </h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    {% for download in downloads %}
                                    <li><a href="{{download.link|raw}}">{{download.name}}</a></li>
                                    {% endfor %}
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
<script>
    $(function() {
        $('.imagelist').owlCarousel({
            items: 6,
            navigation: true,
            navigationText: ['<i class="fa fa-chevron-left fa-4x"></i>', '<i class="fa fa-chevron-right fa-4x"></i>'],
            pagination: false,
            afterMove: function() {
                var _currentImag = $('#thumb-big img');
                $('.image-items').removeClass('actived');
                $('.image-items').eq(this.currentItem).addClass('actived');
                _currentImag.attr('src', $('.image-items').eq(this.currentItem).attr('href'))

            }
        });
    })

    var productVue = new Vue({
        el: '#products_detail',
        delimiters: ['${', '}'],
        data: {
            quantity: Number('{{minimum}}'),
            activeTab:'relevantitems',
            options: {
                select: '',
                checkbox: [],
                radio: '',
                text: ''
            }
        },
        watch: {
            quantity: function(newV) {
                if (isNaN(newV) || parseInt(newV) < 1) {
                    this.quantity = 1
                }
            }
        },
        methods: {
            addCard: function() {
                $.ajax({
                    url: 'index.php?route=checkout/cart/add',
                    type: 'post',
                    data: $('#products_detail input[type=\'text\'], #products_detail input[type=\'hidden\'], #products_detail input[type=\'radio\']:checked, #products_detail input[type=\'checkbox\']:checked, #products_detail select, #products_detail textarea'),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#button-cart').button('loading');
                    },
                    complete: function() {
                        $('#button-cart').button('reset');
                    },
                    success: function(json) {
                        $('.alert, .text-danger').remove();
                        $('.form-group').removeClass('has-error');

                        if (json['error']) {
                            if (json['error']['option']) {
                                for (i in json['error']['option']) {
                                    var element = $('#input-option' + i.replace('_', '-'));

                                    if (element.parent().hasClass('input-group')) {
                                        element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                    } else {
                                        element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                    }
                                }
                            }

                            if (json['error']['recurring']) {
                                $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                            }

                            // Highlight any found errors
                            $('.text-danger').parent().addClass('has-error');
                        }

                        if (json['success']) {
                            $('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                            $('#cart > a:first').html('<i class="fa fa-shopping-cart"></i> <span id="cart-total">' + json['total'] +'</span>');

                            $('html, body').animate({
                                scrollTop: 0
                            }, 'slow');

                            $('#cart > ul').load('index.php?route=common/cart/info ul li');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        mounted:function(){
            var _that = this;
            window.onhashchange = function(e){
                console.log(this);
                _that.activeTab = location.hash.substr(1);
                console.log(location.hash)
                console.log(11)
            }
        }
    })
</script>
<?php echo $footer; ?>