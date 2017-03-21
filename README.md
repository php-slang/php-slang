# PhpSlang [![Build Status](https://api.travis-ci.org/php-slang/php-slang.svg?branch=master&style=flat-square)](https://travis-ci.org/php-slang/php-slang)

PhpSlang will allow you to write purely functional code with PHP.

PhpSlang is a PHP library aiming to fill the gaps between PHP and classical functional languages.
It provides constructs optimizing your work and letting you develop with a purely functional style.

## More info

[Official page](http://phpslang.io)

[Documentation](https://php-slang.github.io/php-slang-docs/static/index.html)

[Twitter](https://twitter.com/_phpslang)

## Features (and roadmap)

### 0.1.0
 - [x] [Option monad](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Option.html)
 - [x] [Either monad](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Either.html)
 - [x] [Copy trait](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Copy_Trait.html)
 - [x] [Immutable List collection](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/List.html)
 - [x] [Trampolines](https://php-slang.github.io/php-slang-docs/static/Usage/Trampolines.html)
 - [x] [Pattern matching](https://php-slang.github.io/php-slang-docs/static/Usage/Pattern_Matching.html)
 - [x] [Memoization](https://php-slang.github.io/php-slang-docs/static/Usage/Memoization.html)

### 0.2.0 
 - [ ] [Immutable HashMap collections](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/HashMap.html)
 - [x] [Immutable Set collections](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/Set.html)
 - [ ] [Extractors](https://php-slang.github.io/php-slang-docs/static/Usage/Extractors.html)
 - [ ] [Try monad](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Try.html)

### 0.3.0
 - [ ] [Future monad](https://php-slang.github.io/php-slang-docs/static/Usage/Essentials/Future.html)
 - [ ] [Parallel immutable List collection](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/Parallel_Collections.html)
 - [ ] [Parallel immutable HashMap collection](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/Parallel_Collections.html)
 - [ ] [Parallel immutable Set collection](https://php-slang.github.io/php-slang-docs/static/Usage/Immutable_Data_Structures/Parallel_Collections.html)

### 0.4.0
 - [ ] Lazy monad
 - [ ] Validation functor
 - [ ] Property testing
 - [ ] Numeric type with infinite precision

### 0.5.0
 - [ ] Chainable\pipe monad
 - [ ] Convenient enumeration


## Contribution

### TL;DR;

Just feel free to post your pull requests on GitHub.

### Few more words of explanation
Few rules that can make your pull request pass a code review:
 - Do not add any dependencies (we want to keep this lib with only one dependency - PHP7)
 - Please use descriptive commit titles
 - Squash your commits - we prefer to have one commit per feature, even if it becomes a bulky commit
 - You don't have to keep to the road map - it's for us, not for a community

## Test

Clone this repository
```
git clone git@github.com:php-slang/php-slang.git
```

Install dependiences
```
composer install --dev
```

Run PHPUnit
```
./vendor/bin/phpunit
```

To calculate and verify tests code coverage:
```
phpdbg -qrr vendor/bin/phpunit --coverage-clover clover.xml
php coverage-checker.php clover.xml 100
```