
# Maju Mundur App

Maju Mundur App is clothing market place to connect multiple merchant and customer.




## Tech Stack

- PHP : https://www.php.net/manual/en/install.php
- Laravel (Framework) : https://laravel.com/docs/10.x#creating-a-laravel-project
- MySql (Database) : https://dev.mysql.com/downloads/installer/


## Installation

To Run this project, ensure you have PHP version 8.1  and MySql installed

1. Clone this repository
```bash
    https://github.com/Pajarrr33/maju-mundur-app
```
2. Configure your database in .env.example and change the filename to .env

3. Navigate to the project directory
```bash
    cd maju-mundur-app
```
4. Run the migration
```bash
    php artisan migrate
```

5. Run the seeding
```bash
    php artisan db:seed
```

6. Run the application
```bash
    php artisan serve
```


    
## Database Migration
All database migration is in `database/migration` folder

### Run Migration

```shell
php artisan migrate
```
## API Spec
You can import a postman colletion in `Maju Mundur App.postman_collection.json` files
### Auth API

#### Register

Request :

- Method : POST
- Endpoint : `api/v1/register`
- Header :
    - Content-Type : application/json
    - Accept : application/json
- Body :

```json
    {
        "name" : "test",
        "email" : "testingapp@gmail.com",
        "password" : "12345678"
    }
```

Response :

- Status : 201 Created
- Body :
```json
    {
        "data" : {
            "id" : 3,
            "name" : "test",
            "email" : "testingapp@gmail.com",
        }
    }
```

#### Login

Request :

- Method : POST
- Endpoint : `api/v1/login`
- Header :
    - Content-Type : application/json
    - Accept : application/json
- Body :

```json
    {
        "email" : "testingapp@gmail.com",
        "password" : "12345678"
    }
```

Response :

- Status : 200 OK
- Body :
```json
    {
        "data": {
            "id": 3,
            "email": "testingapp@gmail.com",
            "name": "test",
            "token": "543aada5-0ebb-45ad-a8f7-0c0684f2c48e"
        }
    }
```

### Product API

#### Get All Product

Request :

- Method : GET
- Endpoint : `api/v1/products`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token


Response :

- Status : 200 OK
- Body :
```json
    {
        "data": [
            {
                "id": 1,
                "merchant_id": 1,
                "name": "T-Shirt",
                "desc": "High-quality cotton T-Shirt.",
                "price": 100
            },
            {
                "id": 2,
                "merchant_id": 1,
                "name": "Jeans",
                "desc": "Stylish denim jeans.",
                "price": 200
            }
        ]
    }
```

#### Get Product By Id

Request :

- Method : GET
- Endpoint : `api/v1/products/1`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token


Response :

- Status : 200 OK
- Body :
```json
    {
        "data": {
            "id": 1,
            "merchant_id": 1,
            "name": "T-Shirt",
            "desc": "High-quality cotton T-Shirt.",
            "price": 100
        }
    }
```

#### Create Product

Request :

- Method : POST
- Endpoint : `api/v1/products`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token
- Body :
```json
    {
        "name" : "sabun",
        "description" : "Sabun mandi lifeboy",
        "price" : 10000
    }
```

Response :

- Status : 201 Created
- Body :
```json
    {
        "data": {
            "id": 4,
            "merchant_id": 1,
            "name": "sabun",
            "desc": "Sabun mandi lifeboy",
            "price": 10000
        }
    }
```

#### Update Product

Request :

- Method : PUT
- Endpoint : `api/v1/products/4`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token
- Body :
```json
    {
        "name" : "Buku",
        "description" : "buku kyknya",
        "price" : 1000
    }
```

Response :

- Status : 200 OK
- Body :
```json
    {
        "data": {
            "id": 4,
            "merchant_id": 1,
            "name": "kutubuku",
            "desc": "buku kyknya",
            "price": 1000
        }
    }
```

#### Delete Product

Request :

- Method : DELETE
- Endpoint : `api/v1/products/4`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token


Response :

- Status : 200 OK
- Body :
```json
    {
        "message" : "Product deleted"
    }
```

### Transaction API

#### Get All Transaction

Request :

- Method : GET
- Endpoint : `api/v1/transactions`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token


Response :

- Status : 200 OK
- Body :
```json
    {
        "data": [
            {
                "id": 3,
                "customer_id": 3,
                "product_id": 2,
                "points": 0,
                "quantity": 10,
                "total_price": 2000
            },
            {
                "id": 4,
                "customer_id": 3,
                "product_id": 3,
                "points": 4,
                "quantity": 4,
                "total_price": 40000
            },
            {
                "id": 5,
                "customer_id": 3,
                "product_id": 3,
                "points": 4,
                "quantity": 4,
                "total_price": 40000
            }
        ]
    }
```

#### Create Transaction

Request :

- Method : POST
- Endpoint : `api/v1/transactions`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token
- Body :
```json
    {
        "product_id" : 3,
        "quantity" : 4
    }
```

Response :

- Status : 201 Created
- Body :
```json
    {
        "data": {
            "id": 6,
            "customer_id": 3,
            "product_id": 3,
            "points": 0,
            "quantity": 4,
            "total_price": 4000
        }
    }
```

### Reward API

#### Get All Reward

Request :

- Method : GET
- Endpoint : `api/v1/rewards`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token


Response :

- Status : 200 OK
- Body :
```json
    {
        "data": [
            {
                "id": 1,
                "name": "Reward A",
                "points_required": 20
            },
            {
                "id": 2,
                "name": "Reward B",
                "points_required": 40
            }
        ]
    }
```

#### Redempt a reward

Request :

- Method : POST
- Endpoint : `api/v1/rewards`
- Header :
    - Content-Type : application/json
    - Accept : application/json
    - Authorization : token
- Body :
```json
    {
        "reward_id" : 1
    }   
```

Response :

- Status : 201 Created
- Body :
```json
    {
        "data": {
            "id": 2,
            "customer_id": 3,
            "reward_id": 1,
            "redeemed_at": "2024-11-18T15:44:09.356100Z",
            "points": 20
        }
    }
```



