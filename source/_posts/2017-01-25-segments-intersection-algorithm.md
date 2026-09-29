---
extends: _layouts.post
section: content
title: Segments intersection algortihm
tags: []
categories: [golang]
published: true
language: en
post_date: 25.01.2017
---

For my job I needed to write a more efficient function to merge multiple sets of segments. Segments were date ranges where some special offers are applicable. So let's say a 10% discount is valid from 1st Jan to 10th Jan and another 20% discount is valid from 5th Jan to 15th Jan. This means both of them are valid between 5th and 10th. Those are just two ranges, there potentially be two lists of any amount of segments.

Now, I've said more efficient, because the code I inherited has been creating an list of all the dates within given ranges and calling [array_merge](http://php.net/manual/en/function.array-merge.php) on them. This has worked until we've started getting dates ranges like "0001-01-01 to 9999-12-31". I've came up with an algorithm, which might not be the most optimal, but I'm pretty happy with it. Especially because I've developed it without stealing parts from Google or StackOverflow. For funsies I'll reproduce the algorithm in Golang (it was in PHP originally).

Funnily enough, while writing this article I've come up with even easier solution. It seems much more obvious and looks like it doesn't deserve an article, but I've already wrote it. So there. Update 2: A day after posting I've simplified the algorithm even more by removing the flattening. It's now about 3 times shorter and 100 times easier to comprehend, than the first PHP version I wrote.

Prerequisites are: segments within a set are not overlapping with each other and are sorted.
Let's start with a couple of definitions. I'll use ints for segment begin and end, but generally any comparable type will do (like in PHP I just use date strings "2017-01-25", which are perfectly comparable). You can also view the gist with the source + test [here](https://gist.github.com/viktoras25/1582c22c69ee7d2bd70478eefe30f0c0).

```go
type segment struct {
	from, to int64
}

type segments []segment
```

A couple of functions I'm going to use are flatten, min and max. Flatten removes "borders" between ranges flattening them to an int array, min and max are pretty self-explanatory.
```go
func min(a, b int64) int64 {
	if a < b { return a }
	return b
}

func max(a, b int64) int64 {
	if a > b { return a }
	return b
}

```

So here it goes:
```go
func Merge(a, b segments) segments {

	result := segments{}

	// While there are entries left
	for len(a) > 0 && len(b) > 0 {

		// Set A will be the one, starting with the earliest date (smallest entry)
		if a[0].from > b[0].from {
			a, b = b, a
		}

		// While A has segments before the B starts, remove those
		if a[0].to < b[0].from {
			a = a[1:]
			continue
		}

		// We've thrown away all the non-intersecting segments at the beginning
		// So here we will have an intersection between a and b
		result = append(result, segment{
			max(a[0].from, b[0].from),
			min(a[0].to, b[0].to),
		})

		// Remove the segment of these two, which ends first
		if a[0].to < b[0].to {
			a = a[1:]
		} else {
			b = b[1:]
		}
	}

	return result
}
```
