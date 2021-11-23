

# Getting started

## Installation


Clone the repository


Switch to the repo folder

    cd serge_test_todo

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
Run Migrations

    php artisan migrate

APIs (Postman Collection includ postman folder)

    POST:http://localhost:8000/api/v1/login

    GET:http://localhost:8000/api/v1/todos
    GET:http://localhost:8000/api/v1/todo/{id}
    POST:http://localhost:8000/api/v1/todo_store
    PUT:http://localhost:8000/api/v1/todo_update/{id}
    DELETE:http://localhost:8000/api/v1/todo_delete/{id}
