<?php echo $header; ?>
<script src="http://cdn.bootcss.com/bootstrap-hover-dropdown/2.0.10/bootstrap-hover-dropdown.min.js"></script>
<div class="container">
    <div class="row">
        <ul class="breadcrumb">
            {% for breadcrumb in breadcrumbs%} {% if breadcrumb.type == 'category'%}
            <li>
                <div class="dropdown-inline">
                    {% for subcategory in breadcrumb.sublings %} {% if subcategory.category_id == breadcrumb.category_id %}
                    <a href="{{subcategory.link|raw}}">
                        {{subcategory.name}}
                        <span class="caret"></span>
                    </a> {% endif %} {% endfor %}
                    <ul class="menu">
                        {% for subcategory in breadcrumb.sublings %}
                        <li>
                            <a href="{{subcategory.link|raw}}">{{subcategory.name}}&nbsp;
                                <span class="caret"></span>
                            </a>
                        </li>
                        {% endfor %}

                    </ul>
                </div>
            </li>
            {% else %}
            <li>
                <a href="{{breadcrumb.href|raw}}">{{breadcrumb.text|raw}}</a>
            </li>
            {% endif %} {% endfor %}
        </ul>
        <div class="row">
            <?php echo $column_left; ?>
            <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
            <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-sm-9'; ?>
            <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
            <?php } ?>
            <div id="content" class="<?php echo $class; ?>">
                <?php echo $content_top; ?>
                <!-- tabs -->
                <ul class="nav nav-tabs category-tabs">
                    {% if top_sale %}
                    <li>
                        <a href="{{all_item_link|raw}}">All Items</a>
                    </li>
                    <li class="active">
                        <a href="{{top_sale_link|raw}}">Top Sale</a>
                    </li>
                    {% else %}
                    <li class="active">
                        <a href="{{all_item_link|raw}}">All Items</a>
                    </li>
                    <li>
                        <a href="{{top_sale_link|raw}}">Top Sale</a>
                    </li>
                    {% endif %}

                </ul>
                <?php if ($products) { ?>
                <div class="form-inline category-sort">
                    <div class="form-group">
                        <label for="input-sort">
                            <?php echo $text_sort; ?>
                        </label>
                        <select id="input-sort" class="form-control" onchange="location = this.value;">
                            <?php foreach ($sorts as $sorts) { ?>
                            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                            <option value="<?php echo $sorts['href']; ?>" selected="selected">
                                <?php echo $sorts['text']; ?>
                            </option>
                            <?php } else { ?>
                            <option value="<?php echo $sorts['href']; ?>">
                                <?php echo $sorts['text']; ?>
                            </option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group hidden-xs">
                            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>">
                                <i class="fa fa-th-list"></i>
                            </button>
                            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>">
                                <i class="fa fa-th"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <?php foreach ($products as $product) { ?>
                    <div class="product-layout product-list col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="<?php echo $product['href']; ?>">
                                    <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"
                                        class="img-responsive" />
                                </a>
                            </div>
                            <div class="desc">
                                <div class="caption">
                                    <h4>
                                        <a href="<?php echo $product['href']; ?>">
                                            <?php echo $product['name']; ?>
                                        </a>
                                    </h4>
                                    <p>
                                        <?php echo $product['description']; ?>
                                    </p>
                                    <?php if ($product['rating']) { ?>
                                    <div class="rating">
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                        <?php if ($product['rating'] < $i) { ?>
                                        <span class="fa fa-stack">
                                            <i class="fa fa-star-o fa-stack-1x"></i>
                                        </span>
                                        <?php } else { ?>
                                        <span class="fa fa-stack">
                                            <i class="fa fa-star fa-stack-1x"></i>
                                            <i class="fa fa-star-o fa-stack-1x"></i>
                                        </span>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                    <?php if ($product['price']) { ?>
                                    <p class="price">
                                        <?php if (!$product['special']) { ?>
                                        <?php echo $product['price']; ?>
                                        <?php } else { ?>
                                        <span class="price-new">
                                            <?php echo $product['special']; ?>
                                        </span>
                                        <span class="price-old">
                                            <?php echo $product['price']; ?>
                                        </span>
                                        <?php } ?>
                                        <?php if ($product['tax']) { ?>
                                        <span class="price-tax">
                                            <?php echo $text_tax; ?>
                                            <?php echo $product['tax']; ?>
                                        </span>
                                        <?php } ?>
                                    </p>
                                    <?php } ?>
                                </div>
                                <div class="button-group">
                                    <button class="btn btn-o-success" type="button" onclick="cart.add('{{product.product_id}}', '{{product.minimum}}');">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="hidden-xs hidden-sm hidden-md">
                                            <?php echo $button_cart; ?>
                                        </span>
                                    </button>
                                    <!-- <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button> -->
                                    <button class="btn btn-o-success" type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('{{product.product_id}}');">Add Compare</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <?php echo $pagination; ?>
                    </div>
                    <div class="col-sm-6 text-right">
                        <?php echo $results; ?>
                    </div>
                </div>
                <?php } ?>
                <?php if (!$categories || !$products) { ?>
                <p class="alert alert-dismissable">
                    <?php echo $text_empty; ?>
                </p>
                <div class="buttons">
                    <div class="pull-right">
                        <a href="<?php echo $continue; ?>" class="btn btn-primary">
                            <?php echo $button_continue; ?>
                        </a>
                    </div>
                </div>
                <?php } ?>
                <?php echo $content_bottom; ?>
            </div>
            <?php echo $column_right; ?>
        </div>
    </div>
</div>
<?php echo $footer; ?>