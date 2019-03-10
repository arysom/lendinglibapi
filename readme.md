# Lending library project api

Simple lending lib project php api made with Lumen - the Laravel framework's spin off microframework.

## Including:

- Eloquent
- Bearer token authentication
- Carbon

## Installation

1. git clone, cp .env.example .env
2. Setup the database, add the key to the .env with similar command `php -r "require 'vendor/autoload.php'; echo str_random(32).PHP_EOL;"`
3. Run the php server `php -S 0.0.0.0:8000 -t public/`
4. Hit the endpoints,  see the routes/web.php to get an overview
5. Run migrations and seeds - `php artisan migrate:fresh --seed`

## Todo

- [ ] Postman collection
- [ ] Tests
- [ ] Cleanup

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
