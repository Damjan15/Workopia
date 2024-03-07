<?php

$router->get('/', 'HomeController@index');

$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create', ['auth']);
$router->get('/listings/search', 'ListingController@search');
$router->get('/listing/{id}', 'ListingController@show');
$router->post('/listings', 'ListingController@store', ['auth']);
$router->delete('/listings/delete/{id}', 'ListingController@destroy', ['auth']);
$router->get('/listings/edit/{id}', 'ListingController@edit', ['auth']);
$router->put('/listings/{id}', 'ListingController@update', ['auth']);

$router->get('/auth/register', 'UserController@create', ['guest']);
$router->post('/auth/register', 'UserController@store', ['guest']);
$router->get('/auth/login', 'UserController@login', ['guest']);
$router->post('/auth/login', 'UserController@authenticate', ['guest']);
$router->post('/auth/logout', 'UserController@logout', ['auth']);
