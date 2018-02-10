<?php

namespace App\Http\Middleware;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class CheckToken extends BaseMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next) {

        $this->checkForToken($request); // Check presence of a token.

        try {
            if (!$this->auth->parseToken()->authenticate()) { // Check user not found. Check token has expired.
                throw new UnauthorizedHttpException('jwt-auth', 'User not found');
            }
            return $next($request); // Token is valid. User logged. Response without any token.
        } catch (TokenExpiredException $t) { // Token expired. User not logged.
            $payload = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();

            $refreshed = JWTAuth::refresh(JWTAuth::getToken());
            \Auth::onceUsingId($payload['sub']);


        } catch (JWTException $e) {
            throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());
        }

        $response = $next($request); // Token refreshed and continue.
        $response->header('Authorization', 'Bearer ' . $refreshed);
        $response->header('new_token', $refreshed);
        return $response; // Response with new token on header Authorization.
    }

}