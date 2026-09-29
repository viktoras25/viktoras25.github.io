---
extends: _layouts.post
section: content
title: Project Euler 502
tags: []
categories: [haskell, euler]
published: true
language: en
post_date: 11.04.2015
---

Hello everyone, I've decided to continue writing posts into my blog, when I deal with something interesting. This time my attention has been drawn to Project Euler problems. I tend to refer to those problems when I'm learning a new programming language. Solving easier problems help to get handy with the syntax and language constructs. So it's Haskell now. I'm not going to tell how Haskell is different from anything I've learned before (Coursera Scala course was the closest), so i'll just proceed with the Problem 502, which I found really intriguing.

The problem itself can be found [here][1]. Brief comprehension is: how many castles can you build, that follow the rules: no hanging blocks, total amount of blocks is even. I am currently at the first approach stage. The first approach is usually naive: generate every possible castle, check the validity and calculate how many there are.

But there are several concepts I used, which I find quite interesting.
A castle consists of levels, each level consists of blocks and spaces between them. If you encode blocks and spaces as 0's and 1's you get a binary string, which you can convert to decimal. So, a castle is a just list of integers. 

The next thing is, how do we generate a level on top of the previus level. And the answer is again, quite simple. If a level has a width of 3, then there are 8 possible combinations of blocks and spaces, which are also numbers from 0 (no blocks, only spaces) to 7 (one block across the whole level). So on the 2x2 grid there are: 1 for the base level + 3 possible combinations (0, 1, 2) of the second level = 4 castles. At this point there will also be invalid castles (with hanging blocks), but we will filter them out later. On a WxH grid we will have 1 + (2 ^ W - 1) ^ (H - 1) castles. As a simple example in the task it is given a 10x13 grid, which would produce ~1.65*10^35 possible castles (Eeek).


The next idea, which will cut the number of computations by a huge amount is a check, if there are any hanging blocks. Because if there is at least one, we can skip this "branch". How do we do it? Let's see, if a level is a binary number, the next level may not be bigger, than that number, because otherwise most significant bit will hover over 0 of the underlying level, which is not allowed. Moreover, every 1 of the new level must have an underlying 1 from the previous level - bitwise AND. (New level) AND (Old level) must be equal to the (New level), otherwise new level is invalid.

So this is basically it, I start with a base level, add numbers from 0 to (2 ^ W) - 1, if they AND with the previous level, and after all I calculate amonut of blocks by grouping them.

```haskell
import Data.List
import Data.Bits

{-|
  Decimal to binary conversion
 -}
binary :: Integer -> [Integer]
binary 0 = [0]
binary 1 = [1]
binary x = binary (div x 2) ++ [mod x 2]

{-|
  Naive implementation of Euler Problem 502. Generate all castles, check validity, count
-}
castles :: Integer -> Integer -> Integer
castles w h = genericLength [c | c <- (allCastles w h), (even . sum . (map (countBlocks))) c]

{-|
  Generates all possible castles, even invalid ones. Each level is introduced
  with a number, which in binary form represents blocks
-}
allCastles :: Integer -> Integer -> [[Integer]]
allCastles _ 0 = []
allCastles 0 _ = []
allCastles w h = addLevel [[base]] (h-1)
  where base = (2 ^ w)-1
        addLevel castles levelsLeft
            | levelsLeft == 0 = castles
            | otherwise = addLevel ([c ++ [p] | c <- castles, p <- [0..(last c)], (p == p .&. (last c))]) (levelsLeft-1)

{-|
  Counts amount of blocks within a castle row
-}
countBlocks :: Integer -> Integer
countBlocks = genericLength . (filter ((== 1).head)) . group . binary
```

This is by no means an optimal solution, I couldn't even compute a 10x13 grid from the simpler example within a reasonable amonut of time. The biggest so far was a 9x7 grid for 28+ millions of castles. 

[1]: https://projecteuler.net/problem=502
