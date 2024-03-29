<?php
/*
Plugin Name: pootle page builder for photography
Plugin URI: http://pootlepress.com/
Description: Boilerplate for fast track Pootle Page Builder Addon Development
Author: Shramee
Version: 1.0.0
Author URI: http://shramee.com/
*/

/** Plugin admin class */
require 'inc/class-admin.php';
/** Plugin public class */
require 'inc/class-public.php';
/** Including Main Plugin class */
require 'class-pootle-pb-for-photography.php';
/** Intantiating main plugin class */
pootle_page_builder_for_photography::instance( __FILE__ );

/** Including PootlePress_API_Manager class */
require_once plugin_dir_path( __FILE__ ) . 'pp-api/class-pp-api-manager.php';

/** Instantiating PootlePress_API_Manager */
new PootlePress_API_Manager(
	pootle_page_builder_for_photography::$token,
	'pootle page builder for photography',
	pootle_page_builder_for_photography::$version,
	pootle_page_builder_for_photography::$file,
	pootle_page_builder_for_photography::$token
);
