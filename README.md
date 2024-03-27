# Market Expert

Este é um projeto/teste para a vaga de Full Stack (PHP/Reactjs) da SoftExpert.

Fincheck is an application for you to easily and intuitively control your finances. Making it possible to create your accounts and balances, create transactions (income/expenses), categorize them and monitor the movement of your money.

## Objetivo

Desenvolver cadastro de produtos, tipos de cada produto, valotes percentuais de imposto dos tipos de produtos. Tela de venda onde é imformado o valor de cada item multiplicado pela quantidade adquirida e a quantidade pago de imposto em cada item, um totalizador do valor da compra e um
totalizador do valor dos impostos; A venda deverá ser salva.

##  Tecnlogia usadas

### Back-end

<ul>
   <li>PHP 8</li>
   <li>PHPUnit</li>
   <li>PostgreSQL</li>
   <li>Docker and docker compose</li>
</ul>



### Front-end

<ul>
   <li>React</li>
   <li>Typescript</li>
   <li>Vite</li>
   <li>Tailwind CSS</li>
   <li>Zod</li>
   <li>Docker and docker compose</li>
   <li>Vitest</li>
</ul>

## Como Executar

Disponibilizei o build dentro da pasta frontend, caso tenho o docker basta executar os seguintes comando:

```console
cd frontend
```
Execute o docker container

```console
docker-compose up -d
```

A aplicação esta disponivel em

```console
http://localhost:3030/
```

Caso não tenha o docker podera utilizar alguma biblioteca que exponha um servidor node, exemplo: http-server

Neste caso tenha o http-server instalado globalmente

```console
http-server -p 3030 ./dist
```

Caso queria executar a versão de desevolvimento:

```console
npm ci && npm run dev
```

