---
extends: _layouts.post
section: content
title: Why do I hate static methods
tags: []
categories: [php]
published: true
language: en
post_date: 10.05.2015
---

Every time I use a static method I feel embarassed, like I'm doing something shameful. Or when I see a Pull-Request with a bunch of static methods I think "Why? Why did you have to do it this way?". I dont want to push my beliefs on the others, so I don't decline those PRs. At least they get the work done. However I feel it's time to express why do I hate static methods.

To begin with, a static method is a class method, that can be invoked without instantiating a class. The most common usage I've seen are helper classes (oh my god I do also hate helper classes) and singletones. Let's look at those helper classes from another point of view. We have some set of methods, that, let's say, format a string in different ways. So we have

```php
class Helper
{
   public static formatA() {...}
   public static formatB() {...}
   public static formatC() {...}
}
```
The thing is, it has absolutely no difference from:

```php
function helper_formatA() {...}
function helper_formatB() {...}
function helper_formatC() {...}
```

Why would you bother writing this within a class instead of just a set of functions? Is it because you think you are using Object-Oriented Programming and writing **class** keyword makes your code better? I feel, like using static methods this way is a step away from the ideas of the OOP. This is not an instance of a class anymore.

So we have used this static method somewhere in the code:

```php
// .. within some class
public function foo()
{
    // ...
    Helper::formatA('bar');
}
```
our module is now dependent on that static class. Can you tell by looking at the class API that it has that dependency? No you don't. It's a hidden dependency that can hit you when you don't expect it. If you extract your class into some library for common usage, you can suddenly find out, that you have to include Helper too. Moreover, this is a tight dependency, you can not substitute a call to this class by some other helper. And the more you use those static methods, the more dependencies you have in your project, that will entangle it like a spider web.

A singletone is absolutely no better. But how do I ensure, that I have just a single connection to my DB, you may ask? Well, you can instantiate it once at the bootstrapping, put it in the service container and reuse it. True, you will end up with more code that before, but if you want your project to be flexible you have to accept abstraction costs.

The same goes for the Helper Formatter example. Take an advantage of passing an instance of a Formatter class as a dependency injection. Use an interface as a type hinting to make it loosely coupled and be easily replacable. And then your method will depend on an abstraction rather than a specific object.

Usage of static methods can probably be explained somehow, the same way as a usage of goto. I used goto [once][1], because of the PHP 'continue 2' memory leak bug. But under normal circustumstances I don't think there is a justification of using a static method.

[1]: https://github.com/mtdowling/cron-expression/issues/50#issuecomment-41650357
