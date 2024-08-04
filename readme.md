
RUN BEFORE THE CLIENT APPLICATION

1- Go to the root of the project and upload the application using the command:

    sudo docker-compose up -d

2 - Upload the database using the command:

    sudo docker exec -t php-on-hand php /var/www/html/deploy/migrate.php

WEB Routes:

    GET - /login (Login)
    GET - /users (List Users)
    GET - /user/create (New User Form)
    POST - /user/store (Send New Users)
    GET - /user/{id}/edit (Edit User Form)
    POST - /user/{id}/update (Send User Edit Form)
    GET - v1/products/{id} (Detail Products)

WEB Routes:

SEND HEADER
-Authorization: Bearer $2y$10$Z7f8NQGrbqq/3F8RuO5r7utL/yAzzlz4uyv8MGin719in/DJwrSpi

    (GET)) /lists (List of lists)
    (GET)) /list/{code}/contacts (List of contacts in a list)
    (POST)) /list/create (list creation)
    - params
    {"list":{"name":"Name of this list"}}

    (POST)) /message/create (message creation)
    - params
    {"message":{"subject":"Message subject","sender_name":"message sender","sender_email":"email@message.com","folder":"API","body":"<p>Enter your message.</p><p>We'll <em>take care</em> of the rest</p><p><u>Customized</u> message in <strong>HTML</strong></p>"}}

    (POST)) /message/send (sending message)
    - params
    {"send":{"code":"33","list":["12"]}}
    (GET)) /message/{code}/show-results (report of message sending)

Notes:
The configuration parameters are passed to the container from the environment: on line 25 of docker-composer.yml

First Steps:

1 - Access: http://localhost:4001/login
2 - The master user has the following access:
Login: admin@admin.com
Password: admin

What the application does:
Web application:
- Login
- ACL
- where we check if the user is logged in (session)
- credentials linked to the profile (role x permission)
- route protection
- verification of credentials so that options are displayed or not
- User Creation
- User Editing

API Application (Gateway):
- Verification of the Header: Authorization Bearer where the user is identified and the ACL is applied
- Based on application/json
- ACL
- where we check if the user is logged in (token)
- credentials linked to the profile (role x permission)
- route protection

What is missing:

API:

- Communication with the external API
- Communication adapters between the internal gateway and the external API, which are:
- Register lists and contacts;
- Register message;
- Send message;
- Display sending results.
Web:

- Creation of routes for consumption of the Gateway mentioned above
- Register lists and contacts;
- Register message;
- Send message;
- View sending results.
- Use of Datatables to interact with the API responses that will be translated by the gateway

Features:

- The application contains two scenarios:

- web

- api

- Use of Dependency Injection:

- web:

- Request (Layer where POST, GET, and Route Parameters are retrieved)

- ViewModel (where it only knows the data sent to it, where there is isolation between the layers)

- Session (Layer for iteration with the session for authentication and flash messages)

- Auth (Object that contains the context of an authenticated user using a session)

- Redirect (Layer where redirections and the use of flash messages are defined when necessary)

- Connection (Layer where a ready-to-use PDO instance is sent)

- container (Layer where dependencies are stored and sent to the Controller, etc. with the use of aliases such as $this->get('session') )

- api

- Request (Layer where BODY (JSON or TEXT/PLAIN) and authorization headers (Authorization Bearer) are retrieved)

- Resource (Layer responsible for traffic and DEPARA strategy between the gateway and the API)

- Response (Layer responsible for the Gateway's return (JSON or TEXT/PLAIN) and HTTP CODE)

- Connection (Layer where a ready-to-use PDO instance is sent)

- Auth (Layer responsible for user verification from the token sent in the header and used for ACL use)

- container (Layer where dependencies are stored and sent to the Controller, etc., using aliases such as $this->get('session') )

- Router (Layer where the ACL is applied before calling the controller (simulating a middleware) and responsible for calling the correct controller)

- Use of Domains:
- User
- Lists
- Contacts
- Message


The application is separated by contexts where we have the separation of the same such as:
    -> Controllers (HTTP reception and response layer and responsible for forwarding to the correct service (Business Object))
    -> Service (Layer responsible for applying the business rule)
    -> Validator (Layer responsible for validating the INPUT received by the application and instantiating a specific Exception when necessary)
    -> Repository (Layer where queries are performed in the data layer (Database in this case))
    -> Resource (Layer where queries are performed in the data layer (Database in this case))