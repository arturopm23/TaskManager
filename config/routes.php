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
	'/' => 'task#index',
	'/edit' => 'task#index',
	'/index' => 'task#index',
	'/tasks' => 'task#index',
	'/detail/:id' => 'task#detail',
	'/add' => 'task#add',
	'/edit/:id' => 'task#edit',
	'/delete/:id' => 'task#delete',
	'/test' => 'test#index'
  );