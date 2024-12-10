# AlertBug

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

**AlertBug** is a Laravel package for capturing exceptions and sending them to an external API for centralized error tracking. This package helps developers monitor and debug applications by sending detailed exception data in real-time.

---

## Features

- **Automatic Exception Handling**: Replaces Laravel's default exception handler to capture and send exceptions.
- **Customizable API Endpoint**: Configure the endpoint to send exception data.
- **Rich Error Details**: Sends information like error message, stack trace, user data, and request context.
- **Easily Configurable**: Publish the configuration file and customize as needed.
- **Supports Laravel 8, 9, and 10**.

---

## Requirements

- PHP 8.0 or higher
- Laravel 8, 9, or 10
- Guzzle 7.x

---

## Installation
1. Add this code to your composer.json:
```bash
 "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/wilfreidlando/exception-reporter"
        }
    ],
```
2. Add the package to your project using Composer:
   ```bash
   composer require alertbug/alertbug
   ```

3. Publish the configuration file:
   ```bash
   php artisan vendor:publish --provider="AlertBug\AlertBug\AlertBugServiceProvider" --tag="config"
   ```

4. Add the following variables to your project's `.env` file:
   ```php
    ALERTBUG_API_KEY=your-api-key
    ALERTBUG_API_URL=http://example.com/api/bugs
    ALERTBUG_ENABLED=true

   ```

---


## Configuration

The configuration file `config/alertbug.php` provides options to customize the package:

- **API Key**: Specify your API key for authentication.
- **API URL**: Define the URL of the external API where exceptions will be sent.

Add these environment variables to your `.env` file:
```dotenv
ALERTBUG_API_KEY=your-api-key
ALERTBUG_API_URL=http://example.com/api/erreurs
ALERTBUG_ENABLED=true
```

---

## How It Works

1. The package overrides Laravel's default exception handler.
2. Whenever an exception occurs, it is captured by the `AlertBugHandler` class.
3. The captured exception details are sent to the configured external API using Guzzle.

---

## Development and Testing

### Install Locally
Clone the repository and use Composer to install dependencies:
```bash
git clone https://github.com/wilfreidlando/exception-reporter.git
cd alertbug
composer install
```

### Test the Package in a Laravel Project
You can use your local package in a Laravel project by adding this to `composer.json`:
```json
"repositories": [
    {
        "type": "path",
        "url": "./path-to-your-package"
    }
]
```

Then require the package:
```bash
composer require alertbug/alertbug
```

---

## Contributing

Contributions are welcome! Feel free to submit issues or pull requests on [GitHub](https://github.com/wilfreidlando/exception-reporter).

---

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## Credits

Developed by [Wilfried Lando](mailto:wilfriedlando@gmail.com).
```
