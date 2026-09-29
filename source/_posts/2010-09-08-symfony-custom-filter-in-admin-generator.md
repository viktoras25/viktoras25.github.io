---
extends: _layouts.post
section: content
title: "Symfony: свой фильтр в admin generator"
tags: [admin generator, form filter, symfony]
categories: [php]
published: true
language: ru
post_date: 08.09.2010
---

<img class="oppic" src="/img/symfony_logo.gif"/>Кратко о том, как сделать фильтр для админ генератора. В моем проекте используется Doctrine с поведением NestedSet, и фильтр мне нужен был по родительскому полю. Точнее, показать потомков выбранного элемента. Для этого я пошел в папку /lib/filters и открыл файл фильтров для нужной модели. Там будем править метод configure. В моем случае дело происходит в плагине, поэтому метод, который я буду править называется setupInheritance.<!--more-->

```php
public function  setupInheritance() {
    parent::setupInheritance();

    $this->widgetSchema['parent'] = new sfWidgetFormDoctrineChoiceNestedSet(array(
        'model' => 'MODEL_NAME',
        'add_empty' => true
    ));
    $this->validatorSchema['parent'] = new sfValidatorDoctrineChoice(array(
        'model' => 'MODEL_NAME',
        'required' => false
    ));
}
```

Добавили виджет и валидатор. sfWidgetFormDoctrineChoiceNestedSet это простой DoctrineChoice, в котором есть отступы и сортировка в соответствии с иерархией в NestedSet. Теперь наш виджет виден в форме, правда ни на что пока не влияет. Чтобы на что-то влиять, нам надо добавить его в список полей фильтра в том же файле.

```php
public function getFields() {
    $fields = parent::getFields();
    $fields['parent'] = 'NestedNode';

    return $fields;
}
```

Здесь надо обратить внимание не только на значение, но и на имя ключа в массиве. В качестве значения можно указывать "Number", "Text", "Date" и некоторые другие. Я не пробовал, но полагаю, что если указать одно из них, то сработает стандартный обработчик поля фильтра, как например addNumberQuery. В нашем случае формат нестандартный и обработчик будем делать сами.

Кстати говоря, если в данный момент посмотреть на наш проект - нам выбросят исключение, где будет сказано как надо назвать метод, который будет обрабатывать наше поле. В моем случае это addParentColumnQuery. Формат названия функции, скорее всего такой: add_COLUMN_NAME_ColumnQuery. А собственно вот и она сама:

```php
public function addParentColumnQuery($q, $element, $value) {
    $parent = Doctrine::getTable('MODEL_NAME')->findOneById($value);
    return $q->andWhere('lft > ?', $parent->getLft())->andWhere('rgt < ?', $parent->getRgt());
}
```

Получаем Doctrine_Query в качестве параметра $q, добавляем свои условия и возвращаем. Все легко и просто. Наздоровье :)

Референс: [http://robert-says.com/2010/03/symfony-how-to-add-a-custom-filter-for-the-admin-listing](http://robert-says.com/2010/03/symfony-how-to-add-a-custom-filter-for-the-admin-listing)
