# URL Shortener Service

## Description

A simple in-memory URL shortener built using Laravel.

## Requirements

- PHP = 8.2
- Composer = 2.8.3
- Laravel = 12.0

## Run the App

```bash
composer install
php artisan migrate
php artisan serve
```

## Endpoints

### Shorten a URL
- `POST /api/encode`  
  **Body:** `{ "url": "https://example.com" }`  
  **Returns:** `{ "url": "..."}`

  ```bash
  curl -X POST http://localhost:8000/api/encode \
  -H "Content-Type: application/json" \
  -d '{"url": "https://example.com"}'
  ```

### Retrieve original URL
- `GET /api/decode`  
  **Body:** `{ "url": "https://short.est/xyz" }`  
  **Returns:** `{ "url": "..."}`

  ```bash
  curl -X GET http://localhost:8000/api/decode \
  -H "Content-Type: application/json" \
  -d '{"url": "http://short.est/c984d0"}'
  ```

### A Postman Collection has also been provided for testing the API, see
  `url-shortener.postman_collection`
