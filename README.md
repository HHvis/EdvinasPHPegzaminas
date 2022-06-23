<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<h2>Programos</h2>

<ul>
  <li>PHP 8.0</li>
  <li>Laravel 8</li>
  <li>MySql xx</li>
  <li>Composer xx</li>
</ul> 

<h2>Paskyros</h2>
<p>Admin</p>

```
admin@gmail.com
```
```
admin123
```
<p>Skaitytojas</p>

```
labas@gmail.com
```
```
labas123
```

<h2 align="center">PROJEKTO PALEIDIMAS</h2>

1. Terminale klonuokite projektą:
```
git clone https://github.com/HHvis/EdvinasPHPegzaminas.git
```
2. Eikite į projekto katalogą - 'cd' pagalba ir įrašykite papildymus:
```
composer install
composer update
```
3. Sukurkite env file
```
cp .env.example .env
php artisan key:generate
```
4. Terminale susikurkite duombazę, pavadinimu 'egzaminas' ir ikelkite SQL file i ja:
```
php artisan db
create database laravel
```
5. Reikalingos migracijos:
```
php artisan migrate:fresh
```
6.Projekto paleidimas:
```
php artisan serve
```
