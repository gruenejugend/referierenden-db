<?php

/**
 * Description of Referenz_Control
 *
 * @author KWM
 */
class Referenz_Control {
	const POST_TYPE = 'ref_referenz';
	
	public static function create($name, $ort, $veranstalter_in, $datum) {
		$id = wp_insert_post(array(
			'post_title'			=> $name,
			'post_type'				=> self::POST_TYPE,
			'post_status'			=> 'publish'
		));
		
		update_post_meta($id, "ref_referenz_name", $name);
		update_post_meta($id, "ref_referenz_ort", $ort);
		update_post_meta($id, "ref_referenz_veranstalter_in", $veranstalter_in);
		update_post_meta($id, "ref_referenz_datum", $datum);
		
		return $id;
	}
	
	public static function delete($id) {
		wp_delete_post($id);
	}
	
	public static function exists($name, $ort, $veranstalter_in, $datum) {
		$query = new WP_Query(array(
			'post_type'		=> self::POST_TYPE,
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'ref_referenz_name',
					'value'		=> $name
				),
				array(
					'key'		=> 'ref_referenz_ort',
					'value'		=> $ort
				),
				array(
					'key'		=> 'ref_referenz_veranstalter_in',
					'value'		=> $veranstalter_in
				),
				array(
					'key'		=> 'ref_referenz_datum',
					'value'		=> $datum
				)
			)
		));
		
		if($query->found_posts == 0) {
			return false;
		}
		
		while($query->have_posts()) {
			$query->the_post();
			return $query->post->ID;
		}
	}
	
	public static function count($referenz) {
		$query = new WP_User_Query(array(
			'meta_query'	=> array(
				array(
					'key'			=> 'ref_referenz',
					'value'			=> $referenz
				)
			)
		));
		
		return $query->get_total();
	}
}
