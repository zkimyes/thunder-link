<?php echo $header; ?>
<?php echo $content_top ?>
<main id="_configure" class="main configure">
    <div class="container">
        <div class="eg clearfix mt30">
            {% for category in categorys %}
            <div class="col-md-2 eg-block">
                <div class="col-md-6">
                    <img src="{{category.thumb}}" alt="{{category.name}}">
                </div>
                <div class="col-md-6">{{category.name}}</div>
            </div>
            {% endfor %}
        </div>
        <div class="packages">

            {% for typical in typicals %}
            
            <div class="thumbnail eg">
                <h3 class="text-center">
                    {{typical.name}}
                </h3>
                <img src="{{typical.thumb}}" alt="{{typical.name}}">
                <div class="parameter">
                    <ul class="list-unstyled">
                        <li>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="structure">
                    <img src="/image/u10064.png" alt="">
                </div>
                <div class="boards">
                    <table class="table">
                        <tr>
                            <th>Board type</th>
                            <th>Board name</th>
                            <th>Qty</th>
                        </tr>
                        <tr>
                            <td>Sysrtem Board</td>
                            <td>N4GSCC</td>
                            <td>2</td>
                        </tr>
                    </table>
                </div>
                <div class="caption">
                    <p><a href="#" class="btn btn-o-success pull-left" role="button">Quote</a> <a href="#" class="btn btn-o-success pull-right" role="button">Revise</a></p>
                </div>
            </div>

            {% endfor %}
        </div>

        <div class="text-center">
            <a class="btn btn-lg btn-success config-self" href="">Self Configure</a>
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>