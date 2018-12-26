
EXECUTAR ANTES DA APLICAÇÃO CLIENTE

1- Criação do Database (Mysql) executar DUMP de storage/database/create-database.sql

2 - Alterar parametros no .env para o Banco DB_CONNECTION=mysql DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=stock_api DB_USERNAME=root DB_PASSWORD=testes


Rotas: 
    GET - /login (Login)
    GET - /users (Listar Usuarios)
    GET - /user/create (Form Novo Usuarios)
    POST - /user/store (Envio Novo Usuarios)
    GET - /user/{id}/edit (Form Editar Usuarios)
    POST - /user/{id}/update (Envio Edicao Usuarios)
    GET - v1/products/{id} (Detalhar Produtos)
   
