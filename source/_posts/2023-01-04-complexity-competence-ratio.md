---
extends: _layouts.post
section: content
title: Complexity / competence ratio
description: Keeping the project stable as the complexity grows.
tags: [management]
categories: []
published: false
language: en
post_date: 04.01.2023
---

In one of my professional endeavors, I've started to notice a problem - some parts of the project were increasingly harder to manage. They would consistently require more time and effort, than initially anticipated. I realised, that the complexity of the project now exceed our current level of competence, which I called a competence/complexity ratio. A software company, as a living organism, constantly go through changes: you hire new people, some people with knowledge leave, you build new features, you refactor. Hence, the complexity and the overall competence of the team also do change over time. If the complexity over competence ratio becomes greater than 1 (meaning complexity > competence), it can pose a serious issue for the project's long term well-being. I liked this term so much, that I wanted to explore the idea further.

<!--more-->

Let's first clarify what are complexity and competence. Wikipedia article about [programming complexity][1] explains it neatly: 

> There is a distinction between the terms complex and complicated. Complicated implies being difficult to understand but, with time and effort, ultimately knowable. Complex, on the other hand, describes the interactions between a number of entities.

This way, low complexity means the project is small, easy to handle, even if the underlying business logic may not be trivial. High complexity means it's too much to deal with, and you start sweating trying to change even the littlest of things.

Competence is a loosely defined term, since it's relative to the undertaking. Some developer may be competent enough to accomplish a given task quickly, effectively, with long-term working result. A different developer may struggle to deliver the same level of result, due to lacking technical skills, domain knowledge or even plainly prudence. We can broadly define three categories on the competence axis: lacking competence, average competence and expert competence.

Now, combining these categories, we get a complexity / competence matrix. Each cell describes, how a software project may look like at this level of complexity and developer's competence. During a project's lifetime it can, of course, go through different stages. Some are more stable, and some are transitional.

<div class="text-center">
    <img class="img-fluid" src="/img/posts/2023-01-04-complexity-competence-ratio/1-complexity-competence-matrix.svg" alt="Complexity/competence matrix">
</div>

Let me describe an example project from years ago. It started off as a one-file monitoring script, with hard-coded credentials, that just did the work. I didn't spend a lot of time and threw together what worked for me then. That would fit into top-middle - low complexity and average competence, a stable low-tech solution. The project proved itself to be very useful, so I refactored it, added a proper configuration file. With this, the project moved into top-middle state of average competence, but still maintaining low complexity. Over time, users liked the product and demanded more features. I added requested features, increasing the project complexity, but adhering to good coding practices and keeping the structure clean. The project moved into the middle cell, where it remained.

I draw the following conclusions from this little story:

- Complexity tends to increase over time, as the project grows.
- To reduce complexity, you need to take measures to improve structure and architecture of the project.
- The competence was always higher than the complexity, so the project was never at risk. 

<div class="text-center">
    <img class="img-fluid" src="/img/posts/2023-01-04-complexity-competence-ratio/2-project-development.svg" alt="Project development paths">
</div>

Let's imagine how the same project could've evolved further. The project continues to grow with new features, and as we figured out, complexity grows with it. On the image above, the project's initial development is indicated by a blue arrow. If the developer has enough competence to recognize the threat of uncontrolled complexity and mitigate it with high-quality work, that would first place the project into the bottom right cell. From there it will either move to manageable complexity, or average competence. A high complexity/average competence combination is also not a stable state, due to [software rot][2]. With active effort, once again, the complexity can be reduced (green arrow), or the project will eventually move to disaster phase (red arrow).

Findings from this story are:

- Active efforts are required to counteract complexity growth.
- As complexity grows, higher competence is required to keep the project stable.
- If complexity is higher than competence, the project will slide left and down, where the eventual stop is disaster.

[1]: https://en.wikipedia.org/wiki/Programming_complexity
[2]: https://en.wikipedia.org/wiki/Software_rot
