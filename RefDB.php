<?php

/*
	Plugin Name: RefDB
	Plugin URI: http://www.kay-wilhelm.de
	Description: Referierenden Datenbank der GRÜNEN JUGEND
	Author: Kay Wilhelm Mähler
	Author URI: http://www.kay-wilhelm.de
	Version: 1.0.0
*/
	
	ini_set('display_errors', '1');
	
	defined('ABSPATH') or die( "Access denied !" );
	define('IGELOFFICE_PATH', plugin_dir_path(__FILE__));
	define('IO_NAME','igeloffice');
	define('IO_URL', trailingslashit(plugin_dir_url(__FILE__)));
	
	wp_register_script('jqueryIO', 'https://code.jquery.com/jquery-1.11.3.min.js');
	
	require_once 'functions.php';
	
	require_once 'services/util/Referierende_Util.php';
	
	require_once 'model/Referierende.php';
	require_once 'control/Referierende_Control.php';
	require_once 'model/Referenz.php';
	require_once 'control/Referenz_Control.php';
	
	require_once 'view/backend/ReferierendeProfil.php';
	require_once 'view/frontend/ReferierendeRegister.php';
	require_once 'view/frontend/ViewControl.php';

	add_action('show_user_profile',													array('ReferierendeProfil', 'maskHandler'));
	add_action('edit_user_profile',													array('ReferierendeProfil', 'maskHandler'));
	add_action('profile_update',													array('ReferierendeProfil', 'maskExecution'), 10, 1);
	add_filter('user_row_actions',													array('ReferierendeProfil', 'row'), 10, 2);
	add_filter('login_message',														array('ReferierendeProfil', 'getFreigabe'));
	
	add_action('register_form',														array('ReferierendeRegister', 'maskHandler'));
    add_filter('registration_errors',												array('ReferierendeRegister', 'errorHandler'), 10, 3);
	add_action('user_register',														array('Referierende_Control', 'createMeta'));
	
	add_shortcode('ref_view',														array('ViewControl', 'maskHandler'));
	add_shortcode('ref_stat',														array('ViewControl', 'showQuote'));
