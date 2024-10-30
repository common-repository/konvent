<?php

/**
 * Konvent
 *
 * @package   Konvent
 * @author    Mikael Mattsson <mikael@weblyan.se>
 * @link      http://konvent.se/info/wordpress/
 */

/**
 * Konvent
 *
 * @package Konvent
 * @author Mikael Mattsson <mikael@weblyan.se>
 */


include 'widget.php';
include 'eventlist/eventlist.php';
include 'tickettypes/tickettypes.php';

class Konvent {
	protected $plugin_slug = 'konvent';
	protected static $instance = null;
	protected $plugin_screen_hook_suffix = null;

	private function __construct(){
		
		//add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_styles') );
		//add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_scripts') );
		
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_styles') );
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
		
		add_action("plugins_loaded", array(new Konvent_EventList(), 'init'));
		add_action("plugins_loaded", array(new Konvent_TicketTypes(), 'init'));
	}

	public static function get_instance(){
		if (null == self::$instance) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}

	public static function activate($network_wide){
	}

	public static function deactivate($network_wide){
	}

	public function load_plugin_textdomain(){
		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		
		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

	public function enqueue_admin_styles(){
		if (! isset( $this->plugin_screen_hook_suffix )) {
			return;
		}
		
		$screen = get_current_screen();
		if ($screen->id == $this->plugin_screen_hook_suffix) {
			wp_enqueue_style( $this->plugin_slug . '-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), $this->version );
		}
	}

	public function enqueue_admin_scripts(){
		if (! isset( $this->plugin_screen_hook_suffix )) {
			return;
		}
		
		$screen = get_current_screen();
		if ($screen->id == $this->plugin_screen_hook_suffix) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array('jquery'), $this->version );
		}
	}

	public function enqueue_styles(){
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), $this->version );
	}

	public function enqueue_scripts(){
		//wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'js/public.js', __FILE__ ), array('jquery'), $this->version );
	}

	public function add_plugin_admin_menu(){
		$this->plugin_screen_hook_suffix = add_plugins_page( __( 'Konvent', $this->plugin_slug ), __( 'Menu Text', $this->plugin_slug ), 'read', $this->plugin_slug, array($this, 'display_plugin_admin_page') );
	}

	public function display_plugin_admin_page(){
		include_once ('views/admin.php');
	}

}