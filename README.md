# wow-api
PHP API integration for Owen Wilson Wow API

This uses the [Owen Wilson Wow API](https://github.com/amamenko/owen-wilson-wow-api).
See their [API documentation](https://wow.readme.io/).

## Installation

Require this package with composer 

```
composer require tii/wow-api
```


## Usage

You have all the available API methods as static methods on the `Tii\WowApi\WowApi` class.

### Examples

**Get 5 random Wows**
```php
$wows = \Tii\WowApi\WowApi::random(results: 5);
```

**Get a single ordered Wow**
```php
$wow = \Tii\WowApi\WowApi::ordered('20');
```

**Get a list of available movies/directors**
```php
$movies = \Tii\WowApi\WowApi::allMovies();
$directors = \Tii\WowApi\WowApi::allDirectors();
```

**Get 5 random wows from a specific movie**
```php
$wowsInCars3 = \Tii\WowApi\WowApi::random(
  results: 5,
  movie: 'Cars 3'
);
```
