
EXECUTAR ANTES DA APLICAÇÃO CLIENTE

1- Ir a raiz do projeto e subir a aplicação com o uso do comando:

    sudo docker-compose up -d


2 - Subir a base de dados com o comando:

    sudo docker exec -t php-on-hand php /var/www/html/deploy/migrate.php

Rotas: 
    GET - /login (Login)
    GET - /users (Listar Usuarios)
    GET - /user/create (Form Novo Usuarios)
    POST - /user/store (Envio Novo Usuarios)
    GET - /user/{id}/edit (Form Editar Usuarios)
    POST - /user/{id}/update (Envio Edicao Usuarios)
    GET - v1/products/{id} (Detalhar Produtos)
   
