# Choho-Api

This is an API-REST for registration and control of pets.

## Technologies used

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

### Install
    
1 - Create a database in mysql with the name choho-test.

2 - The repository is downloaded.

3 - The following command is executed:
```
composer install
```
command to install the dependencies.

4 - Rename the .env.template file to .env and modify the database connection environment variables such as user, password, port and database name.

5 - Execute the following command to add the tables and columns to the database
```
php artisan migrate
```
6 -   Execute the seeder to enter records into the database using the following command.
```
php artisan db:seed
```     
7 - Run php server with laravel using the following command
```
php artisan serve
```
8 - To access the data we place the following addresses in our browser.

## Collections

IMPORTANT: To use the application through clients as postman you must log in and use the token that is returned to you to access the application.

<br/>
In the case of the parameters, {id} is replaced by the id number of the record to be managed.
    
### Customers Collections
```
POST    http://localhost:8000/api/customers                 // Search all records

POST   http://localhost:8000/api/customer                   // Add record 

PUT     http://localhost:8000/api/customer/{id}             // Update record existing

DELETE  http://localhost:8000/api/customer/{id}             // Delete record existing
```

In order to manage the **Customers** we need to send you the following **params**:
    
### Create and Update Customers
~~~
{
    "nit": (string - required)
    "razon_social": (string - required)
    "type": (integer (1, 2) - required)
    "active": (integer (1, 2) - required)
}
~~~

### Branches Collections
```
POST    http://localhost:8000/api/branches              // Search all records

POST   http://localhost:8000/api/branch                 // Add record 

PUT     http://localhost:8000/api/branch/{id}           // Update record existing

DELETE  http://localhost:8000/api/branch/{id}           // Delete record existing
```

In order to manage the **Branches** we need to send you the following **params**:
    
### Create and Update Branches
~~~
{
    "nit": (string - required)
    "name": (string - required)
    "phone": (string - required)
    "adddress": (string - required)
    "department_id": (foreign - required)
    "city_id": (foreign - required)
}
~~~

### Products Collections
```
POST    http://localhost:8000/api/products              // Search all records

POST   http://localhost:8000/api/product                 // Add record 

PUT     http://localhost:8000/api/product/{id}           // Update record existing

DELETE  http://localhost:8000/api/product/{id}           // Delete record existing
```

In order to manage the **Products** we need to send you the following **params**:
    
### Create and Update Products
~~~
{
    "name": (string - required)
}
~~~

### Order Collections
```

POST     http://localhost:8000/api/orders                   // Search all records

POST    http://localhost:8000/api/order                       //  Create new records

PUT     http://localhost:8000/api/order                       //  Update record existing

DELETE  http://localhost:8000/api/order/{id}                  //  Delete record existing
```

In order to manage the **Orders** we need to send you the following **params**:
    
### Create and Update Orders
~~~
{
    "order_date": (date - required)
    "order_number": (integer - required)
    "prefix": (string - required)
    "seller": (string - required)
    "customer_id": (foreign - required)
    "department_id": (foreign - required)
    "city_id": (foreign - required)
    "user_id": 1,
    "detailOrder": {
            "profile": (string - required)
            "family": (string - required)
            "group": (string - required)
            "subgroup": (string - required)
            "description": (string - required)
            "product_id": (foreign - required)
            "subtotal": (integer - required)
            "iva": (integer - required)
            "total": (integer - required)
            "type_tax": (string - required)
    },
}
~~~
