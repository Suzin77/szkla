## Installation

- Clone repository
- run ```composer install```
- configure DB connection in .env
- run migrations by ```php app/console doctrine:migrations:migrate```

To test sending mail via mailtrap add line in .env file 
```MAILER_DSN=smtp://username:password@smtp.mailtrap.io:2525/?encryption=ssl&auth_mode=login```
