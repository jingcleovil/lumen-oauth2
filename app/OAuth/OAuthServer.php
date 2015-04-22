<?php namespace App\OAuth;

use OAuth2\GrantType\UserCredentials;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\Server;
use OAuth2\Storage\Pdo;

/**
 * Class OAuthServer
 *
 * @package App\OAuth
 */
class OAuthServer
{
    /**
     * @return Server
     */
    public function init()
    {
        $pdo = new Pdo([
            'dsn'      => "mysql:dbname=" . getenv('DB_DATABASE') . ";host=localhost",
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD')
        ]);

        $server = new Server($pdo);

        $server->addGrantType(new UserCredentials($pdo));
        $server->addGrantType(new AuthorizationCode($pdo));

        return $server;
    }
}