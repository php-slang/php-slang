# PhpSlang [![Build Status](https://api.travis-ci.org/php-slang/php-slang.svg?branch=master&style=flat-square)](https://travis-ci.org/php-slang/php-slang) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/php-slang/php-slang/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/php-slang/php-slang/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/php-slang/php-slang/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/php-slang/php-slang/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/php-slang/php-slang/badges/build.png?b=master)](https://scrutinizer-ci.com/g/php-slang/php-slang/build-status/master)

![PhpSlang](phpslang_logo.png)

PhpSlang will help you to write purely functional code with PHP.

PhpSlang is a PHP library aiming to fill the gaps between PHP and classical functional languages.
It provides constructs optimizing your work and letting you develop with a purely functional style.

## More info

[Official page](http://phpslang.io)

[Documentation](https://php-slang.github.io/php-slang-docs/static/index.html)

[Twitter](https://twitter.com/_phpslang)

[Roadmap](https://trello.com/b/amNHaAgh/phpslang-roadmap)

## Features

 - [x] [Option monad](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Option.html)
 - [x] [Either monad](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Either.html)
 - [x] [Copy trait](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Copy_Trait.html)
 - [x] [Immutable List collection](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/List.html)
 - [x] [Trampolines](https://php-slang.github.io/php-slang-docs/static/Usage/Trampolines.html)
 - [x] [Pattern matching](https://php-slang.github.io/php-slang-docs/static/Usage/Pattern_Matching.html)
 - [x] [Memoization](https://php-slang.github.io/php-slang-docs/static/Usage/Memoization.html)
 - [ ] [Immutable HashMap collections](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/HashMap.html)
 - [x] [Immutable Set collections](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/Set.html)
 - [ ] [Extractors](https://php-slang.github.io/php-slang-docs/static/Usage/Extractors.html)
 - [ ] [Try monad](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Try.html)
 - [ ] [Future monad](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Future.html)
 - [ ] [Parallel immutable List collection](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/Parallel_Collections.html)
 - [ ] [Parallel immutable HashMap collection](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/Parallel_Collections.html)
 - [ ] [Parallel immutable Set collection](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/Parallel_Collections.html)
 - [ ] Traversable collections
 - [ ] Numeric type with infinite precision
 - [ ] Chainable\pipe monad
 - [ ] Convenient enumeration

## Example code

With a PhpSlang your code is going to look like that:
```php
public function nonTrivialExampleFn(ParallelListCollection $mysteriousInput): float {
  return $mysteriousInput
    ->filter(function ($elem) {
      return $elem > 10;
    })
    ->partition(
      function ($elem) {
        return $elem <=> 20;
      },
      new Set([-1, 0, 1])
    )
    ->map(function (ListCollection $bucket) {
      return $bucket->max()->getOrElse(0.0);
    })
    ->avg()
    ->getOrElse(0.0);
}
```

Or that:

```php
public function actionUpdateBook(string $bookId, Request $request): Response {
  return $this
    ->bookUpdaterService
    ->updateBook($bookId, $this->bookRequestTransformer->toInput($request), $this->getUser())
    ->left(function(BookUpdateError $error) {
      return Match::val($error)->of(
        new TypeOf(BookNotFound::class, new Response(null, Response::HTTP_NOT_FOUND)),
        new TypeOf(InvalidInput::class, new Response(null, Response::HTTP_BAD_REQUEST)),
        new TypeOf(NotAuthorized::class, new Response(null, Response::HTTP_UNAUTHORIZED))
      );
    })
    ->right(function(BookInfo $bookInfo) {
      return new Response($this->bookInfoTransformer->toJson($bookInfo), Response::HTTP_OK);
    })
    ->get();
}
```

Want to see more examples? [See documentation.](https://php-slang.github.io/php-slang-docs/static/index.html)

## Contribution

### TL;DR;

Just feel free to post your pull requests on GitHub.

### Contribution how to

1. Fork this repository

2. Clone your fork
```
git clone git@github.com:php-slang/php-slang.git
```

2. Install dependencies
```
composer install --dev
```

3. Write some code

4. Verify if it's fine
```
./ci/verify.sh
```

5. Push your pull request!

## The MIT License (MIT)

Copyright (c) 2018 Witold Adamus

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.