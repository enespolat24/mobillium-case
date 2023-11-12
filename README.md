# Mobillium backend developer case study


## technologies used
- react.js with inertia.js
- laravel 10
- redis for caching
- mysql for database


## how to setup project

first run : `composer i`
then run `php artisan migrate`
then seed the database using `php artisan db:seed`
to install npm dependencies use `npm install`
to compile frontend assets we need to run `npm run build` or `npm run dev``
> if you're using brave browser you'll need to turn off blade shield

## api endpoints: 

| Endpoint         | Method  | Required Parameters            |
|------------------|---------|--------------------------------|
| api/v1/login/    | POST    | email:string, password:string          |
| api/v1/register/ | POST    | email:string, password:string, name:string          |
| /token | GET 
| api/v1/posts{id?}     | GET     | -                              |
| api/v1/posts     | POST    | content:string? title:string?                              |
| api/v1/posts     | PUT & PATCH     | content:string? title:string?                              |
| api/v1/posts/{id}     | DELETE  | -                              |               |
