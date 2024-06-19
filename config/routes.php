<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	'/test' => 'test#index',
	'/home' => 'application#index',
	'/newTask' => 'application#add',
	'/updateTask' => 'application#update',
	'/infoTask' => 'application#info',
	'/removeTask' => 'application#remove',
);
