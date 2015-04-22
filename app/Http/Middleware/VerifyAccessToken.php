<?php namespace App\Http\Middleware;

use App\OAuth\OAuth2;
use Closure;
use Exception;
use Illuminate\Http\Request;

/**
 * Class VerifyAccessToken
 *
 * @package App\Http\Middleware
 */
class VerifyAccessToken
{

    /**
     * @var OAuth2
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
     * @param Request  $request
     * @param callable $next
     *
     * @return bool
     *
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        $validation = $this->oauth->validateToken($request->get('access_token'));

        if ($validation !== true) {

            return $validation;
        }

        return $next($request);
    }
}
