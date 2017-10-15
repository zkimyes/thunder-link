<div id="cart">
    <a href="<?php echo $cart; ?>" class="btn-cart-o">
        <i class="fa fa-shopping-cart"></i> {% if text_items != 0 %}<span id="cart-total"><?php echo $text_items; ?></span>{% endif %}
    </a>
    <button style="margin-left:30px" type="button"  data-toggle="modal" data-target="#chat_now" class="btn-cart-o"><i class="fa fa-comments"></i></button>
</div>