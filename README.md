## Multi-Vendor E-Commerce Lust Site

## Bootsrap Responsive Online Shop with beautiful metro style administration!

Current versions
* Laravel Framework 5.5.3 (https://laravel.com/)
* Bootstrap v3.3.7 (http://getbootstrap.com)

## Donate
If this project help you reduce time to develop, you can give me a cup of coffee to continue its development :)
[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YX2JXRBLWRXPA)

## Supporting features
1. Bootstrap responsive
2. Blade template usage
3. Multi Language (administration and public page) 
4. Products with tree structure categories and tags

### Server Requirements
PHP >= 7.0.0

## Installation in 3 easy steps
1. Import lara_cms.sql to your mysql
2. Set hostname, username and password in .env for your SQL
3. Set APP_URL in .env with your site url - http://yourdomain.com
(Maybe you know but you must set your virtual host point to public/ directory or start laravel web server for testing with php artisan serve)

## How To Run
composer install
php artisan key:generate
npm install
php artisan storage:link (for using public disk)
php artisan serve

## Login to administration
http://yourdomain.com/admin
* Email: admin@test.com
* Pass: admin
