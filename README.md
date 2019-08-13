# paisa-stripe
Stripe implementation for the Paisa payment abstraction library

## Installation
You can install this library via [Composer](http://getcomposer.org/).
```shell script
composer require xola/paisa-stripe
```

## Development
The test suite depends on [stripe-mock](https://github.com/stripe/stripe-mock), so you'll need to fetch and run it in
the background.
```shell script
go get -u github.com/stripe/stripe-mock
stripe-mock
```

Once stripe-mock is running in the background, install dependencies via Composer.
```shell script
composer install
```

Once dependencies are installed, you can execute the test suite via PHPUnit.
