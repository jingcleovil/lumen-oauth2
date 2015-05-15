<?php namespace App\Http\Controllers;

use App\OAuth\OAuth2;
use Illuminate\Http\Request;

/**
 * Class TokenController
 *
 * @package App\Http\Controllers
 */
class AccessToken extends Controller
{

    /**
     * @type OAuth2
     */
    private $oauth;

    /**
     * @param OAuth2 $oauth
     */
    public function __construct(OAuth2 $oauth)
    {
        $this->oauth = $oauth;
    }

    /**
     * @return \OAuth2\Response|\OAuth2\ResponseInterface
     */
    public function authorize()
    {
        $this->oauth->setAuthType('PDO');
        return $this->oauth->token();
    }

    /**
     * @return \OAuth2\Response|\OAuth2\ResponseInterface
     */
    public function webtoken()
    {
        $this->oauth->setAuthType('JWT');
        return $this->oauth->token();
    }
}
