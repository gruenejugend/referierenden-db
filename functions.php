<?php
	
	function ref_register_referenz() {
		$args = array(
			'public'				=> false,
			'publicly_queryable'	=> true,
			'show_in_nav_menus'		=> false,
			'supports'				=> array("title")
		);
		
		register_post_type(Referenz_Control::POST_TYPE, $args);
	}
	
	function ref_register_posttype() {
		ref_register_referenz();
	}
	add_action('init', 'ref_register_referenz');
	
	function ref_get_url($with) {
		$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		
		if($with) {
			if($url != str_replace($url, "?", "")) {
				$url .= "&";
			} else {
				$url .= "?";
			}
		}
		
		return $url;
	}