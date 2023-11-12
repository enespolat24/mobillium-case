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

## last notes
***I had intended to utilize Laravel Passport for OAuth support, but I discovered it wasn't compatible with Sanctum in Inertia.js. With time constraints in mind, I opted to stick with Sanctum instead of rewriting the entire project with Passport. It was a case of making the best decision under the circumstances of a less than ideal technology choice."***
