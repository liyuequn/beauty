# beauty
# beauty
本项目有laravel5.5+vue2+elementui构建
### install npm
```angular2html
npm install
```
### composer 
```angular2html
composer install
```
### env
```angular2html
cp .env.example .env
```
### 数据库迁移
```angular2html
php artisan migrate
```
### 部署passport
```angular2html
php artisan passport:keys
php artisan passport:client --password
```
将生成的密钥保存，将其放在TestController中