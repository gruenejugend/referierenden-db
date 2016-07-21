<?php

/**
 * Description of Referierende_Control
 *
 * @author KWM
 */
class Referierende_Control {
	public static function deletePost() {
		unset($_POST['first_name']);
		unset($_POST['last_name']);
		unset($_POST['user_email']);
		unset($_POST['user_url']);
		unset($_POST['gender']);
		unset($_POST['twitter']);
		unset($_POST['facebook']);
		unset($_POST['themen']);
		unset($_POST['wohnort']);
		unset($_POST['wohnort_laender']);
		unset($_POST['description']);
		unset($_POST['aemter']);
	}
	
	public static function create($args) {
		self::deletePost();
		$id = wp_insert_user(array(
			'user_login'	=> $args['first_name'] . ' ' . $args['last_name'],
			'user_email'	=> $args['mail']
		));
		
		$_POST['ref_user_nonce'] = wp_create_nonce('ref_user');
		
		$_POST['first_name']		= $args['first_name'];
		$_POST['last_name']			= $args['last_name'];
		$_POST['user_email']		= $args['user_email'];
		$_POST['user_url']			= $args['user_url'];
		$_POST['gender']			= $args['gender'];
		$_POST['twitter']			= $args['twitter'];
		$_POST['facebook']			= $args['facebook'];
		$_POST['themen']			= implode(", ", $args['themen']);
		$_POST['wohnort']			= implode(", ", $args['wohnort']);
		$_POST['wohnort_laender']	= implode(", ", $args['wohnort_laender']);
		$_POST['description']		= $args['description'];
		$_POST['aemter']			= implode(", ", $args['aemter']);
		
		self::createMeta($id);
		
		return $id;
	}
	
