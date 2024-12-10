<?php

/**
 * This file is responsible for defining the routes of the web application.
 *
 * Each route is defined as an array with the following structure:
 *
 *     [
 *         'path' => <string>,
 *         'template' => <string>,
 *         'middleware' => <array|string>,
 *         'name' => <string>,
 *         'method' => <array|string>,
 *         'callback' => <array|string|callable>,
 *     ]
 *
 * 'path' is the URL path that the route should match.
 *
 * 'template' is the name of the template to render for the route.
 *
 * 'middleware' is string or array of middleware names that should be run before
 * the route is rendered.
 * 
 * 'name' is the name of the route.
 * 
 * 'method' is the HTTP method that the route should match.
 * 
 * 'callback' is a callback function that should be called when the route is
 *
 * @return array
 *     An array of route definitions.
 */

return [
    ['path' => '/', 'template' => 'welcome'],
];