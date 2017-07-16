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
            <?php echo $currency; ?>
            <?php echo $language; ?>
            <div id="top-links" class="navbar-right navbar-nav list-unstyled top-nav">
                <ul class="list-inline">
                    <li><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo $telephone; ?></span></li>
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
                    <div class="category-meun">
                        <a class="categroy-btn">
                            ALL CATEGROY
                                <i class="fa fa-list fa-1x" aria-hidden="true"></i>
                            </a> {% autoescape%}
                        <div class="sub-category">
                            <ul>
                                {% for category in categories %}
                                <li>
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
                            <div class="left-sub-category">

                            </div>
                        </div>
                        {%endautoescape%}
                    </div>
                    <div class="main-nav-container">
                        <ul class="nav main-nav-bar">
                            <li><a href="{{home}}">Home</a></li>
                            <li><a href="{{support}}">Support</a></li>
                            <li><a href="{{configure}}">Configure</a></li>
                            <li><a href="{{solution}}">Solution</a></li>
                            <li><a href="{{contact_us}}">Contact Us</a></li>
                            <li><a href="{{home}}">Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--<?php if ($categories) { ?>
<div class="container">
  <nav id="menu" class="navbar">
    <div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
      <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <?php foreach ($categories as $category) { ?>
        <?php if ($category['children']) { ?>
        <li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
          <div class="dropdown-menu">
            <div class="dropdown-inner">
              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
              <ul class="list-unstyled">
                <?php foreach ($children as $child) { ?>
                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
            </div>
            <a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a> </div>
        </li>
        <?php } else { ?>
        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </nav>
</div>
<?php } ?>-->