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
### 数据库迁移 填充数据
```angular2html
php artisan migrate --seed
```
### 部署passport
```angular2html
php artisan passport:keys
php artisan passport:client --password
```
### 生成应用密钥
php artisan key:generate
### 文件访问
php artisan storage:link
