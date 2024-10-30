<?php

abstract class Konvent_Widget{
	
	protected function update($targetUri,$optionName,array $params = array(), $ttl =  7200 ){ // 7200 = 60 * 60 * 2
		$widgetLastUpdate = get_option( 'konvent_'.$optionName.'_lastUpdate', 0 );
		
		if($widgetLastUpdate < time() - $ttl){
			$json = @file_get_contents('http://konvent.se/api/'.$targetUri.'/?'.http_build_query($params));
			if($events = json_decode($json)){
				update_option( 'konvent_'.$optionName.'_lastUpdate', time() );
				update_option( 'konvent_'.$optionName.'_apiData', $events );
			}
		}
	}

}