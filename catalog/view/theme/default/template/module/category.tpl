<div class="list-group">
    <div class="list-group-item active">{{top_category.name}}
        <i class="fa fa-angle-down pull-right" aria-hidden="true"></i>
    </div>
    {% for category in categories%} {% if child_id == category.category_id %}
    <a href="{{category.href|raw}}" class="list-group-item disabled">
        <i class="fa fa-angle-right"></i> {{category.name}}
    </a>
    {% else %}
    <a href="{{category.href|raw}}" class="list-group-item">
        {{category.name}}
    </a>
    {% endif %} {% endfor %}
</div>


{% if false %}
<div class="list-group" style="border:1px #ddd solid;padding:5px 10px;">
    <div>
        <h4>Product screening</h4>
    </div>
    <ul class="list-unstyled">
        {% for category in threeCategories%} {% if child_id == category.category_id %}
        <li>
            <a href="{{category.href|raw}}" class="list-group-item disabled">
                <i class="fa fa-angle-right"></i> {{category.name}}
            </a>
        </li>

        {% else %}
        <li>
            <a href="{{category.href|raw}}" class="list-item">
                {{category.name}}
            </a>

        </li>
        {% endif %} {% endfor %}
    </ul>

</div>


{% endif %}