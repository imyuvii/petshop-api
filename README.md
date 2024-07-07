# Petson - API

## Getting started

### Prerequisites

-   PHP 8.3
-   Composer
-   [Docker Desktop](https://www.docker.com/products/docker-desktop/)

## Installation
### Clone the repository
```bash
git clone https://github.com/imyuvii/petshop-api.git
cd petshop-api
```
### Run the docker containers
```bash
docker-compose up -d # -d to run it in the background
```
### Install dependencies and generate keys
```bash
docker-compose exec app cp .env.example .env
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan jwt:secret
```
### Migrate and seed the database
```
docker-compose exec app php artisan migrate:fresh --seed
```
### Generate swagger documentation
```
docker-compose exec app php artisan l5-swagger:generate
```
## Swagger docs
Hit the url: http://127.0.0.1:8080/api/documentation

### Default credentials (Or you can register a new user)
```sh
Username: user@buckhill.co.uk
Password: userpassword
```
## Testing
```bash
docker-compose exec app php artisan test
```
## Code formatting
```bash
docker-compose exec app docker-compose exec app composer format
```

## Running PHPStan 
```bash
docker-compose exec app composer analyse
```
