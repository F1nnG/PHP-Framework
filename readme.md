# PHP-Framework by [Finn Groenewoud](https://github.com/F1nnG)

## About the project
This is a framework i started making to show my PHP skills for my portfolio. The framework is heavily inspired by Laravel. At the moment it is still fully in development so there will be a lot of bugs, but feel free to take a look at the current state of the framework. And feedback is always welcome.

## Installation
To start using this framework you should clone the repo.
```bash
git clone https://github.com/F1nnG/PHP-Framework.git
```
After that you should run copmoser`s install command to create the autoload files.
```bash
composer install
```
And lastly you should configure the database settings in the following file: (NOTE: this will be changed later on).
```
PHP-Framework/Framework/Database/Database.php
```

## Features
NOTE: as i said earlier the framework is still in development, so except bugs in these features.
- Routing
```php
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
```
- Controllers
```bash
php artisan make:controller UserController
```
```php
public function index()
{
    UserService::index();
}
```
- Services
```bash
php artisan make:service UserService
```
```php
return View::render('user.index', [
    'Link' => Link::class,
    'users' => User::all(),
]);
```
- Models
```bash
php artisan make:model User
```
- Migrations
```bash
php artisan migrate
```
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email');
    $table->integer('age');

    return $table;
}, $fresh);
```
- Factories
```bash
php artisan make:factory UserFactory
```
```php
public function definition()
{
    return [
        'name' => $this->faker()->name(),
        'email' => $this->faker()->email(),
        'age' => $this->faker()->numberBetween(18, 60),
    ];
}
```
- Seeders
```php
User::factory(10)->create();
```
