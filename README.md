<p align="center"><a href="http://amongfriendsapp.herokuapp.com/" target="_blank"><img src="https://github.com/Thavarshan/amongfriends/blob/main/public/img/banner.svg" width="400"></a></p>

# Among Friends

## Introduction

AmongFriends is an app that makes it easy to split bills with friends and family. We organize all your shared expenses and IOUs in one place so that everyone can see whom they owe. Whether you are sharing a ski vacation, splitting rent with roommates, or paying someone back for lunch, AmongFriends makes life easier.

## Installation

Please check the official **Laravel** installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

```bash
git clone https://github.com/Thavarshan/amongfriends.git
```

Switch to the repo folder

```bash
cd amongfriends
```

Install all the dependencies using composer

```bash
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```bash
cp .env.example .env
```

Generate a new application key

```bash
php artisan key:generate
```

Run the database migrations (**Set the database connection in .env before migrating**)

```bash
php artisan migrate
```

Start the local development server

```bash
php artisan serve
```

You can now access the server at http://localhost:8000

**TL;DR command list**

```bash
git clone git@github.com:gothinkster/laravel-realworld-example-app.git
cd laravel-realworld-example-app
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:generate
```

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

```bash
php artisan migrate
php artisan serve
```

## Usage

Once you are at the welcome screen you should be able to see a text box with the label **Billing records in JSON format** and a button that says **Upload billing records**. You can either copy and paste the appropriate format of billing data on the text-box or upload a `.txt` or `.json` file.

> Please use valid `JSON` data format otherwise the application will reject your request.

A sample data format is provided:

```json
[
    {
        "day": 1,
        "amount": 50,
        "paid_by": "Tanu",
        "friends": ["Kasun", "Tanu"]
    },
    {
        "day": 2,
        "amount": 100,
        "paid_by": "Kasun",
        "friends": ["Kasun", "Tanu", "Liam"]
    },
    {
        "day": 3,
        "amount": 100,
        "paid_by": "Liam",
        "friends": ["Liam", "Tanu", "Liam"]
    }
]
```

A variation of the billing data that you may use is of **friends-of-friend** concept. This is where one of your friends brings along their friends and the bill is split according to the number of people using it but the person who brings along his/her friends will have to pay for their friends.

Sample data for such a scenario is provided:

```JSON
[
    {
        "day": 1,
        "amount": 50,
        "paid_by": "Tanu",
        "friends": ["Kasun", "Tanu"]
    },
    {
        "day": 2,
        "amount": 100,
        "paid_by": "Kasun",
        "friends": ["Kasun", ["Tanu", "Ken"], "Liam"]
    },
    {
        "day": 3,
        "amount": 100,
        "paid_by": "Liam",
        "friends": ["Liam", "Tanu", "Liam"]
    }
]
```

**The application will only let you use it 3 times before locking up for 10 minutes. This is to prevent spamming.**

## Security Vulnerabilities

Please review [our security policy](https://github.com/thavarhan/amongfriends/security/policy) on how to report security vulnerabilities.

## License

AmongFriends is not open-sourced and the software is privately owned.
