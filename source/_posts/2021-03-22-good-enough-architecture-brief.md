---
extends: _layouts.post
section: content
title: "'Good Enough' Architecture by Stefan Tilkov Brief"
tags: [architecture, brief]
categories: []
published: true
language: en
post_date: 22.03.2021
---

Takeouts from a talk from GOTO 2019 conference "'Good Enough' Architecture" by Stefan Tilkov. Found on [youtube](https://www.youtube.com/watch?v=PzEox3szeRc).

<div class="text-center">
    <img class="img-fluid" src="/img/posts/2021-03-22-good-enough-architecture-brief/1-intro.jpg" alt="intro">
</div>

Theory:
_"Architecture represents the significant design decisions that shape a system, where significant is measure by cost of change"._ (Grady Booch)

Practice:
_"Whatever the architect considers important enough to merit their attention"_

There can be lots of things that really don't matter, that should be left to the developer. At the same time there are many important things are not being considered.

<!--more-->

#### Misconceptions

Architecture is not an upfront activity performed by somebody in charge of telling everyone else what to do.

Architecture is not a description, it is the actual system. "Architecture is a property of a system, not a description of its intended design".

#### What is a good architecture?

It's the same question as "what is a good car?". You have to take architecture in relation to the actual quality aspect that you care about. You might care about security more, than performance, you have to figure it out, what that is.

<div class="text-center">
    <img class="img-fluid" src="/img/posts/2021-03-22-good-enough-architecture-brief/2-scaling-dimensions.jpg" alt="scaling-dimensions">
</div>

There is no "good" and "bad" architecture without context; architecture needs to take specific quality attributes into account.

#### 1. Non-extensible extensibility

If your design attempts to satisfy everyone, you'll likely end up satisfying no one.

<div class="text-center">
    <img class="img-fluid" src="/img/posts/2021-03-22-good-enough-architecture-brief/3-configurability-cost.jpg" alt="configurability-cost">
</div>

Solution was way too complex to small customer and not flexible enough large customers. They ended up building custom solution for specific clients. "Highly specific code is often preferable to sophisticated configuration".


#### 2. Perilously fine-grained

An architect of a project went to a conference, that pitched microservices. Which was a sad thing for that particular service. What architect decided to do was of course to separate everything into tiny little services, which felt good for developers for a while. As the team grew, people started to compete about who got access to a particular microservice.

A common anti-pattern is an "orders service". You will have a bunch of services that depend on this service and you will have to manage these dependencies. The problem is, this particular orders service isn't a generic thing, it actually has aspects of all those dependencies. It does many things for many people. If you aggregate it into a little entity thing it will become a problem.

Everybody wants to be Netflix, but nobody is.

 - Small is not always beautiful
 - Refactoring within team boundaries much easier than globally
 - You can't ignore organisational parameters, it will always hurt you

#### 3. Your system will be dynamic

 - Centralized responsibility hurts
 - Faced with too much rigidity, a way around the rules will be found

#### 4. Free-style architecture

<div class="text-center">
    <img class="img-fluid" src="/img/posts/2021-03-22-good-enough-architecture-brief/4-decoupling-developers.jpg" alt="configurability-cost">
</div>

 - Lack of standardization led to inefficient UI integration at runtime
 - Vast differences in API style, formats, documentation created needless extra work
 - Despite no centralised frontend, a central frontend team created a new bottleneck

You can not decide to not have an architecture; if you don't actively create it, be prepared to deal with the one that emerges.

#### 5. Cancerous growth

 - Successful systems often end up the worst architecture
 - Unmanaged evolution will lead to complete chaos
 - Don't be afraid of some light architectural governance


#### 6. Improve with less intelligence

 - Smart endpoints, dumb pipes
 - Value of specific over generic solution

#### Final thoughts

1. Don't be afraid of architecture
2. Choose the simplest thing that will work
3. Create evolvable structures
4. Manage your system's architectural evolution
5. Don't build road blocks - create value and get out of the way
