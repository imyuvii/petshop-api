# Bacs Package

This package provides an API endpoint to render BACS response.

## Installation

1. Add the package to your `composer.json`:
    ```json
    "require": {
        "your-vendor/bacs-package": "dev-main"
    },
    "repositories": [
        {
            "type": "path",
            "url": "./packages/YuvrajJhala/BacsPackage"
        }
    ]
    ```

2. Run `composer update`.

3. Add the service provider to `config/app.php`:
    ```php
    YuvrajJhala\BacsPackage\BacsPackageServiceProvider::class,
    ```

## Usage

- Access the BACS response at `/api/v1/bacs-response`.

## Swagger Documentation

Swagger documentation is available for the API endpoint.
