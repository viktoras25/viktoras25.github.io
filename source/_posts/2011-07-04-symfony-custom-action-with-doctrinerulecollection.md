---
extends: _layouts.post
section: content
title: "Symfony: свой экшен в DoctrineRouteCollection"
tags: [routing, symfony]
categories: [php]
published: true
language: ru
post_date: 04.07.2011
---

<img class="oppic" src="/img/symfony_logo.gif"/>Я часто сталкивался с необходимостью указать путь к своему экшену, например в link_to. До какого-то времени для меня вполне работал вариант 'module/action?parameter=value'. Однако, в один прекрасный день, количество таких ссылок возросло до нескольких сотен на странице. И они порядком тормозили, потому что роутингу приходилось проверять все указанные роуты, перед тем как использовать default. Решением в таких случаях являются именованные роуты, например '@users'. Но вот вопрос, как сделать именованный роут для админ генеренного модуля. Для таких модулей, добавляется DoctrineRouteCollection роут, который на самом деле генерит 7 роутов module_new, module_list и т.д.

Ну и вот мы делаем такой финт ушами: 
```yaml
modules:
  class: sfDoctrineRouteCollection
  options:
    model:                modules
    module:               modules
    prefix_path:          /modules
    column:               module_id
    with_wildcard_routes: true
    object_actions:       { action1: GET, action2: GET }
  requirements:
    module_id:        \d+
```

В сгенеренный роут я добавил параметр object_action, после чего этот роут будет так же генерить роуты @modules_action1 и @modules_action2, что нам собственно и нужно. А GET - это тип запроса, на который будет отзываться новоделанный роут.
