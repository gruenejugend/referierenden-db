<?php

/**
 * Description of ReferierendeRegister
 *
 * @author KWM
 */
class ReferierendeRegister {
	public static function maskHandler() {
		wp_nonce_field('ref_user', 'ref_user_nonce');
		
		$first_name = (!empty($_POST['first_name'])) ? sanitize_text_field($_POST['first_name']) : '';
		$last_name = (!empty($_POST['last_name'])) ? sanitize_text_field($_POST['last_name']) : '';
		
		include 'wp-content/plugins/RefDB/templates/frontend/register.php';
	}
	
	public static function errorHandler($errors) {
		if(empty($_POST['first_name'])) {
			$errors->add('first_name_error', '<strong>FEHLER:</strong> Du musst einen Vornamen angeben!');
		}

		if(empty($_POST['last_name'])) {
			$errors->add('last_name_error', '<strong>FEHLER:</strong> Du musst einen Nachnamen angeben!');
		}
		
		return $errors;
	}
}
