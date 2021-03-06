<?php

if ( ! function_exists('pmai_get_join_attr') ) {
	/**
	 * @param bool $attributes
	 * @return string
	 */
	function pmai_get_join_attr($attributes = false ) {
		// validate
		if( empty($attributes) ) {
			return '';
		}
		// vars
		$e = array();
		// loop through and render
		foreach( $attributes as $k => $v ) {
			$e[] = $k . '="' . esc_attr( $v ) . '"';
		}
		// echo
		return implode(' ', $e);
	}
}

if ( ! function_exists('pmai_join_attr') ) {
	/**
	 * @param bool $attributes
	 */
	function pmai_join_attr($attributes = false ){
		echo pmai_get_join_attr( $attributes );
	}
}

if ( ! function_exists('pmai_get_acf_group_by_slug') ) {

	function pmai_get_acf_group_by_slug( $slug ) {

		$local_groups = acf_get_local_field_groups();
		if ( ! empty( $local_groups[ $slug ] ) ) {
			$group     = new stdClass();
			$group->ID = $slug;
			return $group;
		}

		if (!empty($local_groups)) {
			foreach ($local_groups as $local_group) {
				if (isset($local_group['id']) && $local_group['id'] == $slug) {
					$group     = new stdClass();
					$group->ID = $slug;
					return $group;
				}
			}
		}

		$query = new WP_Query( array(
			'post_type'    => 'acf-field-group',
			'post_excerpt' => $slug
		) );

		// check count of imported pages
		$groups = $query->get_posts();
		if ( ! empty( $groups ) ) {
			return array_shift( $groups );
		}

		return false;
	}
}