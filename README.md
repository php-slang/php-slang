# PhpSlang

PhpSlang is a PHP library aiming to fill the gaps between PHP and classical functional languages.
It provides constructs optimizing your work and letting you develop with a purely functional style.

## Keep informed

Watch us at https://twitter.com/_phpslang

## Features (and roadmap)

### 0.1.0
 - [x] Option monad
 - [x] Either monad
 - [x] Copy trait
 - [x] Immutable List collection
 - [x] Trampolines
 - [ ] Pattern matching

### 0.2.0 
 - [ ] Immutable HashMap collections
 - [ ] Immutable Set collections
 - [ ] Tuple monads
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
 - [ ] Chainable monad
 - [ ] Callable functor
 - [ ] Convenient enumeration


## Contribution

### TL;DR;

Just feel free to post your pull requests in github.

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
phpunit -c test
```