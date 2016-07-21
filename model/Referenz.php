<?php

/**
 * Description of Referenz
 *
 * @author KWM
 */
class Referenz {
	private $post;
	
	public function __construct($id) {
		$this->post = get_post($id);
	}
	
	public function __get($name) {
		if($name == "ID") {
			return $this->post->ID;
		} else if($name == "name") {
			return $this->post->post_title;
		} else if($name == "ort") {
			return get_post_meta($this->post->ID, "ref_referenz_ort", true);
		} else if($name == "veranstalter_in") {
			return get_post_meta($this->post->ID, "ref_referenz_veranstalter_in", true);
		} else if($name == "datum") {
			return get_post_meta($this->post->ID, "ref_referenz_datum", true);
		}
	}
	
	public function equals(Referenz $referenz) {
		return ($referenz->name == $this->post->post_title);
	}
}
