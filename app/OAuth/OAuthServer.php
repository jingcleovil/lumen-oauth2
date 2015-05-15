<?php namespace App\OAuth;

use Illuminate\Http\Request;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\UserCredentials;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\Server;
use OAuth2\Storage\Memory;
use OAuth2\Storage\Pdo;

/**
 * Class OAuthServer
 *
 * @package App\OAuth
 */
class OAuthServer
{

    /**
     * @type Request
     */
    private $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $authType
     *
     * @return Server
     */
    public function init($authType)
    {
        if (strtoupper($authType === "JWT")) {
            return $this->JwtStorage();
        }

        return $this->PdoStorage();
    }

    /**
     * @return Server
     */
    private function PdoStorage()
    {
        $storage = new Pdo([
            'dsn'      => "mysql:dbname=" . getenv('DB_DATABASE') . ";host=localhost",
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD')
        ]);

        $server = new Server($storage);

        $server->addGrantType(new UserCredentials($storage));
        $server->addGrantType(new AuthorizationCode($storage));

        return $server;
    }

    /**
     * @return Server
     */
    private function JwtStorage()
    {
        $storage = new Pdo([
            'dsn'      => "mysql:dbname=" . getenv('DB_DATABASE') . ";host=localhost",
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD')
        ]);

        $server = new Server($storage, [
            'use_jwt_access_tokens' => true
        ]);

        $server->addGrantType(new ClientCredentials($storage));

        return $server;
    }
}