<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.5
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */


return array(

	/**
	 * A couple of named patterns that are often used
	 */
	'patterns' => array(
		'local'		 => '%d/%m/%y %H:%M:%S',

		'mysql'		 => '%d/%m/%y %H:%M:%S',
		'mysql_date' => '%d/%m/%y %H:%M:%S',

		'AU'		 => '%m/%d/%y %T',
		'us_short'	 => '%d/%m/%y %H:%M:%S',
		'us_named'	 => '%d/%m/%y %H:%M:%S',
		'us_full'	 => '%d/%m/%y %H:%M:%S',
		'eu'		 => '%d/%m/%y %H:%M:%S',
		'eu_short'	 => '%d/%m/%y %H:%M:%S',
		'eu_named'	 => '%d/%m/%y %H:%M:%S',
		'eu_full'	 => '%d/%m/%y %H:%M:%S',

		'24h'		 => '%d/%m/%y %H:%M:%S',
		'12h'		 => '%d/%m/%y %H:%M:%S'
	)
);
