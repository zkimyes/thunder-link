<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" class="thunder-link-class" lang="<?php echo $lang; ?>">
<!--<![endif]-->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {{title}}
    </title>
    <base href="{{base}}" />
    <?php if ($description) { ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php } ?>
    <?php if ($keywords) { ?>
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <?php } ?>
    <script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.bootcss.com/vue/2.3.3/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/layer/3.0.2/layer.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--webfonts-->
    <link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
    <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>
    <script src="catalog/view/javascript/common.js" type="text/javascript"></script>
    <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
    <?php } ?>
    <?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>" type="text/javascript"></script>
    <?php } ?>
    <?php foreach ($analytics as $analytic) { ?>
    <?php echo $analytic; ?>
    <?php } ?>
</head>

<body class="<?php echo $class; ?>">

    <nav id="top" class="navbar navbar-inverse">
        <div class="container">
            <?php //echo $currency; ?>
            <?php echo $language; ?>
            <div id="top-links" class="navbar-right navbar-nav list-unstyled top-nav">
                <ul class="list-inline">
                    <li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <?php if ($logged) { ?>
                            <li>
                                <a href="<?php echo $account; ?>">
                                    <?php echo $text_account; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $order; ?>">
                                    <?php echo $text_order; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $transaction; ?>">
                                    <?php echo $text_transaction; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $download; ?>">
                                    <?php echo $text_download; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $logout; ?>">
                                    <?php echo $text_logout; ?>
                                </a>
                            </li>
                            <?php } else { ?>
                            <li>
                                <a href="<?php echo $register; ?>">
                                    <?php echo $text_register; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $login; ?>">
                                    <?php echo $text_login; ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_wishlist; ?></span></a></li>
                    <li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
                    <li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_checkout; ?></span></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="container">
            <div class="row">
                <div class="mainlogo col-md-3">
                    <div id="logo">
                        <?php if ($logo) { ?>
                        <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                        <?php } else { ?>
                        <h1>
                            <a href="<?php echo $home; ?>">
                                <?php echo $name; ?>
                            </a>
                        </h1>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?php echo $search; ?>
                </div>
                <div class="col-sm-3">
                    <?php echo $cart; ?>
                </div>
            </div>
        </div>
        <div class="main-nav">
            <div class="container">
                <div class="clearfix">
                    <div @mouseenter="toggleSubMen(true)" @mouseleave="toggleSubMen(false)" class="category-meun">
                        <a href="{{all_category_url|raw}}" class="categroy-btn">
                            ALL CATEGROY
                                <i class="fa fa-list fa-1x" aria-hidden="true"></i>
                            </a> {% autoescape%}
                        <div  v-show="subCategoryVisable" style="display:none;" class="sub-category">
                            <ul>
                                {% for category in categories %}
                                <li @mouseenter="toggleSubCon(true)">
                                    <a class="f-cate" href="{{category.href|raw}}">{{category.name}} </a> {% if category.children %}
                                    <div>
                                        {% for subcategory in category.children %}
                                        <a href="{{subcategory.href|raw}}">{{subcategory.name}}</a> {% endfor %}
                                    </div>
                                    {% endif %}
                                    <i class="fa fa-angle-right fa-2x" aria-hidden="true"></i>
                                </li>
                                {% endfor %}
                            </ul>
                            <div v-show="subCategoryContentVisable"  style="display:none" class="left-sub-category">
                                <div class="col-md-8">
                                    <!--solutions  -->
                                    <div class="solution-list">
                                        <ul>
                                            <li class="col-md-4">
                                                <a href="">asdasd</a>
                                            </li>
                                            <li class="col-md-4">
                                                <a href="">asdasd</a>
                                            </li>
                                            <li class="col-md-4">
                                                <a href="">asdasd</a>
                                            </li>
                                            <li class="col-md-4">
                                                <a href="">asdasd</a>
                                            </li>
                                            <li class="col-md-4">
                                                <a href="">asdasd</a>
                                            </li>
                                            <li class="col-md-4">
                                                <a href="">asdasd</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="banners">
                                        <div class="col-md-4">
                                            <a href="">
                                                <img src="/image/u135.png" alt="">
                                                <div><strong>US ￥ 35000</strong></div>
                                                <div>Huawei OptiX OSN3500</div>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="">
                                                <img src="/image/u135.png" alt="">
                                                <div><strong>US ￥ 35000</strong></div>
                                                <div>Huawei OptiX OSN3500</div>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="">
                                                <img src="/image/u135.png" alt="">
                                                <div><strong>US ￥ 35000</strong></div>
                                                <div>Huawei OptiX OSN3500</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="/image/cache/catalog/demo/macbook_1-200x200.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        {%endautoescape%}
                    </div>
                    <div class="main-nav-container">
                        <ul class="nav main-nav-bar">
                            <li><a href="{{home}}">Home</a></li>
                            <li><a href="{{support}}">Support</a></li>
                            <li><a href="{{configuration}}">Configure</a></li>
                            <li><a href="{{solution}}">Solution</a></li>
                            <li><a href="{{contact_us}}">Contact Us</a></li>
                            <li><a href="{{home}}">Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>
        Vue.config.devtools = true
        var Menu = new Vue({
            el:".category-meun",
            data:{
                subCategoryVisable:false,
                subCategoryContentVisable:false,
                showContent:{}
            },
            methods:{
                toggleSubMen:function(visable){
                    this.subCategoryVisable = visable
                    this.subCategoryContentVisable=false
                },
                toggleSubCon:function(visable){
                    this.subCategoryContentVisable = visable,
                    this.showContent = {}
                }
            }
        })
    </script>