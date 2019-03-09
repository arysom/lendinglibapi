# Lending library project api

Simple lending lib project php api made with Lumen - the Laravel framework's spin off microframework.

## Including:

- Eloquent
- Bearer token authentication
- ...

## Installation

1. git clone, cp .env.example .env
2. Setup the database, add the key to the .env with similar command `php -r "require 'vendor/autoload.php'; echo str_random(32).PHP_EOL;"`
3. Run the php server `php -S 0.0.0.0:8000 -t public/`
4. Hit the endpoints,  see the routes/web.php to get an overview

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
