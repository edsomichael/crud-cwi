# 🚀 Laravel + Microsserviço Node.js

Aplicação Laravel 11 com:

- CRUD de usuários (`name`, `email`, `password`)
- Endpoint `/health` para verificar se a API está online
- Endpoint `/external` que consome um microsserviço feito em Node.js

---

## 🧾 Requisitos

- PHP >= 8.2
- Composer
- MySQL ou PostgreSQL
- Node.js >= 18
- Git

---

## 📦 Instalação do Projeto

### 1. Clone o repositório

```bash
git clone https://github.com/edsomichael/crud-cwi.git
cd crud-cwi


composer install
cp .env.example .env

## 2. Altere os parametros

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

## 3. Gere a chave da aplicação e execute as migrations
php artisan key:generate
php artisan migrate

## 4. Executar a Aplicação
php artisan serve

## Execução do microsserviço em node.js
cd node-microservice
npm init -y
npm install express
node index.js

