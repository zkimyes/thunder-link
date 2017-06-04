<?php echo $header; ?>
<?php echo $content_top ?>
<main id="_configure" class="main configure">
    <div class="container">
        <div class="clearfix mt30">
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

        <div class="packages-setting row">
            <div class="col-md-8 setting-content">
                <div class="col-md-3 tab-menu">
                    <ul>
                        <?php foreach($board_category as $cate){ ?>
                        <li>
                            <a class="">
                                <?php echo $cate['name'] ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-9 tab-content">
                    <ul>
                        <li>
                            <div class="col-md-7">
                                <div class="title">SSN2GSCC</div>
                                <div class="desc">Description:System Control and Communication Board </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">-</button>
                                            </span>
                                    <input type="text" class="form-control" placeholder="0">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">+</button>
                                            </span>
                                </div>
                            </div>
                            <div class="col-md-2"><button class="btn btn-default">Choose</button></div>
                        </li>
                        <li>
                            <div class="col-md-7">
                                <div class="title">SSN2GSCC</div>
                                <div class="desc">Description:System Control and Communication Board </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">-</button>
                                            </span>
                                    <input type="text" class="form-control" placeholder="0">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">+</button>
                                            </span>
                                </div>
                            </div>
                            <div class="col-md-2"><button class="btn btn-default">Choose</button></div>
                        </li>
                        <li>
                            <div class="col-md-7">
                                <div class="title">SSN2GSCC</div>
                                <div class="desc">Description:System Control and Communication Board </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">-</button>
                                            </span>
                                    <input type="text" class="form-control" placeholder="0">
                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">+</button>
                                            </span>
                                </div>
                            </div>
                            <div class="col-md-2"><button class="btn btn-default">Choose</button></div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="thumbnail">
                    <h3 class="text-center">OSN3500 Platinum Line</h3>
                    <img src="/image/u672.png" alt="">
                    <div class="boards">
                        <table class="table">
                            <tr><th>Board type</th><th>Board name</th><th>Qty</th><th></th></tr>
                            <tr><td>Sysrtem Board</td><td>N4GSCC</td><td>2</td><td>DELETE</td></tr>
                        </table>
                    </div>
                    <div class="caption clearfix">
                        <p><a href="#" class="btn btn-o-success pull-left" role="button">Eliminate</a> 
                        <a href="#" class="btn btn-o-success pull-right" role="button">Quote</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php echo $content_bottom ?>
<?php echo $footer; ?>