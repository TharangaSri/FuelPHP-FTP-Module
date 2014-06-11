<?php
/**
 * The production database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
                'server'     => \Config::get('server'),
		'database'   => \Config::get('database'),
		'username'   => \Config::get('user'),
		'password'   => \Config::get('password'),
            
	),
);
