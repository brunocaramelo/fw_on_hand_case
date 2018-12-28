
EXECUTAR ANTES DA APLICAÇÃO CLIENTE

1- Ir a raiz do projeto e subir a aplicação com o uso do comando:

    sudo docker-compose up -d


2 - Subir a base de dados com o comando:

    sudo docker exec -t php-on-hand php /var/www/html/deploy/migrate.php

Rotas WEB: 

    GET - /login (Login)
    GET - /users (Listar Usuarios)
    GET - /user/create (Form Novo Usuarios)
    POST - /user/store (Envio Novo Usuarios)
    GET - /user/{id}/edit (Form Editar Usuarios)
    POST - /user/{id}/update (Envio Edicao Usuarios)
    GET - v1/products/{id} (Detalhar Produtos)
   
Observações:
    O parametros de configuração são passado ao conteiner a partir do environment: na linha 25 do docker-composer.yml

Primeiros Passos:

    1 - Acessar: http://localhost:4001/login
    2 - O usuário master tem como acesso:
        Login: admin@admin.com
        Senha: admin


Oque a aplicação Faz:
    Aplicação Web :
        - Login
        - ACL 
            - onde temos verificação se o usuario esta logado (sessão)
            - credenciais vinculadas ao perfil (role x permission)
            - proteção de rotas
            - verificação de credencias para que sejam exibidas ou não opções
        - Criação de Usuários
        - Edição de usuários

    
    Aplicação API(gatway):
        - Verificação do Header: Authorization Bearer onde o usuário e identificado e o ACL e aplicado
        - Baseada em application/json
        - ACL 
            - onde temos verificação se o usuario esta logado (token)
            - credenciais vinculadas ao perfil (role x permission)
            - proteção de rotas

Oque falta:

    API:

    - Comunicação com A API externa
    - Adapters de comunicação entre o gateway interno para a API externa sendo eles:
        - Cadastrar listas e contatos;
        - Cadastrar mensagem;
        - Enviar mensagem;
        - Exibir resultados do envio.
    Web:

        - Criação de rotas para consumo do Gateway mencionado acima
            - Cadastrar listas e contatos;
            - Cadastrar mensagem;
            - Enviar mensagem;
            - Exibir resultados do envio.
        - Uso de Datatables para interação com as respostas da API que sera traduzida pelo gateway

Caracteristicas:

    - A aplicação contem dois cenarios:
        - web
        - api

    - Uso de Injeção de depencias:

        - web:

            - Request (Camada onde ocorre recuperação de POST, GET, Parametros de rota)

            - ViewModel (onde a mesma apenas conhece dados enviados a ela, onde existe um isolamente entre as camadas)

            - Session (Camada para iteção com a sessão para autenticação e flash messages)

            - Auth (Objeto que contem o contexto de um usuario autenticado com o uso de sessao)

            - Redirect (Camada onde sao definidos os redirecionamentos e o uso de flash messages quando necessario)

            - Connection (Camada onde é enviada uma instancia do PDO pronta para uso)

            - Conteiner (Camada onde são armazedas as dependencias e enviadas ao Controller e etc com o uso de apelidos como $this->get('session') )

        - api

            - Request (Camada onde ocorre recuperação BODY (JSON ou TEXT/PLAIN) e cabeçalhos de autorização (Authorization Bearer) )

            - Response (Camada responsavel pelo retorno do Gateway (JSON ou TEXT/PLAIN) e HTTP CODE )

            - Connection (Camada onde é enviada uma instancia do PDO pronta para uso)

            - Auth ( Camada responsavel pela verificação de usuario a partir do token enviado no header e usado para o uso do ACL )
            - Conteiner (Camada onde são armazedas as dependencias e enviadas ao Controller e etc com o uso de apelidos como $this->get('session') )

    - Router (Camada onde o ACL é aplicado antes da chamada do controller (simulando um middleware) e responsavel por               chamar o controller correto )


    - Uso de Dominios:
        - Aplicação é separada por contextos onde temos a separação dos mesmos tais como:
            - Users:
                -> Controllers (Camada de recepçao e resposta HTTP e responsavel por encaminhar ao service (Business Object) correto )
                -> Service (Camada responsavel pela aplicação da regra de negocio )
                -> Validator (Camada responsavel pela validação do INPUT recebido pela aplição e instanciando uma           Excessao expecifica quando necessario)
                -> Repository ( Camada onde sao realizadas as consultas na camada de dados (Banco de dados no caso))

