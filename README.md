# ONLINE COOPERATIVE WEB APP
This project is made as final project of web programming subject 2023.

## Contributors
| Name                               | NRP        |
|------------------------------------|------------|
| Hanun Shaka Puspa                  | 5025211051 |
| Dimas Prihady Setyawan             | 50252111 84 |

## App Architecture
This project refers its architecture to [this github repository](https://github.com/gushakov/clean-php) and [this medium article](https://medium.com/unil-ci-software-engineering/clean-architecture-with-php-22de915a6c50) for implementation of clean architecture for native php.
Project structure contains :
```
|-public/
    |-index.php                 // entry file
|-src/
    |-CooperativeApp/
        |-Core/
            |-Model/            // php files in model directory represents tables in the database
            |-Port/
                |-Input/        // directories and files represents query that requires request body
                |-Output/       // tbh I'm still trying to understand this directory
                    |-Config/
                    |-Db/
                    |-Security/
                |-Presenter/    // infrastructures for the use cases
            |-UseCase/          // functions for the API calls
        |-Infrastructure/
            |-Adapter/
                |-Config/
                |-Db/
                |-Security/
                |-Web/
            |-Application/
|-templates/                    // contains html files that serves as template for the frontend
```
