---
extends: _layouts.post
section: content
title: "Symfony: Symfony Day 2010 в Кёльне"
tags: [symfony]
categories: [php]
published: true
language: ru
post_date: 04.07.2011
---

<img class="oppic" src="/img/symfony_logo.gif"/>
Как, наверное, некоторые из вас знают, 8 октября прошла конференция Symfony Day 2010 в Кёльне, на которой мне посчастливилось присутствовать. Я случайно наткнулся на сайт, [http://www.symfonyday.com/](http://www.symfonyday.com/), и сразу же решил, что хочу туда. Вход стоил 120 евро, но я успел как early bird за 80. Путь мой начинался с самой восточной границы Германии, и лежал почти до западной, более 550 километров, причем ночью. Не хотелось тратиться на гостиницу, а тут еще подвернулся вариант с CNL (ночным) поездом, я думал, что это вроде плацкартного. Как выяснилось, место у меня сидячее, в купе едут по 6 человек, спать было почти невозможно. Так что приехал я в Кёльн за 3 часа до конференции весьма измотанный.<!--more-->

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7696.jpg"></p>

На входе в медиа-центре Komed, где происходило действие, красовались флаги Symfony Day. Нам выдали беджики, и мы пошли в зал. Было еще рано, поэтому народу почти не было, зато на экране запустили Twitterwall - прямую трансляцию из Твиттера по хештегу #sfdaycgn, сделанную с помощью node.js. Я не преминул возможностью передать привет всем присутствующим от друзей из Russian Symfony User Group :).

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7700.jpg"></p>

Первым выступал Jonathan Wage, который рассказал о работе Doctrine 2 с Mongo DB. Он вкратце обьяснил что же за зверь такой этот Mongo DB, и привел примеры, как с помощью Doctrine делать самые обычные действия - прочитать/вставить/удалить. 

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7702.jpg"></p>

Доклад был интересным, однако слушал я с трудом. Сказалась ночь в поезде и меня жутко клонило в сон. Не припомню когда я еще проявлял столько воли, чтобы не засыпать и не зевать. Сразу после я побежал заливаться кофе, а вы пока можете посмотреть слайды. 

<div style="width:425px" id="__ss_5393200"><object id="__sse5393200" width="425" height="355"><param name="movie" value="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=symfonyday2010mongodbodm-101008082122-phpapp01&stripped_title=symfony-day-2010-doctrine-mongodb-odm&userName=jwage" /><param name="allowFullScreen" value="true"/><param name="allowScriptAccess" value="always"/><embed name="__sse5393200" src="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=symfonyday2010mongodbodm-101008082122-phpapp01&stripped_title=symfony-day-2010-doctrine-mongodb-odm&userName=jwage" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="355"></embed></object></div>

Вторым выступал core developer PHP Pierre Joye. 

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7704.jpg"></p>

Этот доклад был наполнен юмором. Если доклад Джонатана был вроде утренних новостей, то доклад Пьера как первая развлекательная передача дня. Рассказ был о том, как развивается PHP, какие есть недостатки, и что с этим можно делать. В зале нашелся человек, который до сих пор пользуется PHP4. Угадайте, какую CMF он использует? Правильно, Drupal. А вот вам цитатка:"A lot of idiots use PHP. For example.. (slide) Microsoft". Главным слайдом презентации можно считать "PHP is ugly". Да, разработчик PHP признает, что язык уродлив. Но мы же не художники в конце концов. Нам не о красоте надо думать, а о том, как создавать проекты, которые будут успешно работать. К тому же, если использовать Symfony, то недостатки заметны меньше. Да и помимо Symfony написано достаточно хороших фреймворков, и вряд ли есть большой спрос на новые. 

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7705.jpg"></p>

"Кто вообще писал новый фреймворк за последние два года",- вопрошал Пьер. Руку поднял один человек в зале - Фабьен Потенсьер :) Все засмеялись и заапплодировали. Важной мыслью было то, что PHP уже достиг того когда он почти никогда не является "бутылочным горлышком". "Если вам не хватает производительности PHP - то вы Facebook".

<div style="width:425px" id="__ss_5392819"><object id="__sse5392819" width="425" height="355"><param name="movie" value="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=phpsymfonyandsoftwarelifecycle-101008073640-phpapp01&rel=0&stripped_title=php-symfony-and-software-lifecycle&userName=pierrej" /><param name="allowFullScreen" value="true"/><param name="allowScriptAccess" value="always"/><embed name="__sse5392819" src="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=phpsymfonyandsoftwarelifecycle-101008073640-phpapp01&rel=0&stripped_title=php-symfony-and-software-lifecycle&userName=pierrej" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="355"></embed></object></div>

Пока был перерыв перед следующим докладом - я сделал фотографию зала. По количеству стульев можно прикинуть, что было человек 150. А выступал третьим Christian Schaefer (Кристиан Шефер), симфони-блоггер. Может я ошибаюсь, но мне показалось, что у него не очень большой опыт подобного рода выступлений - в основном он повторял то, что было написано на слайдах. Тем не менее, слушать было интересно. А речь шла о Unit-тестировании плагинов с помощью PHPUnit. О том, как все правильно настроить, и как тесты запускать. 

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7706.jpg"></p>
<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7708.jpg"></p>
<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7710.jpg"></p>
<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7711.jpg"></p>

