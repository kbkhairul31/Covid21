<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponser;
use Closure;
 use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpFoundation\Response;

class CustomerThrottleRequests extends ThrottleRequests
{

    use ApiResponser;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected function buildResponse( $key, $maxAttempts)
    {
        $response = new Response('Too many Attempts',429);

        $retryAfter = $this->limiter->availableIn($key);

        return $this->addHeaders(
            $response , $maxAttempts,
            $this->calculateRemainingAttempts($key , $maxAttempts , $retryAfter),
            $retryAfter
        );
    }


}
