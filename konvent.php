<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that also follow
 * WordPress coding standards and PHP best practices.
 *
 * @package   Konvent
 * @author    Mikael Mattsson <mikael@weblyan.se>
 * @link      http://konvent.se/info/wordpress/
 *
 * @wordpress-plugin
 * Plugin Name: Konvent
 * Plugin URI:  http://konvent.se/info/wordpress/
 * Description: List of events from Konvent.se
 * Version:     1.2.1
 * Author:      Mikael Mattsson
 * Author URI:  http://konvent.se
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-konvent.php' );

register_activation_hook( __FILE__, array( 'Konvent', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Konvent', 'deactivate' ) );

Konvent::get_instance();
