# PhpSlang

PhpSlang is a PHP library aiming to fill the gaps between PHP and classical functional languages.
It provides constructs optimizing your work and letting you develop with a purely functional style.

[![Build Status](https://api.travis-ci.org/php-slang/php-slang.svg?branch=master&style=flat-square)](https://travis-ci.org/php-slang/php-slang)

## Keep informed

Watch us at https://twitter.com/_phpslang

## Features (and roadmap)

### 0.1.0
 - [x] Option monad
 - [x] Either monad
 - [x] Copy trait
 - [x] Immutable List collection
 - [x] Trampolines
 - [x] Pattern matching

### 0.2.0 
 - [ ] Immutable HashMap collections
 - [ ] Immutable Set collections
 - [ ] Extractors
 - [ ] Try monad

### 0.3.0
 - [ ] Future monad
 - [ ] Parallel immutable List collection
 - [ ] Parallel immutable HashMap collection
 - [ ] Parallel immutable Set collection

### 0.4.0
 - [ ] Lazy monad
 - [ ] Validation functor
 - [ ] Property testing
 - [ ] Numeric type with infinite precision

### 0.5.0
 - [ ] Memoization
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
phpunit
```