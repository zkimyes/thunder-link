<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
        {% for breadcrumb in breadcrumbs %}
        <li>
            <a href="{{breadcrumb['href']}}">
                {{breadcrumb['text']}}
            </a>
        </li>
        {% endfor %}
    </ul>
    <div class="row">
        <div id="content" class="container">
            <?php echo $content_top; ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="">
                        <?php if ($thumb) { ?>
                        <div><a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                        <?php } ?>
                        <?php if ($images) { ?>
                        <?php foreach ($images as $image) { ?>
                        <div class="image-additional"><a class="thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <!-- AddThis Button BEGIN -->
                    <!--<div class="addthis_toolbox addthis_default_style" data-url="<?php echo $share; ?>"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
                      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>-->
                    <!-- AddThis Button END -->
                </div>
                <div class="col-md-8">
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
                    <div class="list-prop row">
                        <div class="label-text">
                            Available Options:
                        </div>
                        <div class="content">
                            <a class="btn btn-o-success">OSN 3500 Gold Line</a>
                            <a class="btn btn-o-success">OSN 3500 Gold Line</a>
                            <a class="btn btn-o-success">OSN 3500 Gold Line</a>
                            <a class="btn btn-o-success">OSN 3500 Gold Line</a>
                        </div>
                    </div>
                    <div class="list-prop row">
                        <div class="label-text">
                            Software Version:
                        </div>
                        <div class="content">
                            <select class="form-control">
                               <option value="">Please select a software</option>
                          </select>
                        </div>
                    </div>
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
                            Quantity:
                        </div>
                        <div class="content">

                        </div>
                    </div>
                    <div class="list-prop row">
                        <div class="content">
                            <a class="btn btn-o-success">Quote</a>
                            <a class="btn btn-o-success">Add to Cart</a>
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
<?php echo $footer; ?>