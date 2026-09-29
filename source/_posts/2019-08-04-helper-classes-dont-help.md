---
extends: _layouts.post
section: content
title: Helper classes don't help
tags: []
categories: [php]
published: true
language: en
post_date: 04.08.2019
---

Some time ago I wrote a post on my hate towards static methods and helper classes. It was more of an emotional rant than anything else and didn't serve the educational purpose. So this is a rewrite of the original post, which I hope can provide more insight.

To begin with, a static method is a method, that can be invoked without instantiating an object of that class. The most common usage of static methods I've seen are helper classes and singleton pattern. A helper class is a collection of static methods, which hopefully has some common topic. So it may look like:
```php
// /helpers/FormatHelper.php
class FormatHelper
{
    public static function formatXml($xmlString) {...}
    public static function formatJson($jsonString) {...}
}
```

and the usage would be:

```php
// /lib/ServiceClient.php
$this->getLogger()->debug(FormatHelper::formatXml($response));
```

I hope you get the idea. So here is where I see the problem. <!--more-->

#### Cohesion
Cohesion is a metric of how much parts of a module or class belong together. You should aim at having cohesive classes. Each class should have a precisely defined task, do that and nothing more. Helper classes usually have methods that are all over the place. Even if there is some general idea, e.g. `DateHelper`, it's methods can still do a multitude of things: parsing, converting, formatting, calculation. Very often helpers classes are just a dump of functions that would otherwise have one common word in name.

#### Hidden Global State
An object is a set of data and functions or methods that operate on this particular data. By instantiating a second object we create another set of data which is independent of the first one. You have control over the data you work with. However, helpers and static methods in general do not require an object instance, but that by no means prevent you from having data to work with. Data (class variables) can too be declared static. This data is shared by all instances of a class as well as static methods. This can easily lead to unpredictable behavior in your system, because someone in another part of the system started using your helper and it changes the data in the way you don't expect.

#### Dependency
Every time you call another class, you create a dependency on this class. Since we want to build complex system, it's inevitable that some components will depend on another. We manage these dependencies to hinder coupling problems, for example by [dependency inversion][1]. But by calling a static method you create a rigid connection, that cannot be replaced. Moreso, it's not a dependency that is detectable by just looking on class definitions. Unless you look into the code (and you are lucky if there is a `use` statement), you will never know this dependency is even there.

#### Connascence
If you have a helper, you kinda want to use it everywhere, otherwise what's the point. Some day you may decide to add another parameter to a static function. This may incur a huge wave of changes to every place using this helper. This means your [connascence][2] is high. If your function will never change and is very specific, there is no benefit in putting it into a helper at all. If it's very abstract, you will need to have enough parameters to suit all the cases you may have in the projects. And then you never touch the function, because you can't guarantee the system will work if you do. Instead, you could just build normal functions within the classes that need this logic.

#### Reasonable Usage

With regard to all the above, there are some legitimate usages of static methods. The most obvious is alternative constructors. And yes, constructor itself is a static function with a special syntax, it creates the instance of a class, which does not exist prior to that. Sometimes you need to be able to create an object instance in different ways, e.g. from a serialized data, from a subclass and so on. Beyond that it's hard for me to imagine another non-exotic case, where static methods would be appropriate.


[1]: https://en.wikipedia.org/wiki/Dependency_inversion_principle
[2]: https://en.wikipedia.org/wiki/Connascence
