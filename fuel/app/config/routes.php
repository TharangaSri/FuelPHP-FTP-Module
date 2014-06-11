<?php
return array(
        '_root_'  => 'dashboard',
	//'_root_'  => 'welcome/index',  // The default route 
	//'_404_'   => 'welcome/404',    // The main 404 route
        '_404_'   => 'welcome/not_found_view',    // Woodfin not found view route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);