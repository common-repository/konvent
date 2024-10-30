=== Konvent ===
Contributors: konvent
Tags: events, konvent
Requires at least: 3.0.0
Tested up to: 3.5.1
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds widgets and shortcodes for integration with the free swedish ticket service, Konvent.se.

== Description ==

The official plugin for interaction with the free swedish ticket service for events and conventions, konvent.se.

The plugin will add a widet that displays a list of upcoming events and their featured banners. These images will not be stored locally by the on your site.

More features will be included in future releases.

= Shortcodes =

If you dont like widgets you can use the shortcodes instead. 

[konvent-eventlist]
Lists 10 events.

[konvent-eventlist limit=999] 
Lists all the upcoming events.


[konvent-ticketTypes uri=testcon02]
Lists the different tickets that can be bought.

Warning! Don't use different settings on shortcodes or widgets of the same type. Their settings are global and will cause conflicts.

== Installation ==

1. Upload folder `konvent` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to the widgets section in your admin panel and drag the widget to the desired location

== Screenshots ==

1. The event list widget
1. The tickets widget

== Changelog ==

= 1.2.0 =
* Minor buggfix and css fix

= 1.2.0 =
* Widget and shortcode for event tickets.

= 1.1.0 =
* Added to the Wordpress.org Plugin Directory

= 1.0.0 =
* initial
