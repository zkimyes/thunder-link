<?php echo $header; ?>
<div class="container login">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li>
      <a href="<?php echo $breadcrumb['href']; ?>">
        <?php echo $breadcrumb['text']; ?>
      </a>
    </li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i>
    <?php echo $success; ?>
  </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>
    <?php echo $error_warning; ?>
  </div>
  <?php } ?>
  <div class="row">
      <?php echo $content_top; ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-ghost">
            <div class="panel-heading">
               <h3>
                Log In
              </h3>
              Please sign in to access your account.
            </div>
            <div class="panel-body">
              <form action="{{action}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label" for="input-email">Email</label>
                  <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email"
                    class="form-control" />
                </div>
                <div class="form-group">
                  <label class="control-label" for="input-password">Password</label>
                  <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password"
                    class="form-control" />
                  <a href="<?php echo $forgotten; ?>">
                    <?php echo $text_forgotten; ?>
                  </a>
                </div>
                <input type="submit" value="Sign In" class="btn btn-o-success pull-right" />
                <?php if ($redirect) { ?>
                <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                <?php } ?>
              </form>
              <div class="login-by-3td-way">
                  <p>Login by other ways:</p>
                  <ul class="list-inline">
                    <li><a href=""><img src="/image/u1982_mouseOver.png" alt=""></a></li>
                    <li><a href=""><img src="/image/u1984_mouseOver.png" alt=""></a></li>
                    <li><a href=""><img src="/image/u1986_mouseOver.png" alt=""></a></li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-ghost">
            <div class="panel-heading">
              <h3>
                {{text_new_customer}}
              </h3>
              <p>Register and create an account for:</p>
            </div>
            <div class="panel-body">
              <p>—Easy tracking via your order history</p>

              <p>—Faster checkout with an address book</p>

              <p>—Email updates upon new arrivals and promotions</p>

              <p>—Free&Immediate technical support</p>
              <a href="<?php echo $register; ?>" class="btn btn-o-success pull-right" style="margin-top:35px;">
                Register 
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php echo $content_bottom; ?>
    </div>
  </div>
</div>
<?php echo $footer; ?>