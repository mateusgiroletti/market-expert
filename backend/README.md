# Backend

## Como Executar Com Docker

Utilizei o docker para subir os serviços necessarios, assim não é preciso realizer o restore do banco de dados. Caso tenha o docker instalado basta:

Clonar este projeto em algum diretorio e mudar para basta backend

```console
cd backend
```
o arquivo .env ja esta com as credenciais necessarias para o banco de dados caso seja necessario ajusteos

Execute o docker container

```console
docker-compose up -d
```
A aplicação estara disponivel em

```console
http://localhost:8080/
```
## Como Executar Sem Docker

Necessario ter PHP instalado e o postgres.

Ajustar o .env para as credenciais necessarias conforme seu banco de dados.

Fazer o dump da basededados, o arquivo esta na raiz do projeto backend (dump.sql)

Usar o servidor nativo do PHP

```console
php -S localhost:8080
```

A aplicação estara disponivel em

```console
http://localhost:8080/
```

## Como resvolvi o problema

Para o banco de dados dividi as tabelas da seguinte forma:

<p align="center">
    <img  src="./.github/images/data_model.jpg">
</p>

Para a codificação criei uma API HTTP simples, segui principios da arquitetura limpa, focando assim em uma melhor separação das responsabilidades entres as diferentes camadas da aplicação.

<ul>
    <li>Entity: representam os objetos de domínio do sistema, abstrações dos conceitos centrais da aplicação</li>
    <li>Use Cases: responsáveis por conter a lógica de negócio da aplicação. Eles recebem dados dos controllers, coordenam as operações necessárias e interagem com os repositórios para acessar os dados</li>
    <li>Controllers: validam os dados das requisições HTTP e chamam os casos de uso apropriados</li>
    <li>Infraestrutura: responsável por fornecer acesso aos recursos externos, como banco de dados </li>
    <li>Repositórios: responsáveis por abstrair o acesso aos dados da aplicação. Eles implementam interfaces definidas na camada de domínio e fornecem métodos para recuperar, armazenar e manipular objetos de domínio. </li>
    <li>Factories: responsáveis por criar instâncias de objetos complexos</li>
    <li>Injeção de dependencias: são injetadas por meio do construtor, permitindo assim que diferentes implementações possam ser facilmente substituídas.</li>
</ul>

Testes automatizados

Criei testes automizados, focando nos unitarios, estão na raiz dentro de /tests.

Para executar eles basta conectar ao container:

docker compose exec market-expert-app bash

executar 

./vendor/bin/phpunit

## Rotas da API

### Criação de productos [POST /products]

+ Request (application/json)
   + Body

            {
                "name": "Teste",
                "price": 10
            }

+ Response 201 (application/json)
    + Body

            []

### Busca de productos [GET /products]

+ Request (application/json)

+ Response 200 (application/json)
    + Body

           [
                {
                    "id": 1,
                    "name": "Teste 1",
                    "price": 10.99
                },
                {
                    "id": 2,
                    "name": "Teste 2",
                    "price": 50
                },...
           ]

### Busca de produto por {ID} [GET /productsById?product_id={ID}]

Substituir {ID} pelo productId

+ Request (application/json)

+ Response 200 (application/json)
    + Body

            {
                "id": 1,
                "name": "Teste 1",
                "price": 10.99,
                "total_percentage_tax": 660
            }

### Criação de tipo de produto [POST /product-types]

Aqui o backend ja cria os impostos para o determinado tipo de produto.

+ Request (application/json)
   + Body

           {
                "name": "Teste",
                "product_id": 1,
                "percentages": [
                    "10",
                    "20",
                    "40",
                    "50"
                ]
            }

+ Response 201 (application/json)
    + Body

            []

### Busca de tipos do produto por {ID} [GET /product-types?product_id={ID}]

Substituir {ID} pelo productId

+ Request (application/json)

+ Response 200 (application/json)
    + Body

           [
                {
                    "id": 1,
                    "name": "Teste 1",
                    "product_id": 1
                },
                {
                    "id": 2,
                    "name": "teste 2",
                    "product_id": 1
                },
                {
                    "id": 3,
                    "name": "Teste",
                    "product_id": 1
                },..
                ]

### Criação da venda [POST /sales]

+ Request (application/json)
   + Body

            {
                "products": [
                    {
                        "product_id": 1,
                        "amount": 4
                    },
                    {
                        "product_id": 2,
                        "amount": 3
                    }
                ]
            }

+ Response 201 (application/json)
    + Body

            []