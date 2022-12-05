## Laravel OJT Project

# Installation set up

## Getting Start

### git clone this repo link in your folder

`git clone https://github.com/TheintYadanarLwin/Laravel_OJT.git`

#### First time

_connect your database and copy paste these two sentenses in .env file_

```
cp .env.example .env
composer install
php artisan key:generate
npm install
```

Then you can access: http://localhost:8000

## DB

_creating tables in database_
`php artisan migrate`

_inserting data into tables_
`php artisan db:seed`

### Just run App

```
npm run dev
php artisan serve
```

_Hope you Enjoy it!👍_
