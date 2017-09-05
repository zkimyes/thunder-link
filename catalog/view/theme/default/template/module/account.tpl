<!-- <div class="list-group">
    <?php if (!$logged) { ?>
    <a href="<?php echo $login; ?>" class="list-group-item">
        <?php echo $text_login; ?>
    </a>
    <a href="<?php echo $register; ?>" class="list-group-item">
        <?php echo $text_register; ?>
    </a>
    <a href="<?php echo $forgotten; ?>" class="list-group-item">
        <?php echo $text_forgotten; ?>
    </a>
    <?php } ?>
    <a href="<?php echo $account; ?>" class="list-group-item">
        <?php echo $text_account; ?>
    </a>
    <?php if ($logged) { ?>
    <a href="<?php echo $edit; ?>" class="list-group-item">
        <?php echo $text_edit; ?>
    </a>
    <a href="<?php echo $password; ?>" class="list-group-item">
        <?php echo $text_password; ?>
    </a>
    <?php } ?>
    <a href="<?php echo $address; ?>" class="list-group-item">
        <?php echo $text_address; ?>
    </a>
    <a href="<?php echo $wishlist; ?>" class="list-group-item">
        <?php echo $text_wishlist; ?>
    </a>
    <a href="<?php echo $order; ?>" class="list-group-item">
        <?php echo $text_order; ?>
    </a>
    <a href="<?php echo $download; ?>" class="list-group-item">
        <?php echo $text_download; ?>
    </a>
    <a href="<?php echo $recurring; ?>" class="list-group-item">
        <?php echo $text_recurring; ?>
    </a>
    <a href="<?php echo $reward; ?>" class="list-group-item">
        <?php echo $text_reward; ?>
    </a>
    <a href="<?php echo $return; ?>" class="list-group-item">
        <?php echo $text_return; ?>
    </a>
    <a href="<?php echo $transaction; ?>" class="list-group-item">
        <?php echo $text_transaction; ?>
    </a>
    <a href="<?php echo $newsletter; ?>" class="list-group-item">
        <?php echo $text_newsletter; ?>
    </a>
    <?php if ($logged) { ?>
    <a href="<?php echo $logout; ?>" class="list-group-item">
        <?php echo $text_logout; ?>
    </a>
    <?php } ?>
</div> -->

<div class="panel panel-default">
  <div class="panel-heading">
    My Account
  </div>
  <div class="panel-body list-group" style="padding:0">
        <a class="list-group-item" href="{{order|raw}}">My Orders</a>
        <a class="list-group-item" href="{{return|raw}}">My RMA</a>
  </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Account Settings
      </div>
      <div class="panel-body list-group" style="padding:0">
            <a class="list-group-item" href="{{address|raw}}">My Address</a>
            <a class="list-group-item" href="{{edit|raw}}">Account Settings</a>
            <a class="list-group-item" href="{{password|raw}}">Change Your Password</a>
            <a class="list-group-item" href="{{reviews|raw}}">My Reviews</a>
      </div>
</div>


