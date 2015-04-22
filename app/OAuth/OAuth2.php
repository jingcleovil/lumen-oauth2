<?php namespace App\OAuth;

use OAuth2\HttpFoundationBridge\Request as OAuthRequest;
use OAuth2\HttpFoundationBridge\Response as OAuthResponse;
use Illuminate\Http\Request;
use OAuth2\Server;
use Exception;

/**
 * Class OAuth2
 *
 * @package App\OAuth
 */
class OAuth2
{

    /**
     * @var Server
     */
    private $server;

    /**
     * @var Request
     */
    private $oauthRequest;

    /**
     * @var Response
     */
    private $oauthResponse;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param OAuthServer   $server
     * @param OAuthRequest  $oauthRequest
     * @param OAuthResponse $oauthResponse
     * @param Request       $request
     */
    public function __construct(
        OAuthServer $server,
        OAuthRequest $oauthRequest,
        OAuthResponse $oauthResponse,
        Request $request
    )
    {
        $this->server = $server->init();
        $this->oauthRequest = $oauthRequest;
        $this->oauthResponse = $oauthResponse;
        $this->request = $request;
    }

    /**
     * Will issue a token access
     *
     * @return \OAuth2\Response|\OAuth2\ResponseInterface
     */
    public function token()
    {
        return $this->server->handleTokenRequest(
            $this->initializeOAuthRequest(),
            $this->oauthResponse,
            $this->request->get('authorize')
        );
    }

    /**
     * @param $token
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function validateToken($token)
    {
        if (! $token) {

            throw new Exception('Invalid access token');
        }

        if (! $this->server->verifyResourceRequest($this->initializeOAuthRequest(), $this->oauthResponse)) {

            return $this->server->getResponse();
        }

        return true;
    }

    /**
     * @return \OAuth2\RequestInterface
     */
    private function initializeOAuthRequest()
    {
        $this->request->initialize($this->request->all());

        return $this->oauthRequest->createFromRequest(
            $this->request->instance()
        );
    }
}