	public static function createMeta($id) {
		if( !isset($_POST['ref_user_nonce']) || 
			!wp_verify_nonce($_POST['ref_user_nonce'], 'ref_user') || 
			defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		
		self::update($id, 'first_name',			$_POST['first_name']);
		self::update($id, 'last_name',			$_POST['last_name']);
		self::update($id, 'user_email',			$_POST['user_email']);
		self::update($id, 'user_url',			$_POST['user_url']);
		if(isset($_POST['gender']) && $_POST['gender'] == 'true') {
			self::update($id, 'gender',			$_POST['gender']);
		} else {
			self::update($id, 'gender',			"false");
		}
		self::update($id, 'twitter',			$_POST['twitter']);
		self::update($id, 'facebook',			$_POST['facebook']);
		self::update($id, 'themen',				explode(", ", $_POST['themen']));
		self::update($id, 'wohnort',			explode(", ", $_POST['wohnort']));
		self::update($id, 'wohnort_laender',	explode(", ", $_POST['wohnort_laender']));
		self::update($id, 'description',		$_POST['description']);
		self::update($id, 'aemter',				explode(", ", $_POST['aemter']));
		
		update_user_meta($id, "ref_freigabe_admin", 'false');
		update_user_meta($id, "ref_freigabe_selbst", 'false');
		update_user_meta($id, "ref_aktiviert", 'false');
		
		/*
		 * TEST WORK ARROUND START
		 */
		self::freigabe($id);
		
		/*
		 * TEST WORK ARROUND ENDE
		 */
	}
	
	public static function update($id, $key, $value) {
		if(	$key != 'first_name' &&
			$key != 'last_name' &&
			$key != 'user_email' &&
			$key != 'user_url' &&
			$key != 'gender' &&
			$key != 'twitter' &&
			$key != 'facebook' &&
			$key != 'themen' &&
			$key != 'wohnort' &&
			$key != 'wohnort_laender' &&
			$key != 'description' &&
			$key != 'aemter'
		) {
			return;
		}
		
		if(!isset($value)) {
			return;
		}
		
		$prefix = 'ref_';
		if($key == 'first_name' || $key == 'last_name' || $key == 'user_email' || $key == 'user_url' || $key == 'description') {
			$prefix = "";
		}
		
		if($key == 'themen' || $key == 'wohnort' || $key == 'wohnort_laender' || $key == 'aemter') {
			delete_user_meta($id, $prefix . $key);
			
			foreach($value AS $value_1) {
				add_user_meta($id, $prefix . $key, sanitize_text_field($value_1));
			}
			
			return;
		}
		
		if($key == 'user_email' || $key == 'user_url') {
			wp_update_user(array(
				'ID'	=> $id,
				$key	=> sanitize_text_field($value)
			));
			return;
		}
		
		update_user_meta($id, $prefix . $key, sanitize_text_field($value));
	}
	
	public static function delete($id) {
		wp_delete_user($id);
	}
	
	public static function freigabe($id) {
		if(get_user_meta($id, "ref_freigabe_admin", true) != 'true') {
			update_user_meta($id, "ref_freigabe_admin", 'true');
			self::sendeAktivierung($id);
		}
	}
	
	public static function aktivieren($id) {
		if(get_user_meta($id, "ref_freigabe_selbst", true) != 'true') {
			update_user_meta($id, "ref_freigabe_selbst", 'true');

			$referierende = new Referierende($id);
			if($referierende->gender == 'true') {
				update_user_meta($id, "ref_aktiviert", 'true');
			}
			self::aktiviereNext();
		}
	}
	
	public static function getGenderFIT() {
		$users = new WP_User_Query(array(
			'meta_query'	=> array(
				'relation'	=> 'AND',
				array(
					'key'			=> 'ref_gender',
					'value'			=> 'true',
					'compare'		=> '=='
				),
				array(
					'key'			=> 'ref_aktiviert',
					'value'			=> 'true',
					'compare'		=> '=='
				)
			)
		));
		
		return $users->get_total();
	}
	
	public static function getGenderNFIT() {
		$users = new WP_User_Query(array(
			'meta_query'	=> array(
				array(
					'key'			=> 'ref_gender',
					'value'			=> 'false',
					'compare'		=> '=='
				),
				array(
					'key'			=> 'ref_aktiviert',
					'value'			=> 'true',
					'compare'		=> '=='
				)
			)
		));
		
		return $users->get_total();
	}
	
	public static function getQuote() {
		return self::getGenderFIT()-self::getGenderNFIT();
	}
	
	public static function aktiviereNext() {
		if(self::getQuote() > 0) {
			$users = new WP_User_Query(array(
				'meta_query'	=> array(
					array(
						'key'			=> 'ref_gender',
						'value'			=> 'false',
						'compare'		=> '=='
					),
					array(
						'key'			=> 'ref_aktiviert',
						'value'			=> 'false',
						'compare'		=> '=='
					),
					array(
						'key'			=> 'ref_freigabe_admin',
						'value'			=> 'true',
						'compare'		=> '=='
					),
					array(
						'key'			=> 'ref_freigabe_selbst',
						'value'			=> 'true',
						'compare'		=> '=='
					)
				),
				'orderby' => 'user_registered', 
				'order' => 'ASC'
			));
			
			$users_values = $users->get_results();
			$i = 0;
			while(self::getQuote() > 0 && isset($users_values[$i])) {
				update_user_meta($users_values[$i++]->ID, "ref_aktiviert", 'true');
			}
		}
	}
	
	public static function sendeAktivierung($id) {
		if(get_user_meta($id, "ref_freigabe_selbst", true) != 'true') {
			$key = wp_generate_password(20, false);
			update_user_meta($id, "ref_user_key", $key);

			$user = get_userdata($id);

			$message = "Hallo " . $user->first_name . ",\n\n"
					."Du hast dich in der Referierenden-DB registriert. Soeben wurdest du freigegeben. Jetzt bist du dran!\n\n"
					."Bitte bestätige uns, dass du Teil der Referierenden-DB werden möchtest. Das ist eine Sicherheitsmaßnahme.\n\n"
					."Bitte klicke auf folgenden Link:\n\n"
					.wp_login_url() . "?ref_key=" . $key . "&ref_id=" . $id . "\n\n"
					."Liebe Grüße,\n"
					."Deine Referierenden-DB";

			wp_mail($user->user_email, "Aktiviere jetzt deine Registrierung als Referierende*r", $message);
		}
	}
	
	public static function pruefeAktivierung($id, $key) {
		$key_check = get_user_meta($id, "ref_user_key", true);
		
		if($key == $key_check) {
			delete_user_meta($id, "ref_user_key");
		}
		
		return $key == $key_check;
	}
	
	/*
	 * Suchbar:
	 * - FIT
	 * - Themen
	 * - Wohnort
	 * - Wohnort-Laender
	 * - Name
	 * - Wenige Referenzen
	 */
	public static function suche($args) {
		if(count($args) > 1) {
			$array['meta_query']['relation'] = 'AND';
		}

		if(isset($args['FIT']) && $args['FIT'] == true) {
			$array['meta_query'][] = array(
				'key'		=> 'ref_gender',
				'value'		=> 'true',
				'compare'	=> '=='
			);
		} 

		if(isset($args['themen'])) {
			if(count($args['themen']) == 1) {
				$array['meta_query'][] = array(
					'key'		=> 'ref_themen',
					'value'		=> $args['themen'][0],
					'compare'	=> '=='
				);
			} else if(count($args['themen']) > 1) {
				$array_2 = array(
					'relation'	=> 'OR'
				);

				foreach($args['themen'] AS $thema) {
					$array_2[] = array(
						'key'		=> 'ref_themen',
						'value'		=> $thema,
						'compare'	=> '=='
					);
				}
				$array['meta_query'][] = $array_2;
			}
		}

		if(isset($args['wohnort'])) {
			if(count($args['wohnort']) == 1) {
				$array['meta_query'][] = array(
					'key'		=> 'ref_wohnort',
					'value'		=> $args['wohnort'][0],
					'compare'	=> '=='
				);
			} else if(count($args['wohnort']) > 1) {
				$array_2 = array(
					'relation'	=> 'OR'
				);

				foreach($args['wohnort'] AS $wohnort) {
					$array_2[] = array(
						'key'		=> 'ref_wohnort',
						'value'		=> $wohnort,
						'compare'	=> '=='
					);
				}
				$array['meta_query'][] = $array_2;
			}
		}

		if(isset($args['wohnort_land'])) {
			if(count($args['wohnort_land']) == 1) {
				$array['meta_query'][] = array(
					'key'		=> 'ref_wohnort_laender',
					'value'		=> $args['wohnort_land'][0],
					'compare'	=> '=='
				);
			} else if(count($args['wohnort_land']) > 1) {
				$array_2 = array(
					'relation'	=> 'OR'
				);

				foreach($args['wohnort_land'] AS $wohnort_land) {
					$array_2[] = array(
						'key'		=> 'ref_wohnort_laender',
						'value'		=> $wohnort_land,
						'compare'	=> '=='
					);
				}
				$array['meta_query'][] = $array_2;
			}
		}
		
		$array['meta_query'][] = array(
			'key'		=> 'ref_aktiviert',
			'value'		=> 'true',
			'compare'	=> '=='
		);

		$array['orderby'] = 'user_registered';
		$array['order'] = 'ASC';
		
		$query = new WP_User_Query($array);
		
		$users = $query->get_results();
		$values = array();
		foreach($users AS $user) {
			$values[] = new Referierende($user->ID);
		}
		
		return $values;
	}
	
	public static function sucheGleich($args) {
		if(isset($args['FIT']) && $args['FIT'] == 'true') {
			return self::suche($args);
		}
		
		$referierenden = self::suche($args);
		
		$fit = array();
		$nfit = array();
		foreach($referierenden AS $referierende) {
			if($referierende->gender == 'true') {
				$fit[] = $referierende;
			} else {
				$nfit[] = $referierende;
			}
		}
		
		$values = array();
		for($i = 0; $i < count($fit); $i++) {
			$values[] = $fit[$i];
			if(isset($nfit[$i])) {
				$values[] = $nfit[$i];
			}
		}
		
		return $values;
	}
	
	public static function addReferenz($id, $name, $ort, $veranstalter_in, $datum) {
		$ref_id = Referenz_Control::exists($name, $ort, $veranstalter_in, $datum);
		if(!$ref_id) {
			$ref_id = Referenz_Control::create($name, $ort, $veranstalter_in, $datum);
		}
		
		if(!in_array($ref_id, get_user_meta($id, "ref_referenz") ? get_user_meta($id, "ref_referenz") : array())) {
			add_user_meta($id, "ref_referenz", $ref_id);
		}
	}
	
	public static function delReferenz($id, $ref_id) {
		delete_user_meta($id, "ref_referenz", $ref_id);
		
		if(Referenz_Control::count($ref_id) == 0) {
			Referenz_Control::delete($ref_id);
		}
	}
}
