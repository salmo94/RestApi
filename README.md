
## RESTful API Project
Test  task for DevOcean company



## How to install project

### 1.Do git clone project:
git clone https://github.com/salmo94/RestApi.git


### If you have locally installed nginx, MYSQL, or php, please replace the ports in docker-compose.yml file.

### 2.Create docker volume:

docker volume create --name=laravel-mysql-data

### 3.To set up the project, execute the following command in you command line:
./install.sh

This command will create a project with all dependencies. 

### 4.After installing the project, enter your Docker container:
docker exec -it l_php bash

### 5.Do migration:
php artisan migrate

### 6.Fill the database with new records.
 php artisan db:seed --class=DatabaseSeeder


### 7.Register your first user using the following path:
http://laravel-test.docker:1111/api/register
### And don't forget to add to the header: 
#### Accept: application/json.

After that, log in with your new email and password.
You will receive a token that will initialize you.

Changing the role to admin needs to be done manually.

## The API documentation and database schema are located in the "documentation" folder at the root of the project
##  Swagger documentation you can find here:
http://laravel-test.docker:1111/api/documentation
