
## RESTful API Project
Test  task for DevOcean company



## How to install project

### 1.Do git clone project:


### If you have locally installed nginx, MYSQL, or php, please replace the ports in docker-compose.yml file.

### 2.Create docker volume:

docker volume create --name=laravel-pg-data

### 3.To set up the project, execute the following command in you command line:
./install.sh

This command will create a project with all dependencies. 

### 4.After installing the project, enter your Docker container:
docker exec -it l_php bash

### 5.Do migration:
php artisan migrate

### 6.Fill the database with new records.
If you want to create a custom user with an admin role, fill in the empty values; otherwise, a user will be created automatically

LOGIN_ADMIN= PASSWORD_ADMIN= EMAIL_ADMIN= php artisan db:seed --class=DatabaseSeeder

## The API documentation and database schema are located in the "documentation" folder at the root of the project
##  Swagger documention you can find here:
http://laravel-test.docker:1111/api/documentation
