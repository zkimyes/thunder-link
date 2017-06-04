<?php echo $header; ?>
<?php echo $content_top ?>
<main id="_configure" class="main configure">
    <div class="container">
        <div class="eg clearfix mt30">
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="/image/p1.png" alt="">
                </div>
                <div class="col-md-6">OSN 3500</div>
            </div>
        </div>
        <div class="packages">
        <?php
            foreach($config_typical as $config){ ?>
                <div class="thumbnail eg">
                    <h3 class="text-center"><?php echo $config['name'] ?></h3>
                    <img src="<?php echo $config['img-url'] ?>" alt="">
                    <div class="parameter">
                        <ul class="list-unstyled">
                          <?php foreach($config['parameters'] as $param){ ?>
                            <li>
                                <div class="col-md-4">
                                    <?php echo $param['name']?>
                                </div>
                                <div class="col-md-8">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $param['range']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $param['range']?>%;">
                                            <span class="sr-only"><?php echo $param['range']?>% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                          <?php  } ?>
                        </ul>
                    </div>
                    <div class="structure">
                        <img src="/image/u10064.png" alt="">
                    </div>
                    <div class="boards">
                        <table class="table">
                            <tr><th>Board type</th><th>Board name</th><th>Qty</th></tr>
                            <tr><td>Sysrtem Board</td><td>N4GSCC</td><td>2</td></tr>
                        </table>
                    </div>
                    <div class="caption">
                        <p><a href="#" class="btn btn-o-success pull-left" role="button">Quote</a> <a href="#" class="btn btn-o-success pull-right" role="button">Revise</a></p>
                    </div>
                </div>
        <?php }?>
        </div>

        <div class="text-center">
            <a class="btn btn-lg btn-success config-self" href="">Self Configure</a>
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>