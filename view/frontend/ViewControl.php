<?php

/**
 * Description of ViewControl
 *
 * @author KWM
 */
class ViewControl {
	public static function maskHandler() {
		if(!isset($_GET['profile'])) {
			self::maskFilter();
			
			$results = self::filterExecute();
			if(!empty($results)) {
				include 'wp-content/plugins/RefDB/templates/frontend/header.php';
				foreach($results AS $result) {
					self::maskResult($result);
				}
				include 'wp-content/plugins/RefDB/templates/frontend/footer.php';
			} else {
				echo "Leider nichts gefunden.";
			}
		} else {
			$error = self::profileExecute();
			
			self::maskProfile($error);
		}
	}
	
	public static function maskFilter() {
		if(!empty($_POST['wohnort_laender'])) {
			$landChecked[0]  = (in_array('baden-wuerttemberg', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[1]  = (in_array('bayern', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[2]  = (in_array('berlin', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[3]  = (in_array('brandenburg', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[4]  = (in_array('bremen', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[5]  = (in_array('hamburg', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[6]  = (in_array('hessen', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[7]  = (in_array('mecklenburg-vorpommern', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[8]  = (in_array('niedersachsen', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[9]  = (in_array('nordrhein-westfalen', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[10] = (in_array('rheinland-pfalz', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[11] = (in_array('saarland', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[12] = (in_array('sachsen', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[13] = (in_array('sachsen-anhalt', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[14] = (in_array('schleswig-holstein', $_POST['wohnort_laender']) ? ' selected' : '');
			$landChecked[15] = (in_array('thueringen', $_POST['wohnort_laender']) ? ' selected' : '');
		}
		
		include 'wp-content/plugins/RefDB/templates/frontend/filter.php';
	}
	
	public static function filterExecute() {
		$args = array();
		if(isset($_POST['submit'])) {
			if( !isset($_POST['ref_filter_nonce']) || 
				!wp_verify_nonce($_POST['ref_filter_nonce'], 'ref_filter') || 
				defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}
		
			if(!empty($_POST['gender']) && $_POST['gender'] == 'true') {
				$args['FIT'] = 'true';
			}

			if(!empty($_POST['thema'])) {
				$explode = explode(", ", $_POST['thema']);
				$values = array();
				foreach($explode AS $value) {
					$values[] = sanitize_text_field($value);
				}

				$args['themen'] = $values;
			}

			if(!empty($_POST['wohnort'])) {
				$explode = explode(", ", $_POST['wohnort']);
				$values = array();
				foreach($explode AS $value) {
					$values[] = sanitize_text_field($value);
				}

				$args['wohnort'] = $values;
			}

			if(!empty($_POST['wohnort_laender'])) {
				$values = array();

				foreach($_POST['wohnort_laender'] AS $value) {
					$values[] = sanitize_text_field($value);
				}

				$args['wohnort_land'] = $values;
			}
		}
		
		return Referierende_Control::sucheGleich($args);
	}
	
	public static function maskResult($referierende) {
		include 'wp-content/plugins/RefDB/templates/frontend/entry.php';
	}
	
	public static function maskProfile($error) {
		if(isset($_GET['profile'])) {
			$id = sanitize_text_field($_GET['profile']);
		}
		
		$referierende = new Referierende($id);
		include 'wp-content/plugins/RefDB/templates/frontend/profil.php';
	}
	
	public static function profileExecute() {
		$error = array();
		if(isset($_POST['kontakt_submit'])) {
			if( !isset($_POST['ref_profil_nonce']) || 
				!wp_verify_nonce($_POST['ref_profil_nonce'], 'ref_profil') || 
				defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}
			
			if(!filter_var($_POST['kontakt_mail'], FILTER_VALIDATE_EMAIL)) {
				$error[] = "mail";
			}
			
			if($_POST['kontakt_name'] == "") {
				$error[] = "name";
			}
			
			if($_POST['kontakt_text'] == "Deine Nachricht") {
				$error[] = "text";
			}
			
			$referierende = new Referierende(sanitize_text_field($_GET['profile']));
			
			if(empty($error)) {
				$subject = "RefDB: Eine Neue Anfrage!";
				$mail = sanitize_text_field($_POST['kontakt_mail']);
				
				$text = "Hallo,\r\n\r\nDu hast eine neue Anfrage durch die Referierenden-Datenbank der GRÜNEN JUGEND erhalten.\r\n\r\n\r\n\r\n"
						. "Name des Anfragenden: " . sanitize_text_field($_POST['kontakt_name']) . "\r\n\r\n"
						. "Mail-Adresse des Anfragenden: " . $mail . "\r\n\r\n"
						. "Text der Anfrage:\r\n\r\n"
						. sanitize_text_field($_POST['kontakt_text']);
				
				wp_mail($referierende->user_email, $subject, $text, "From: " . $mail);
				
				$error[] = "erfolg";
			}
		}
		return $error;
	}
}
