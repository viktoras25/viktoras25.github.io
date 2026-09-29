---
extends: _layouts.post
section: content
title: One plus one
tags: []
categories: []
published: true
language: en
post_date: 12.08.2019
---

A little funny quiz I've came up with. Guess programming language:

1. '1' + 1 = 11
2. '1' + 1 = 2
3. '1' + 1 = 50
4. '1' + 1 = TypeError

Answers below <!--more-->

1. Javascript. Press F12 in your browser (open dev tools console) and try for yourself
```javascript
> '1' + 1
< "11"
```

2. PHP
```php
echo '1' + 1;
2
```

3. C. '1' has **char** type, which is also an ASCII code of the symbol '1', which is 49. Plus one makes it 50.
```c
printf("%d", '1' + 1);
50
```

4. Python.
```python
print '1' + 1;
TypeError: cannot concatenate 'str' and 'int' objects
```
