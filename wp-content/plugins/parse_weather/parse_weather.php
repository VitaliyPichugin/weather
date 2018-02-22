<?php

/**
 * The plugin bootstrap file
 * Plugin Name:       Parse weather
 * Description:       Parse weather from website https://www.gismeteo.ua/weather-zaporizhia-5093/.
 * Version:           1.0.0
 * Author:            Vitaliy
 * Author URI:        vitaliypichugin92@gmail.com
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

wp_enqueue_style( 'parse_weather', plugin_dir_url( __FILE__ ) . 'public/css/parse_weather-public.css', array(), PLUGIN_NAME_VERSION, 'all' );
wp_enqueue_script( 'parse_weather', plugin_dir_url( __FILE__ ) . 'public/js/parse_weather-public.js', array( 'jquery' ), PLUGIN_NAME_VERSION, false );
wp_localize_script( 'parse_weather', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-parse_weather-activator.php
 */
function activate_parse_weather() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-parse_weather-activator.php';
	Parse_weather_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-parse_weather-deactivator.php
 */
function deactivate_parse_weather() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-parse_weather-deactivator.php';
	Parse_weather_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_parse_weather' );
register_deactivation_hook( __FILE__, 'deactivate_parse_weather' );


require plugin_dir_path( __FILE__ ) . 'includes/class-parse_weather.php';


function run_parse_weather() {
	$plugin = new Parse_weather();
	$plugin->run();
}
add_action('parse_weather', 'run_parse_weather');

//add function for ajax
function get_data(){
    do_action('parse_weather');
    die();
}
add_action('wp_ajax_nopriv_get_data', 'get_data');
add_action('wp_ajax_get_data', 'get_data');




