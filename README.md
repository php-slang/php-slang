# PhpSlang

PhpSlang is a PHP library aiming to fill the gaps between PHP and classical functional languages.
It provides constructs optimizing your work and letting you develop with a purely functional style.

## Features (and roadmap)

### 0.1.0
 - **Option monad**
 - **Either monad**
 - **Copy trait**
 - **Immutable List collection**
 - <strike>Trampolines</strike>
 - <strike>Pattern matching</strike>

### 0.2.0 
 - <strike>Immutable HashMap collections</strike>
 - <strike>Immutable Set collections</strike>
 - <strike>Tuple monads</strike>
 - <strike>Try monad</strike>

### 0.3.0
 - <strike>Future monad</strike>
 - <strike>Parallel immutable List collection</strike>
 - <strike>Parallel immutable HashMap collection</strike>
 - <strike>Parallel immutable Set collection</strike>

### 0.4.0
 - <strike>Lazy monad</strike>
 - <strike>Validation functor</strike>
 - <strike>Property testing</strike>
 - <strike>Numeric type with infinite precision</strike>

### 0.5.0
 - <strike>Memoization</strike>
 - <strike>Chainable monad</strike>
 - <strike>Callable functor</strike>
 - <strike>Convenient enumeration</strike>

**Please notice that striked elements are NOT YET IMPLEMENTED !**

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