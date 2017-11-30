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
将生成的密钥保存，将其放在前端js中login.vue此处有疑问，读了laravel的官方文档，自己理解为生成客户端，由用户把密钥填充这件事情，不能理解
### 填充数据
```angular2html
 php artisan db:seed --class=UsersTableSeeder
 php artisan db:seed --class=ArticlesTableSeeder
```

### 生成应用密钥
php artisan key:generate
