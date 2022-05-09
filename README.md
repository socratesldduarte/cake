# Cake Project

This project was build in Laravel 9 as a technical challenge.
All challenge requisites are described bellow:

Olá,
Estamos felizes por te ter aqui no nosso processo seletivo! 😊
A próxima etapa constitui um desafio técnico sobre PHP e Laravel. Abaixo estão as orientações.
Desafio:
Realizar o desenvolvimento da proposta aa seguir utilizando ao máximo as funcionalidades do framework Laravel em sua versão mais recente.
- Criar um CRUD de rotas de API para o cadastro de bolos.
- Os bolos deverão ter Nome, Peso (em gramas), Valor, Quantidade disponível e uma lista
  de e-mail de interessados.
- Após o cadastro de e-mails interessados, caso haja bolo disponível, o sistema deve enviar
  um e-mail para os interessados sobre a disponibilidade do bolo.
  Casos a avaliar:
  -Pode ocorrer de 50.000 clientes se cadastrarem e o processo de envio de emails não deve
  ser algo impeditivo.
  Você pode desenvolver utilizando as sugestões abaixo.
- Utilizar fila para o envio de e-mails, caso não domine o conceito de filas poderá ser feito
  sem. ref. (https://laravel.com/docs/8.x/queues)
- Utilizar Resources para construção da API. ref
  (https://laravel.com/docs/8.x/eloquent-resources)
  Boa sorte! 🍀

## The implementation

The second requisite indicates that the client (order) list will be attached to a cake instance. To permit it, I implemented 
a json field "order" in Cake. So each "order" will be added to this field with "new" status, and processed for a command 
that will send e-mails if a new order is added for a cake with available amount.<br>
The usual implementation is make a Order model with a many to many relationship between Cake and Order - but I implemented as a json in cake to follow the requisite.<br>
I created the resource routes plus the "make" endpoint (to allow "add" a new cooked cake) and a "order" endpoint (to allow
order a cake).<br>
I didn't add unit and integration tests. Also I didn't add a "Cake Service". So these are a TODO list for this project.<br>
I added a postman collection to allow call all implemented endpoints.<br>
There is a observer in Cake Model to generate e-mails in cake insert or update - the e-mail is queued in database. To dispatch e-mails execute "php artisan queue:work".

## Installation

To install the project, clone the repository git@github.com:socratesldduarte/cake.git
Then go to project folder, copy the .env.example to .env and set the e-mail configuration (SMTP) in .env
Start the project: "sail ./vendor/bin/sail up"
In your project folder, check the "docker ps" to list containes and get the "cake_laravel" container hash.
To open this container, execute "docker exec -it <hash> bash"
To generate (or to regenerate), execute "php artisan migrate:fresh --seed" in the docker container cli (after executing the last line command).
To test endpoints, use the endpoints in the postman collection file.

## TODO List
Use a service layer between Controller and Model (Only service access the Model) - and the service has the business rules.<br>
Create unit and integration tests.