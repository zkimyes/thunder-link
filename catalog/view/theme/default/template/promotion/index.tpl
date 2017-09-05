<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main promotion">
    <div class="container">
         <div class="row">
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li>
                    <a href="<?php echo $breadcrumb['href']; ?>">
                        <?php echo $breadcrumb['text']; ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="options row">
            <div class="pull-left">
                <label for="">Sort by</label>
                <select name="sort">
                            <option value="latest">Latest</option>
                            <option value="low2high">Price:Low to High</option>
                            <option value="high2low">Price:High to Low</option>
                        </select>
            </div>
            <div class="pull-right">
                <label for="">Showing</label>
                <select name="limit" name="" id="">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                        </select>
            </div>
        </div>
        <div class="promotion-content">
            <div class="row">
                {% for promotion in promotions %}
                <div class="col-md-6">
                    <div class="row">
                        <div class="promotion-list">
                            <div class="col-md-4">
                                <img src="{{promotion.img}}" alt="">
                            </div>
                            <div class="col-md-5 pro-info">
                                <h3>{{promotion.product_name}}</h3>
                                <div>{{promotion.desc}}</div>
                                <div><span>{{promotion.pcs}} pcs {{promotion.status}}</span> <span>US$ {{promotion.price}}</span></div>
                            </div>
                            <div class="col-md-3 pro-option">
                                <strong><i class="fa fa-clock-o" aria-hidden="true"></i> End by 1st May</strong>
                                <ul>
                                    <li>No Package</li>
                                    <li>Second-hand</li>
                                    <li>31 unti in stock</li>
                                </ul>
                                <div>
                                    <button data-product_id="{{promotion.product_id}}" data-loading-text="Loading..." href="{{promotion.href|raw}}" class="btn btn-o-success btn-cart">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {% endfor %}
            </div>
        </div>
    </div>
</main>
<script>
    $(function() {
        var _url = "{{submit_url|raw}}";
        $('[name=sort]').val('{{sort}}'||'latest');
        $('[name=limit]').val('{{limit}}'||'10');
        $('select').on('change', function() {
            $('select').each(function() {
                var _name = $(this).attr('name'),
                    _val = $(this).val();
                _url = _url + '&' + _name + '=' + _val;
            })
            location.href = _url;
        });


        $('.btn-cart').on('click', function() {
            var _btn = $(this);
            $.ajax({
                url: 'index.php?route=checkout/cart/add',
                type: 'post',
                data: {
                    product_id: _btn.data('product_id')
                },
                dataType: 'json',
                beforeSend: function() {
                    _btn.button('loading');
                },
                complete: function() {
                    _btn.button('reset');
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

                        $('#cart > button').html('<i class="fa fa-shopping-cart"></i> ' + json['total']);

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
        });
    })
</script>
<?php echo $content_bottom ?>
<?php echo $footer; ?>