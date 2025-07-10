# 🐾 be\_test – Laravel Stock Management API

A simple RESTful API built with Laravel to manage Products, Locations, Stock Movement (Mutations), and Auth using Sanctum.

---

## 🚀 Features

* ✅ User Registration & Login (Sanctum Auth)
* 📦 Product & Location Management
* 🔁 Stock Mutation: In/Out
* 📍 Product-Location with pivot table for stock quantity
* 🐳 Dockerized for easy development
* 🔐 Secured API routes with token authentication

---

## 📦 Requirements

* PHP 8.x
* Composer
* Docker & Docker Compose
* Git

---

## 🛠️ Installation Steps

### 1. Clone the repository

```bash
git clone https://github.com/irawanap/be_test.git
cd be_test
```

### 2. Copy & configure .env file

```bash
cp .env.example .env
```

Edit `.env` as needed. For Docker setup:

```env
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### 3. Build & run containers

```bash
docker-compose up -d --build
```

### 4. Setup Laravel environment

```bash
docker exec -it laravel_app bash
composer install
php artisan key:generate
php artisan migrate
```

---

## 🔐 Authentication API

### Register

```http
POST /api/register
```

**JSON Body:**

```json
{
  "name": "",
  "email": "",
  "password": "",
  "c_password": ""
}
```

### Login

```http
POST /api/login
```

**JSON Body:**

```json
{
  "email": "",
  "password": ""
}
```

**Headers for Protected Routes:**

```http
Authorization: Bearer YOUR_SANCTUM_TOKEN
```

---

## 📦 Product API

### Create Product

```http
POST /api/products
```

**JSON Body:**

```json
{
  "name_product": "",
  "code_product": "",
  "category": "",
  "unit": "",
  "description": ""
}
```

### Get All Products

```http
GET /api/products
```

---

## 🏢 Location API

### Create Location

```http
POST /api/locations
```

**JSON Body:**

```json
{
  "name_location": "",
  "code_location": ""
}
```

### Get All Locations

```http
GET /api/locations
```

---

## 🔗 Product-Location (Stock Assignment)

### Assign Stock

```http
POST /api/product-location
```

**JSON Body:**

```json
{
  "product_id": ,
  "location_id": ,
  "stok": 
}
```

### Update Stock

```http
PUT /api/product-location
```

**JSON Body:**

```json
{
  "product_id": ,
  "location_id": ,
  "stok": 
}
```

---

## 🔁 Mutation API

### Create Mutation

```http
POST /api/mutations
```

**JSON Body:**

```json
{
  "date": "",
  "mutation_type": "",
  "amount": ,
  "description": "",
  "product_id": ,
  "location_id": 
}
```

### Get All Mutations

```http
GET /api/mutations
```

---

## 🧪 Test with Postman/Insomnia

1. Register & login to get token
2. Use token to test all endpoints with header:

```http
Authorization: Bearer YOUR_TOKEN
```

---

## 🐬 PhpMyAdmin

Access at: [http://localhost:8080](http://localhost:8080)

* Server: `db`
* Username: `your-username`
* Password: `your-pw`

---

## 🧹 Stop & Clean Docker

```bash
docker-compose down -v
```

---

## 🙌 Author

Made with ❤️ by [@irawanap](https://github.com/irawanap)
