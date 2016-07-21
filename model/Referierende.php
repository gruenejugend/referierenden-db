<?php

/**
 * Description of Referierende
 *
 * @author KWM
 */
class Referierende {
	private $ID;
	private $user;
	
	public function __construct($id) {
		$this->ID = $id;
		$this->user = get_userdata($id);
	}
	
	public function __get($name) {
		if($name == 'ID') {
			return $this->ID;
		} elseif($name == 'gender') {
			return get_user_meta($this->ID, 'ref_gender', true);
		} else if($name == 'twitter') {
			return get_user_meta($this->ID, 'ref_twitter', true);
		} else if($name == 'facebook') {
			return get_user_meta($this->ID, 'ref_facebook', true);
		} else if($name == 'themen') {
			return get_user_meta($this->ID, 'ref_themen', false);
		} else if($name == 'wohnort') {
			return get_user_meta($this->ID, 'ref_wohnort', false);
		} else if($name == 'wohnort_laender') {
			return get_user_meta($this->ID, 'ref_wohnort_laender', false);
		} else if($name == 'aemter') {
			return get_user_meta($this->ID, 'ref_aemter', false);
		} else if($name == 'referenzen') {
			$posts = get_user_meta($this->ID, 'ref_referenz');
			
			if(empty($posts)) {
				return array();
			}
			
			$values = array();
			foreach($posts AS $post) {
				$values[] = new Referenz($post);
			}
			
			return $values;
		} else if($name == 'aktiviert') {
			return get_user_meta($this->ID, 'ref_aktiviert', true);
		} else if($name == 'frei_admin') {
			return get_user_meta($this->ID, 'ref_freigabe_admin', true);
		} else if($name == 'frei_selbst') {
			return get_user_meta($this->ID, 'ref_freigabe_selbst', true);
		} else if($name == 'first_name') {
			return $this->user->first_name;
		} else if($name == 'last_name') {
			return $this->user->last_name;
		} else if($name == 'user_url') {
			return str_replace("http://", "", $this->user->user_url);
		} else if($name == 'user_email') {
			return $this->user->user_email;
		} else if($name == 'user_login') {
			return $this->user->user_login;
		} else if($name == 'description') {
			return $this->user->description;
		} else if($name == 'name') {
			return $this->user->first_name . ' ' . $this->user->last_name;
		}
		
		return null;
	}
	
	public function equals(Referierende $ref) {
		return $this->first_name == $ref->first_name && $this->last_name == $ref->last_name;
	}
}
