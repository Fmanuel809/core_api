# Core API

_"Core API" is a REST API with JWT authentication developed under the Lumen / Laravel 5.8, currently under development._


## How to start 🚀

**Note** that this API requires **Composer, PHP >= 7.1.3**.

_In order to start the project use:_

```
$ git clone https://github.com/Fmanuel809/core_api.git
$ cd core_api

# install the project's dependencies
$ composer install
```
See **Deployment** to learn how to deploy the project.


### Prerequisites 📋

1. Composer
2. PHP >= 7.1.3
4. OpenSSL PHP Extension
5. PDO PHP Extension
6. Mbstring PHP Extension
7. GIT (opcional)


## Deployment 📦

_In order to deploy the project follow these steps:_
```
1. Create a new database.
2. Create a user with total permissions on the database created.
3. Rename the .env.example file to .env and change the following values:

	# APP_KEY = Key String(32) for encrypt and decrypt your data.
	# DB_CONNECTION = Your database provider.
	# DB_HOST = Your database host.
	# DB_PORT = Your database port.
	# DB_DATABASE = Your database.
	# DB_USERNAME = Your database user.
	# DB_PASSWORD = Your database user password.
	# JWT_SECRET  = Key String(32) for encrypt and decrypt your Json Web Token.

4. Artisan command for migrations:
	
	$ php artisan migrate

Note: This command will create the users table in the database, and create a user with the credentials: "Username = admin and Password = qwerty123". These credentials will then be used in the request login to generate the JWT, and be able to use the other API requests.
```


## HTTP Routes Request ⚙️

```
GET:
# http://localhost:8080/users
# http://localhost:8080/users/{[*1-9]}

POST
http://localhost:8080/users
http://localhost:8080/auth/login

PUT
# http://localhost:8080/users/{[*1-9]}

DELETE:
# http://localhost:8080/users/{[*1-9]}
```


### cURL Test
```
# This is the login request, which returns a JWT, this token must be sent as a parameter in the other requests:

$ curl --location --request POST "http://localhost:8080/auth/login" \
  --header "Content-Type: application/json" \
  --data "{
	\"username\": \"admin\",
	\"password\": \"qwerty123\"
}"

# Request that returns all registered users:

$ curl --location --request GET "http://localhost:8080/users?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsdW1lbi1qd3QiLCJzdWIiOjEsImlhdCI6MTU2NDg1NTY2OCwiZXhwIjoxNTY0ODU5MjY4fQ.msN0YSmSbowhw8_88DAgMxeLL1346wKzJEBqDyyAVS8" \
  --header "Content-Type: application/json"
	
Note: In this request, the token parameter must be changed to the one returned in the login.
```

### Testing using Postman
Additionally you can try postman using this collection: [Core API Collection Request](https://documenter.getpostman.com/view/7311330/SVYqNduy?version=latest)


## Built with 🛠️

_Menciona las herramientas que utilizaste para crear tu proyecto_

* [Laravel/Lumen](http://www.dropwizard.io/1.0.2/docs/) - Framework PHP
* [Firebase/php-jwt](https://github.com/firebase/php-jwt) - JSON Web Tokens Auth
* [Composer](https://getcomposer.org/) - Dependency Manager


## Authors ✒️

* **Felix M. Martinez Sosa, Software Developer Engineer** - *Development and documentation* - [Fmanuel809](https://github.com/Fmanuel809)


## License 📄

This project is under License () - see the file [LICENSE.md] (LICENSE.md) for details


## Expressions of Gratitude 🎁

* Tell others about this project 📢
* Thanks publicly🤓.
* etc.


---
⌨️ With ❤️ by [Fmanuel809](https://github.com/Fmanuel809)😊
	
