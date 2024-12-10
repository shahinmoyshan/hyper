<?php

namespace Middlewares;

use Hyper\Request;
use Hyper\Response;

/**
 * Class csrfProtectionMiddleware
 * 
 * CSRF protection middleware class. This class is responsible for
 * validating the CSRF token sent in the request. If the token is
 * invalid or missing, it returns a 403 Forbidden response.
 */
class csrfProtectionMiddleware
{
    /**
     * CSRF protection middleware.
     *
     * This middleware validates the CSRF token sent in the request. If the token is
     * invalid or missing, it returns a 403 Forbidden response.
     *
     * @param Request $request The current request.
     *
     * @return Response|null The response when the token is invalid, null otherwise.
     */
    public function handle(Request $request)
    {
        // Check if the request method is POST
        if ($request->getMethod() === 'POST') {
            // Retrieve the CSRF token from the POST data
            $token = $request->post('_token');

            // Validate the CSRF token against the session token
            if (!$token || $token !== session('_token')) {
                // Return a 403 Forbidden response if the token is invalid
                return new Response('Invalid CSRF token', 403);
            }
        }
    }
}