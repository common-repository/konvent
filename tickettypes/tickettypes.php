<?php

/**
 * Konvent_TicketTypes
 *
 * @package Konvent
 * @author Mikael Mattsson <mikael@weblyan.se>
 */

class Konvent_TicketTypes extends Konvent_Widget{
	
	function init(){
		$widgetOptions = array('description' => 'Ett events aktiva biljettyper.');
		wp_register_sidebar_widget( 'konvent_ticketTypes_widget','Konvent.se: Biljetter', array($this,'widget'), $widgetOptions);
		wp_register_widget_control('konvent_ticketTypes_widget','konvent_ticketTypes_widget',array($this,'widgetControl'));
		add_shortcode( 'konvent-ticketTypes', array($this,'shortcode') );
	}
	
	function widget(){
		$uri = get_option('konvent_ticketTypes_uri','');
		$this->update(array('uri'=>$uri));
		
		$apiData = get_option( 'konvent_ticketTypes_apiData', array() );
		$title = get_option( 'konvent_ticketTypes_widget_title', 'Biljetter' );
		if(isset($apiData->tickettypes) && is_array($apiData->tickettypes))
			include 'views/widget.php';
	}
	
	function widgetControl($args=array(), $params=array()) {
		if (isset($_POST['submitted'])) {
			update_option('konvent_ticketTypes_lastUpdate', 0 );
			update_option('konvent_ticketTypes_widget_title', $_POST['konvent_ticketTypes_widget_title']);
			update_option('konvent_ticketTypes_uri', $_POST['konvent_ticketTypes_uri']);
		}	
		$konvent_ticketTypes_uri = get_option('konvent_ticketTypes_uri','');
		$konvent_ticketTypes_widget_title = get_option('konvent_ticketTypes_widget_title', 'Biljetter' );
		
		include 'views/widget-control.php';
	}
	
	function update($params){
		parent::update('event','ticketTypes',$params,(60 * 10)); //10 minutes
	}
	
	function shortcode($atts) {
		extract( shortcode_atts( array(
				'uri' => '',
			), $atts ) );
		if(!$uri)
			return '[Shortcode error. Required attribute “uri” missing]';
		$this->update(array('uri'=>$uri));
		$apiData = get_option( 'konvent_ticketTypes_apiData', array() );
		ob_start();
		if(isset($apiData->tickettypes) && is_array($apiData->tickettypes))
			include 'views/content.php';
		return ob_get_clean();
	}
	
}