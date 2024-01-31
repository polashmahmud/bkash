# Bkash Gateway for Laravel

This package is a wrapper for the [Bkash](https://www.bkash.com/) payment gateway for Laravel. It uses
the [Bkash](https://www.bkash.com/) API to process payments. This package is not officially supported
by [Bkash](https://www.bkash.com/). Use at your own risk. Feel free to contribute.

## Installation

You can install the package via composer:

```bash
composer require polashmahmud/bkash
```

## Usage

### Configuration

Publish the configuration file using the following command:

```bash
php artisan vendor:publish --provider="Polashmahmud\Bkash\BkashServiceProvider"
```

This will create a `bkash.php` file in your `config` folder. Here you can set your Bkash credentials. You can also set
your credentials in your `.env` file.

```bash
BKASH_BASE_URL=https://tokenized.sandbox.bka.sh/v1.2.0-beta
BKASH_APP_KEY=
BKASH_APP_SECRET=
BKASH_USER_NAME=
BKASH_PASSWORD=
```

### Create Payment

You can call a post request to create payment.

**Route Url:** `bkash/payment/create`
**Route Name:** `bkash.payment.create`
**Method:** `POST`
**Request Body:**
| Key | Type | Description |
| --- | --- | --- |
| amount | integer | Amount of the payment |
| reference | string | Payment Reference |
| invoice | string | Invoice Number |
| redirect | string | Redirect URL |

## Admin Panel

You can access the admin panel by visiting `/bkash` route.

### Admin Panel Access User

You can set the admin panel access user by setting the `allowed_emails` in your `config/bkash.php` file.

```bash
'allowed_emails' => [
  'polashmahmud@gmail.com'
],
```

## Refund Payment And other features

You can refund payment and other features by using the Admin Panel.

## View

If you publish the views, you can customize the views in `resources/views/vendor/bkash` folder.

```bash
php artisan vendor:publish --provider="Polashmahmud\Bkash\BkashServiceProvider" --tag="views"
```





