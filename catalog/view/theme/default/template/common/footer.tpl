<footer class="footer">
    <div class="bottom-links">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
              <?php if ($informations) { ?>
                <div class="col-md-3">
                  <h5><?php echo $text_information; ?></h5>
                  <ul class="list-unstyled">
                    <?php foreach ($informations as $information) { ?>
                    <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                    <?php } ?>
                  </ul>
                </div>
                <?php } ?>
                <div class="col-md-3">
                  <h5><?php echo $text_service; ?></h5>
                  <ul class="list-unstyled">
                    <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                    <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                    <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
                    <li><a href="{{return|raw}}">Returns</a></li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <h5><?php echo $text_extra; ?></h5>
                  <ul class="list-unstyled">
                    <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
                    <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
                    <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
                    <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <h5><?php echo $text_account; ?></h5>
                  <ul class="list-unstyled">
                    <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                    <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                    <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                    <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
                  </ul>
                </div>
          </div>
         <div class="col-md-3">
            <div id="logo">
                <?php if ($logo) { ?>
                <a href="<?php echo $home; ?>"><img style="width:200px" src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                <?php } else { ?>
                <h1>
                    <a href="<?php echo $home; ?>">
                        <?php echo $name; ?>
                    </a>
                </h1>
                <?php } ?>
            </div>
            <div><i class="fa fa-phone"></i> {{telephone}}</div>
            <div><i class="fa fa-envelope-o"></i> <a href="mailto:sales@Thunder-Link.com">Sales@Thunder-Link.com</a></div>
            <div><i class="fa fa-envelope-o"></i> <a href="mailto:supports@Thunder-link.com">Supports@Thunder-link.com</a></div>
         </div>
        </div>
        <hr>
      <div class="copyrights text-center"><?php echo $powered; ?></div>
    </div>
  </div>
</footer>

</body></html>