<div style="width:425px" id="__ss_5401851"><object id="__sse5401851" width="425" height="355"><param name="movie" value="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=unittestingsymfonypluginswithphpunit-101009132914-phpapp01&stripped_title=unit-testing-symfony-plugins-with-php-unit-5401851&userName=caefer" /><param name="allowFullScreen" value="true"/><param name="allowScriptAccess" value="always"/><embed name="__sse5401851" src="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=unittestingsymfonypluginswithphpunit-101009132914-phpapp01&stripped_title=unit-testing-symfony-plugins-with-php-unit-5401851&userName=caefer" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="355"></embed></object></div>

После третьего доклада был перерыв, и в холле можно было было вкусно покушать. А я же в первую очередь побежал делать эту фотографию. Так же в перерыве познакомились и немного поболтали с Антоном Бобенко, сам он из Украины, работает в Норвегии. Не знаю, был ли кто-нибудь еще из русскоязычных.

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7713.jpg"></p>
<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7715.jpg"></p>

Подошло время четвертого доклада, выступал Крис Уолсмит. Довольно вальяжно и, может быть даже, слегка небрежно Крис рассказал о различных техниках, которые можно применить в проекте. Например, если закончилась сессия, пока редактировалась форма, или как динамически добавлять несколько встроенных форм. Пожалуй, в этом докладе были наиболее полезные советы, которые можно применить на практике. Единственное что под конец каждого примера я уже терялся в коде и не мог полностью понять все детали. Тем не менее общую идею уловил и понял. 

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7717.jpg"></p>
<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7719.jpg"></p>

<div style="width:425px" id="__ss_5396592"><object id="__sse5396592" width="425" height="355"><param name="movie" value="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=advanced-symfony-techniques-101008164721-phpapp02&stripped_title=advanced-symfony-techniques&userName=kriswallsmith" /><param name="allowFullScreen" value="true"/><param name="allowScriptAccess" value="always"/><embed name="__sse5396592" src="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=advanced-symfony-techniques-101008164721-phpapp02&stripped_title=advanced-symfony-techniques&userName=kriswallsmith" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="355"></embed></object></div>

Следующим выступал Гейлорд Олке (Gaylord Aulke). Этот доклад был, я думаю, не столько для программистов, сколько для работников отдела продаж. Гейлорд рассказал о том, как представить клиенту выбор, покупать готовый сайт, который можно просто запустить, или заказывать разработку, которая займет время, но зато проект будет соответствовать пожеланиям клиента. Есть еще третий вариант - построить проект из модулей.

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7721.jpg"></p>

Последним выступал Фабьен Потенсьер. Речь шла о Symfony2, которая должна быть готова к марту 2011. Во-первых, для темплейтов можно будет использовать шаблонизатор Twig. И хотя поддержка чистого PHP останется, Twig гораздо более прост для восприятия и использования непрограммистом. Пользователь, как объект, теперь не привязан к сессии, пользовательские данные можно будет хранить в конфиг-файле (например, если нужен только один админ), можно будет одновременно аутентифицировать пользователей через БД, LDAP и конфиг файлы. Формы можно будет показывать с помощью темплейтов, того же твига. В общем масса изменений, все будет супер-круто. Ну и приложу слайд, который будет во всех блогах и отчетах про конференцию :)  

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7723.jpg"></p>
<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7724.jpg"></p>

<div style="width:425px" id="__ss_5399986"><object id="__sse5399986" width="425" height="355"><param name="movie" value="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=symfony2-101009070646-phpapp02&stripped_title=the-state-of-symfony2-symfonyday-2010&userName=fabpot" /><param name="allowFullScreen" value="true"/><param name="allowScriptAccess" value="always"/><embed name="__sse5399986" src="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=symfony2-101009070646-phpapp02&stripped_title=the-state-of-symfony2-symfonyday-2010&userName=fabpot" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="355"></embed></object></div>


Фабьен дольше всех отвечал на вопросы, что в общем неудивительно. Когда все закончилось в холле было бесплатное пиво, небольшой конкурс с призами (я ничего не выиграл), можно было набрать наклеек. Ощущения, конечно, самые позитивные. Больше всего понравились выступления Пьера Жойе и Фабьена Потенсьера, а самым полезным я считаю доклад Криса Уолсмита. Приложу еще фотографию Кёльнского собора, раз уж я там был, грех был бы не посмотреть.

<p class="img"><img src="/img/posts/2010-10-11-symfony-day/dsc_7728.jpg"></p>

Через пару часов я сел на поезд и отправился домой, опять более чем 550 километров сидя, ночью. Поспать мне опять не удалось и после двух бессонных ночей чувствовал я себя.. да почти не чувствовал. Но эти мелочи не могли повлиять на удовольствие, которое я получил на конференции: побыл среди умных людей, послушал выступления и вообще классно провел время.</p>

Для эксперимента еще выложил фотографии на <a href="http://www.flickr.com/photos/54686499@N02/5064087515/in/set-72157625000809289/">flickr</a>.
