<?php echo $header; ?>
<?php echo $content_top ?>
<main id="_configure" class="main configure">
    <div class="container">
        <div class="eg clearfix mt30">
            {% for category in categorys %}
            <div class="col-md-2">
                <a href="{{category.url|raw}}" class="eg-block {% if category.category_id == category_id %} actived {% endif %}">
                    <div class="col-md-5">
                        <img src="{{category.thumb}}" alt="{{category.name}}">
                    </div>
                    <div class="col-md-7">{{category.name}}</div>
                </a>
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
                <div class="parmaters">
                    {% for parma in typical.parameter%}
                    <div class="row">
                        <div class="col-md-3"><strong>{{parma.name}}</strong></div>
                        <div class="col-md-8">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{parma.value}}" aria-valuemin="{{parma.min}}" aria-valuemax="{{parma.max}}" style="width: {{parma.value/(parma.max-parma.min)*100}}%;">
                                    <span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {% endfor %}
                </div>
                <div class="structure" style="margin-top:30px;">
                    <img src="{{typical.blueprint_thumb}}" alt="{{typical.name}}_structure">
                </div>
                <div class="boards" style="margin-top:20px">
                    <table class="table">
                        <tr>
                            <th>Board type</th>
                            <th>Board name</th>
                            <th>Qty</th>
                        </tr>
                        {% for board in typical.link_boards %}
                        <tr>
                            <td>
                                {% if board.type == 1 %} Sysrtem Board {% else %} {{board.name}} {% endif %}
                            </td>
                            <td>{{board.name}}</td>
                            <td>{{board.qty}}</td>
                        </tr>
                        {% endfor %}
                    </table>
                </div>
                <div class="caption">
                    <p><a href="#" class="btn btn-o-success pull-left" role="button">Quote</a> <a href="#" class="btn btn-o-success pull-right" role="button">Revise</a></p>
                </div>
            </div>

            {% endfor %}
        </div>

        <div class="text-center">
            <a href="{{select_url|raw}}" class="btn btn-lg btn-success config-self" href="">Self Configure</a>
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>