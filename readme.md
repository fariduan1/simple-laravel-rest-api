# Simple laravel App for store Lat,Lng Data and place name , Auth by jwt
# Install :

* Config DataBase connector on .env file
* run `` composer install`` 
* run ``php artisan admin:install``

# admin panel :

# go to ``http://127.0.0.1:8000/admin`` user and pass is  ``admin``
pass

#for use you must do this steps :
* Register by ``api/register`` by this post method :
```json
{
	"name":"mohddamad",
	"email":"teddst@test.dc",
	"password":"123456"
}
```
* when you register system return jwt token ,and you must add in all heade by ``token`` variable

* Login by ``api/login`` by this post method :

```json
{
	"name":"mohddamad",
	"password":"123456"
}
```
* when you login system return jwt token ,and you must add in all heade by ``token`` variable
# mian method :

* Create Place on ``api/places/create`` Post Method
```json
{
	"name":"tehran",
	"lat":"2500",
	"lng":"-2000"
}
```
* update Place on ``api/places/update`` Post Method
```json
{
	"name":"Iran",
	"lat":"2500",
	"lng":"-2000"
}
```

* fetch Place on ``api/places/fetch/id`` id is place id EX : 12
* Delete Place on ``api/places/fetch/id`` id is place id EX : 12
