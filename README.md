# Mini facebook

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites
  * [Composer](https://getcomposer.org)
  * [PHP 7.2.* ](http://php.net/downloads.php) or higher
  * [MySQL](https://www.mysql.com/fr/)
  * [NPM](https://www.npmjs.com/get-npm)

### Installing

* Run those commands on terminal:
	```
	composer install
	```
	```
	npm install
	```
* Open MySQL console or PhpMyadmin and create a database with the name "mini-facebook"
* Create the database schema
1. Open the project in your IDE
2. Go to terminal and run:
	```
	php bin/console make:migration
	```
	```
	php bin/console doctrine:migrations:migate
	```
5. The database schema will be created automaticaly when you run the project.


## Running the project

To run the project:
	```
	php bin/console server:run
	```
On the browser: http://127.0.0.1:8000    

### Login page
![login](https://user-images.githubusercontent.com/31404363/46182834-dc968d00-c2c5-11e8-83f0-254d7e55d059.PNG)

### Register page
![register](https://user-images.githubusercontent.com/31404363/46182840-dd2f2380-c2c5-11e8-8737-99ad229cf199.PNG)

### Current user's profiel page
![profile 1_1](https://user-images.githubusercontent.com/31404363/46182837-dc968d00-c2c5-11e8-9cc8-679e57744d6f.PNG)
![profile 1_2](https://user-images.githubusercontent.com/31404363/46182838-dd2f2380-c2c5-11e8-9f74-7bb4f9ce1d52.PNG)
![profile 1_3](https://user-images.githubusercontent.com/31404363/46182839-dd2f2380-c2c5-11e8-8681-a200fd59f5d5.PNG)

### Friends list page
![friends](https://user-images.githubusercontent.com/31404363/46182831-dbfdf680-c2c5-11e8-8765-e30dd654192d.PNG)

### Home page
![home 1_1](https://user-images.githubusercontent.com/31404363/46182832-dc968d00-c2c5-11e8-84ce-c14e73d0a1e1.PNG)
![home 1_2](https://user-images.githubusercontent.com/31404363/46182833-dc968d00-c2c5-11e8-8cd0-509b41546e5a.PNG)

## Authors

* **Adnane Lamghari** [LinkedIn](https://www.linkedin.com/in/adnane-lamghari/)









