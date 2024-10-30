<?php

/**
 * Konvent_EventList
 *
 * @package Konvent
 * @author Mikael Mattsson <mikael@weblyan.se>
 */

class Konvent_EventList extends Konvent_Widget{
	
	function init(){
		$widgetOptions = array('description' => 'En lista med kommande event och deras banderoller.');
		wp_register_sidebar_widget( 'konvent_eventList_widget','Konvent.se: Eventlista', array($this,'widget'), $widgetOptions);
		wp_register_widget_control('konvent_eventList_widget','konvent_eventList_widget',array($this,'widgetControl'));
		add_shortcode( 'konvent-eventlist', array($this,'shortcode') );
	}
	
	function widget(){
		$limit = get_option('konvent_eventList_limit',10);
		$this->update(array('limit'=>$limit));
		
		$apiData = get_option( 'konvent_eventList_apiData', array() );
		$title = get_option( 'konvent_eventList_widget_title', 'Konventlista' );
		if(is_array($apiData))
			include 'views/widget.php';
	}
	
	function widgetControl($args=array(), $params=array()) {
		if (isset($_POST['submitted'])) {
			update_option('konvent_eventList_lastUpdate', 0 );
			update_option('konvent_eventList_widget_title', $_POST['konvent_eventList_widget_title']);
			update_option('konvent_eventList_limit', $_POST['konvent_eventList_limit']);
		}	
		$konvent_eventList_limit = get_option('konvent_eventList_limit',10);
		$konvent_eventList_widget_title = get_option('konvent_eventList_widget_title', 'Konventlista' );
		
		include 'views/widget-control.php';
	}
	
	function update($params){
		parent::update('upcomingeventsbanner','eventList',$params);
	}
	
	function shortcode($atts) {
		extract( shortcode_atts( array(
				'limit' => 10,
			), $atts ) );
		$this->update(array('limit'=>$limit));
		$apiData = get_option( 'konvent_eventList_apiData', array() );
		ob_start();
		if(is_array($apiData))
			include 'views/list.php';
		return ob_get_clean();
	}
	
}