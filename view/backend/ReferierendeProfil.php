<?php

/**
 * Description of ReferierendeProfil
 *
 * @author KWM
 */
class ReferierendeProfil {
	public static function maskHandler($wp_user) {		
		wp_nonce_field('ref_user', 'ref_user_nonce');
		
		if(is_admin() && isset($_GET['freigabe_admin']) && $_GET['freigabe_admin'] == 'true') {
			Referierende_Control::freigabe($wp_user->ID);
		}
		
		$referierende = new Referierende($wp_user->ID);
		
		$landChecked[0]  = (in_array('baden-wuerttemberg', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[1]  = (in_array('bayern', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[2]  = (in_array('berlin', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[3]  = (in_array('brandenburg', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[4]  = (in_array('bremen', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[5]  = (in_array('hamburg', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[6]  = (in_array('hessen', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[7]  = (in_array('mecklenburg-vorpommern', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[8]  = (in_array('niedersachsen', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[9]  = (in_array('nordrhein-westfalen', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[10] = (in_array('rheinland-pfalz', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[11] = (in_array('saarland', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[12] = (in_array('sachsen', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[13] = (in_array('sachsen-anhalt', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[14] = (in_array('schleswig-holstein', $referierende->wohnort_laender) ? ' selected' : '');
		$landChecked[15] = (in_array('thueringen', $referierende->wohnort_laender) ? ' selected' : '');
		
		include '../wp-content/plugins/RefDB/templates/backend/profil.php';
		include '../wp-content/plugins/RefDB/templates/backend/js/profil.php';
	}
	
	public static function maskExecution($user_id) {
		if( !isset($_POST['ref_user_nonce']) || 
			!wp_verify_nonce($_POST['ref_user_nonce'], 'ref_user') || 
			defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		
		$referierende = new Referierende($user_id);
		
		if(isset($_POST['ref_gender']) && $_POST['ref_gender'] == 'true' && $referierende->gender != 'true') {
			Referierende_Control::update($user_id, "gender", "true");
		} else if($_POST['ref_gender'] != 'true' && $referierende->gender == 'true') {
			Referierende_Control::update($user_id, "gender", "false");
		}
		
		Referierende_Control::update($user_id, "twitter",			sanitize_text_field($_POST['ref_twitter']));
		Referierende_Control::update($user_id, "facebook",			sanitize_text_field($_POST['ref_facebook']));
		Referierende_Control::update($user_id, "themen",			explode(", ", sanitize_text_field($_POST['ref_themen'])));
		Referierende_Control::update($user_id, "wohnort",			explode(", ", sanitize_text_field($_POST['ref_wohnort'])));
		Referierende_Control::update($user_id, "wohnort_laender",	$_POST['ref_wohnort_laender']);
		Referierende_Control::update($user_id, "aemter",			explode(", ", sanitize_text_field($_POST['ref_aemter'])));
		$referenzen = $referierende->referenzen;
		for($i = 1; isset($_POST['ref_referenz_id_' . $i]) && $_POST['ref_referenz_id_' . $i] == 'true'; $i++) {
			$referenz_name				= sanitize_text_field($_POST['ref_referenz_name_' . $i]);
			$referenz_ort				= sanitize_text_field($_POST['ref_referenz_ort_' . $i]);
			$referenz_veranstalter_in	= sanitize_text_field($_POST['ref_referenz_veranstalter_in_' . $i]);
			$referenz_datum				= sanitize_text_field($_POST['ref_referenz_datum_' . $i]);
			
			if($referenz_name == "") {
				continue;
			}
			
			$check = true;
			foreach($referenzen AS $key => $referenz) {
				if(	$referenz_name				== $referenz->name &&
					$referenz_ort				== $referenz->ort &&
					$referenz_veranstalter_in	== $referenz->veranstalter_in &&
					$referenz_datum				== $referenz->datum
				) {
					unset($referenzen[$key]);
					$check = false;
					break;
				}
			}
			
			if($check) {
				Referierende_Control::addReferenz($user_id, $referenz_name, $referenz_ort, $referenz_veranstalter_in, $referenz_datum);
			}
		}
		
		foreach($referenzen AS $referenz) {
			Referierende_Control::delReferenz($user_id, $referenz->ID);
		}
	}
	
	public static function row($actions, $user) {
		if(get_user_meta($user->ID, 'ref_freigabe_admin', true) != 'true') {
			$actions['Freigabe'] = '<a href="user-edit.php?user_id=' . $user->ID . '&freigabe_admin=true">Freigeben</a>';
		}
		return $actions;
	}
	
	public static function getFreigabe($message) {
		if($_GET['ref_key'] && Referierende_Control::pruefeAktivierung(sanitize_text_field($_GET['ref_id']), sanitize_text_field($_GET['ref_key']))) {
			Referierende_Control::aktivieren(sanitize_text_field($_GET['ref_id']));
			$referierende = new Referierende(sanitize_text_field($_GET['ref_id']));
			
			$text = "Deine Registrierung wurde erfolgreich aktiviert!";
			
			if($referierende->gender != "true") {
				$text .= " Als Nicht-FIT-Mensch musst du gegebenenfalls warten, damit die Referierenden-DB insgesamt quotiert bleibt. Bitte respektiere das.";
			}
			
			return '<p class="message">' . $text . '</p>';
		}
		return $message;
	}
}
