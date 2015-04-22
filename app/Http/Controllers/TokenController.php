<?php namespace App\Http\Controllers;

use App\OAuth\OAuth2;

/**
 * Class TokenController
 *
 * @package App\Http\Controllers
 */
class TokenController extends Controller
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
        return $this->oauth->token();
    }
}
