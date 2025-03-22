<?php

namespace Middlewares;

use Hyper\Request;
use Hyper\Response;

/**
 * Class CsrfProtectionMiddleware
 * 
 * CSRF protection middleware class. This class is responsible for
 * validating the CSRF token sent in the request. If the token is
 * invalid or missing, it returns a 403 Forbidden response.
 */
class CsrfProtectionMiddleware
{
    /**
     * An array of URI paths that should be excluded from CSRF verification.
     *
     * These paths will be matched against the request URI, and if a match is found,
     * the CSRF token validation will be skipped for that request.
     *
     * @var array
     */
    protected array $except = [
        '/api/*' // Exclude all API routes from CSRF protection
    ];

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
        if ($request->isPostBack() && !$this->skip($request)) {
            // Retrieve the CSRF token from the POST data
            $token = $request->post('_token', $request->header('x-csrf-token'));

            // Validate the CSRF token against the cookie token
            if (!$token || !hash_equals(cookie('csrf_token'), $token)) {
                // Return a 403 Forbidden response if the token is invalid
                return new Response('Invalid CSRF token', 403);
            }
        }
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function skip(Request $request): bool
    {
        // If the except property is empty, return false
        if (empty($this->except)) {
            return false;
        }

        // Iterate over the except array
        foreach ($this->except as $url) {
            // If the URL ends with a wildcard, check if the request path starts with the URL
            if (substr($url, -1) === '*') {
                $url = rtrim($url, '*');
                $skip = strpos($request->getPath(), $url) === 0;
            } else {
                // Otherwise, check if the request path is equal to the URL
                $skip = $url === $request->getPath();
            }

            // If the request path matches the URL, return true
            if ($skip) {
                return true;
            }
        }

        // If no matching URL is found, return false
        return false;
    }
}