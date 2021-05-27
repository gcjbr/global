## Setup

- Clone the project
- Run composer install
- Create your .env and update the data with your database info
- add a API_KEY with a random value of your choosing
- Run php artisan:migrate to create your table

## Usage

- With a REST client, such as Postman, with the endpoinds making sure you have the right apikey value on your headers.
- Endpoinds are
- **create**
- **show/{id}**
- **newest**
- **stats**
