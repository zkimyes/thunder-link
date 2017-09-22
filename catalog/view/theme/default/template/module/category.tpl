<div class="list-group">
    <div class="list-group-item active">{{top_category.name}} <i class="fa fa-angle-down pull-right" aria-hidden="true"></i></div>
     {% for category in categories%}
        {% if child_id == category.category_id %}
            <a href="{{category.href|raw}}" class="list-group-item disabled">
              <i class="fa fa-angle-right"></i>       {{category.name}}
            </a>
        {% else %}
            <a href="{{category.href|raw}}" class="list-group-item">
                {{category.name}}
            </a>
        {% endif %}
     {% endfor %}
</div>