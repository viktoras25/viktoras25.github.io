---
extends: _layouts.post
section: content
title: Forget about DRY
tags: []
categories: []
published: true
language: en
post_date: 13.08.2017
---

I've once had a heated discussion with my colleagues, which eventually motivated me to write this blog post. This goes about DRY programming principle, being oh so loved by many developers. I'm convinced, that many do not really understand what does this principle really promote. DRY suffers from what I would call an "imprinting fallacy" (trying to mimic senior colleagues, while taking barely understood concepts to extreme), the same way the Singleton design pattern does.

An inexperienced developer, lets say Joe, starts working in a team, where words like "design patterns" are frequently used. Joe looks through some online articles and sees a lot of scary words and complex schemes. But then a simple enough passage pops up - a single instance of some class. So Joe starts to use Singleton extensively, as he thinks it makes him a more senior developer, because he now uses a design pattern. He does not know about all the hidden flaws he's building into the project. Same goes for DRY. It's deceptively easy to understand, while the devil is in the details. DRY - Don't repeat yourself, don't duplicate programming code, what's more to it? The same Joe, is happy to use a programming principle he has heard about. He vigorously finds out all repeated lines of code and extracts them into separate (usually into static methods) classes. By doing that, he is most likely damaging the project once again.
<!--more-->

DRY principle is most likely not what you think it is. The idea comes from the book "The Pragmatic Programmer" by Andrew Hunt and David Thomas and is defined as follows:

<blockquote>Every piece of knowledge must have a single, unambiguous, authoritative representation within a system.</blockquote>

It's not about duplicating code, the idea behind the principle is far grander.[^1] It is to have one single source of knowledge, so that changes to project requirements would only affect that source. The rest - data storage, UI, code, documentation should tap into this source and update accordingly. Because if they don't, then your project is full of duplication. Code represents the same knowledge documentation does, but in a machine-readable way, rather that a human-readable. UI form duplicates database structure, because it needs to show all the same fields a DB table has. Even the comments in your code duplicate some knowledge, because they also can get outdated. So you see, that referring to DRY is not actually an argument in favor of code deduplicaton, as it's a project-level approach.

But still, what about code duplication? If you change some code, you would likely need to update all the duplicated parts as well, so that a system remains consistent. This means more work and potentially bugs due to inconsistent behavior if you forget to update every place. Code duplication is just one side of the problem. What if a change to the code in one place requires a change in another place even if there is no apparent code duplication? Same thing, more work and potentially buggy software. It's not just duplication itself which is problematic, it's connascence[^2].

You have probably heard about cohesion and coupling, software quality metrics which help to reason about quality of the code. Connascence is a great addition to them. The stronger the form of connascence is, the more difficult and costly it is to change the elements in the relationship. I absolutely recommend watching this [video](https://www.youtube.com/watch?v=Ip2o4vbAK3s&t=741), a session by Josh Robb about Connascence & Coupling. I don't think I could give a better overview and explanation on the topic, so I humbly leave it to others.

So now we know, that duplication is not harmful by itself, rather than by inducing a connascence of algorithm. By duplicating the code we expect different parts to behave the same way and a change in one part requires a change in the copy. But what if the copy does not have to be updated with the original? What if it's a completely separate module, or even a separate project? The way we process some file format in different modules may be identical now, but may be not so in the future. It is the accursed code duplication, but there is no connascence and there is also no coupling! By duplicating the code we've achieved the best level of these metrics. If you follow the way of deduplication, you will have to introduce coupling and eventually connascence. These modules will depend on the same library, and a change in the library may require a change in both modules, which we initially tried to avoid.

There is no one single principle or rule to live by. Using some principle may make you break another, but that is fine, because these are just guidelines and not unbreakable laws of existence. Every situation is unique and you need to think carefully and choose what better suits yours.

[^1]: <a title="A Conversation with Andy Hunt and Dave Thomas by Bill Venners" href="http://www.artima.com/intv/dry.html">A Conversation with Andy Hunt and Dave Thomas by Bill Venners</a>
[^2]: <a title="Connascence" href="https://en.wikipedia.org/wiki/Connascence_(computer_programming)">Connascence - Wikipedia</a>
