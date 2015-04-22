## Lumen with OAuth 2

Reference
http://bshaffer.github.io/oauth2-server-php-docs/cookbook/laravel/

#### Usage
````
POST /authorize
grant_type: password
client_id: testclient
client_secret: testsecret
username: testuser
password: testpassword
````

````
GET /resources
access_token: <access_token>
````

Rename .env.dist to .env and set your database credentials. 