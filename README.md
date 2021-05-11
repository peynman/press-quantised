# Larapress ECommerce Quantied Product Type
This package adds Quantied product (in stock, sale quantity) as a new product type to [Larapress ECommerce](../../../press-crud).

## Dependencies
* [Larapress ECommerce](../../../press-ecommerce)

## Install
1. ```composer require peynman/larapress-quantied```

## Config
1. Publish config ```php artisan vendor:publish --tag=larapress-quantied```
1. Create/Update product type ```php artisan lp:quantied:create-pc```

## Usage
