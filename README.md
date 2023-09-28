<h1  align="center"> Trivago Case Study </h1>  <br>



<p  align="center">

Further Enhancements :
- Write unit & integration tests.
- Build caching layer.
- Build a logging service.
</p>


## Table of Contents

-  [Table of Contents](#table-of-contents)

-  [Introduction](#introduction)

-  [Data Models](#database-models)

-  [API Documentation](#api-documentation)

-  [Requirements](#requirements)

-  [Installation](#installation)







## Introduction:
Independent Hotels API reference. This API serves as the primary gateway to facilitate accommodations display and bookings through trivago platform

Introduction
The Independat Hotels API is organized according to REST principles and provides the following functionalities:

- create, retrieve, update and delete accommodations with different categories
- user management for hoteliers
- simple booking experience

## Database Models:

Database Used Is Mysql.

  - users (hoteliers) table
      ``` 
      id: UUID (Primary Key)
      name: String
      email: String (Unique)
      password: String
      created_at: Timestamp
      updated_at: Timestamp
      ```
      - personal_access_tokens table
      ``` 
    id: Primary Key
    tokenable_id: UUID (Polymorphic Relation)
    tokenable_type: String (Polymorphic Relation)
    name: String
    token: String (Unique, Length: 64)
    abilities: Text (Nullable)
    last_used_at: Timestamp (Nullable)
    expires_at: Timestamp (Nullable)
    created_at: Timestamp
    updated_at: Timestamp
      ```
      - countries table
      ``` 
    id: UUID (Primary Key)
    name: String
    code: String
    created_at: Timestamp
    updated_at: Timestamp
      ```
    - locations table
    ``` 
    id: UUID (Primary Key)
    country_id: Foreign Key (References countries.id, onDelete: Cascade)
    city: String (Max Length: 255)
    state: String (Max Length: 255)
    zip_code: Integer
    address: String (Max Length: 255)
    created_at: Timestamp
    updated_at: Timestamp
    ```
     - accommodations table
    ```
    id: UUID (Primary Key)
    name: String (Max Length: 255)
    rating: Tiny Integer
    category: Enumeration (Values: hotel, alternative, hostel, lodge, resort, guest-house)
    location_id: Foreign Key (References locations.id, onDelete: Cascade)
    image: String (Max Length: 255)
    reputation: Integer
    price: Double (Precision: 10, Scale: 2)
    available_rooms: Integer
    user_id: Foreign Key
    created_at: Timestamp
    updated_at: Timestamp
    ```
## API Documentation:

there is a detailed docs with swagger (OpenApi 3.0) but here is a summary:

- Private Route:

    * `POST /v1/accommodations`: Create hotelier accommodation
    * `PUT /v1/accommodations/:id`: Update hotelier accommodation.
    * `DELTE /v1/accommodations/:id`: Delete hotelier accommodation.

- Public Routes:

   * `POST /api/accommodations/:id/bookings`: Make Reservation.
  * `POST /auth/register`: Creates a new user. name, email and password is required in request body.
  * `POST /auth/login`: login user. email and password is required in request body and return access_token.
  * `GET /v1/accommodations?city=berlin`: get all accommodations.
  * `GET /v1/users`: get all users data
  * `GET /v1/users/:id/accommodations?rating=5`: get accommodations for given user.


# Requirements:

### Local
*  PHP v8.2.10
*  Mysql

### Docker
*  Docker version 24.0.6
*  docker-compose version 2.21.0


# Installation:
## step 1:

Make sure docker installed and running then change directory to the project's root (where `docker-compose.yml` is ) and run the following command which will build the images if the images **do not exist** and starts the containers.

When ready, run it:

```bash

$ docker-compose up

```
## step 2:
Now we need to migrate database schema 
inside mysql container when container is ready and running, run it:

```bash

$ docker exec -t app php artisan migrate --seed

```
Application will run by default on port `8080`, and is accessible from `http://localhost:8080`



Configure the port by changing `services.nginx.ports` in __docker-compose.yml__. Port 8080 was used by default so the value is easy to identify and change in the configuration file.
