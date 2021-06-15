# pet-donation-api
API PET Donation

## Install

### Clone the project
`git clone https://github.com/latejaschool/pet-donation-api.git`

### Enter to directory project and run the docker
`docker-compose up -d`

### Install the dependencies
`docker-compose exec app composer install`

### Execute migrations for create database tables
`docker-compose exec app bin/console doctrine:migrations:migrate`


### Execute the project
Access on browser `http://localhost/`
