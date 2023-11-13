# Mobillium backend developer case study


## technologies used
- React.js with inertia.js
- Laravel 10
- Laravel sanctum for auth
- Redis for caching
- Vite for asset bundling
- Mysql for database


## how to setup project

***please run these commands***\
`composer i`\
`php artisan migrate`\
`php artisan db:seed`\
`npm install`\
`npm run build` or `npm run dev`
> if you're using brave browser you'll need to turn off blade shield because of the Vite

## how to run tests
please run `php artisan test`

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
| api/v1/posts/publish/{id}     | POST  | -                              |               |
| api/v1/posts/unpublish/{id}     | POST  | -                              |               |

## last notes
***I had intended to utilize Laravel Passport for OAuth support, but I discovered it wasn't compatible with Sanctum in Inertia.js. With time constraints in mind, I opted to stick with Sanctum instead of rewriting the entire project with Passport. It was a case of making the best decision under the circumstances of a less than ideal technology choice."***
