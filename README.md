# services-call-storage
UNAPEC project to serve as API calls register

In order for you to get this working, you must run the following commands:

Run `composer install` to get all the dependencies.

Run `php artisan migrate` to generate the database.

Run `php -S localhost:8050 -t public` to run your server locally.

Do not forget to create your own `.env` file to setup the configuration.

# API endpoints

`GET /api/services` will return all the services called from 3rd party apps consuming this API.

`GET/api/services/:since_date[/:to_date]` will return all the services within the date range in `YYYY-MM-DD` format. (`:to_date` is optional)

To register a service call:

```
POST /api/services

body -> {
  name: 'service-name'
}
```

See it here in [heroku](http://pure-fortress-91669.herokuapp.com/)
