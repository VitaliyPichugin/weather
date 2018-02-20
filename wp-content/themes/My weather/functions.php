<?php

//create menu
function myweather_setup(){
    register_nav_menus(array(
        'top'  => 'Menu',
    ));
}
add_action('after_setup_theme', 'myweather_setup');

//register scripts My weather
function myweather_scripts(){

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_script('jquery');

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js');
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array('jquery'));

}
add_action('wp_enqueue_scripts', 'myweather_scripts');


