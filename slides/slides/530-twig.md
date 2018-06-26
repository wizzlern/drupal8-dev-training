# Twig

--vv--

# The theming layer

![Flow diagram of theming data](assets/images/theme-data-diagram.png) <!-- .element: style="width: 35%;" -->

--vv--

# block.html.twig

```twig
{%
  set classes = [
    'block',
    'block-' ~ configuration.provider|clean_class,
  ]
%}
<div{{ attributes.addClass(classes) }}>
  {{ title_prefix }}
  {% if label %}
    <h2{{ title_attributes }}>{{ label }}</h2>
  {% endif %}
  {{ title_suffix }}
  {% block content %}
    {{ content }}
  {% endblock %}
</div>
```

--vv--

# breadcrumb.html.twig

```twig
{% if breadcrumb %}
  <nav class="breadcrumb" role="navigation" aria-labelledby="system-breadcrumb">
    <h2 id="system-breadcrumb" class="visually-hidden">{{ 'Breadcrumb'|t }}</h2>
    <ol>
    {% for item in breadcrumb %}
      <li>
        {% if item.url %}
          <a href="{{ item.url }}">{{ item.text }}</a>
        {% else %}
          {{ item.text }}
        {% endif %}
      </li>
    {% endfor %}
    </ol>
  </nav>
{% endif %}
```

--vv--

# Syntax
- {{ ... }} Provides output <br>Outputs a render array, plain text, a variable or (twig) function result.
- {% ... %} Controls <br>Examples: if, else, endif, for .. in ..
- {# ... #} Does nothing <br>This is where your documentation goes.

--vv--

# twig magic

When parsing `{{ sandwich.cheese }}` Twig will try to get data using these methods (in this order):

```php
$sandwich['cheese'];
$sandwich->cheese;
$sandwich->cheese();
$sandwich->getCheese();
$sandwich->isCheese();
$sandwich->__isset('cheese');
$sandwich->__get('cheese');
```

Examples:
```twig
{% if node.isPublished() %}

id="node-{{ node.id }}”

'node--type-' ~ node.bundle|clean_class
```

--vv--

# Functions
<!-- .slide: class="layout-two-col"-->

```twig
{{ example(...) }}
```

- Twig functions:
- addClass()
- removeClass()
- parent()
- cycle()
- constant()
- ~
- Drupal functions:
- url()
- link()
- path()
- url_from_path()
- public methods

More: http://twig.sensiolabs.org/doc/functions/index.html

--vv--

# Filters
<!-- .slide: class="layout-two-col"-->

```twig
{{ ...|example }}
```

- Twig filters:
- join()
- escape
- replace()
- default
- abs
- length
- Drupal filters:
- t, t()
- raw
- safe_join()
- without()
- clean_class
- clean_id

More: http://twig.sensiolabs.org/doc/filters/index.html

--vv--

# node.html.twig

```twig
{%
  set classes = [
    'node',
    'node--type-' ~ node.bundle|clean_class,
    node.isPromoted() ? 'node--promoted',
    node.isSticky() ? 'node--sticky',
    not node.isPublished() ? 'node--unpublished',
    view_mode ? 'node--view-mode-' ~ view_mode|clean_class,
  ]
%}
<article{{ attributes.addClass(classes) }}>

  {{ title_prefix }}
  {% if not page %}
    <h2{{ title_attributes }}>
      <a href="{{ url }}" rel="bookmark">{{ label }}</a>
    </h2>
  {% endif %}
  {{ title_suffix }}
 ...
```

--vv--

# node.html.twig

```twig
...
  {% if display_submitted %}
    <footer class="node__meta">
      {{ author_picture }}
      <div{{ author_attributes.addClass('node__submitted') }}>
        {% trans %}Submitted by {{ author_name|passthrough }} on {{ date|passthrough }}{% endtrans %}
        {{ metadata }}
      </div>
    </footer>
  {% endif %}

  <div{{ content_attributes.addClass('node__content') }}>
    {{ content|without('links') }}
  </div>

  {% if content.links %}
    <div class="node__links">
      {{ content.links }}
    </div>
  {% endif %}
</article>
```

--vv--

# Translation
- `{{ ...|t }}`
- `'...'|t({'@var': var})`
- `{% trans %} ... {% endtrans %}`

```twig
<body{{ attributes }}>
  <a href="#main-content" class="visually-hidden focusable">
    {{ 'Skip to main content'|t }}
  </a>
```

```twig
<div{{ author_attributes }}>
  {% trans %}Submitted by {{ author_name|passthrough }} on {{ date|passthrough }}{% endtrans %}
  {{ metadata }}
</div>
```

--vv--

# (Template) override

![Diagram of template override](assets/images/theme-template-override-diagram.png) <!-- .element: style="width: 60%;" -->
