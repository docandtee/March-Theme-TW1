<?php 

function _wp_docandtee_create_post_types() {
	
		
	register_post_type( 'friends',
		array(
			'labels' => array(
				'name' => __( 'Partners', 'docandtee' ),
				'singular_name' => __( 'Partner', 'docandtee' )
			),
			'public' => true,
			'has_archive' => false,
			'hierarchical' => false,
			'show_ui' => true,
			'show_in_rest' => true,
			'supports' => array( 'title', 'thumbnail', 'editor', 'excerpt', 'custom-fields'),
			'rewrite' => array('slug' => 'our-partners'),
		)
	);

	register_taxonomy(
		'venue-tax',
		[ 'venue', 'music', 'talk', 'workshop'],
		array(
				'hierarchical' => true,
				'label' => __( 'Venues', 'docandtee' ),
				'show_ui' => true,
				'show_in_rest' => true,
				'show_admin_column' => true,
				'rewrite' => array( 'slug' => 'venue-tax' )
		)
	);

}
add_action( 'init', '_wp_docandtee_create_post_types' );

/* Shared taxonomies 
if ( is_multisite() && get_current_blog_id() == 11 ) {
	if ( class_exists( 'docandtee_SharedTaxonomies_WP' ) ) {
		
		global $SharedTaxonomies;
		$SharedTaxonomies = docandtee_SharedTaxonomies_WP::getInstance();
		
		if ( $SharedTaxonomies instanceof docandtee_SharedTaxonomies_WP ) {
			
			//'taxonomy-slug', 'source-post-type', 'destination-post-type'
			
			$SharedTaxonomies->add_taxonomy( 'venue-tax', 'venue', array( 'venue', 'music', 'talk', 'workshop' ) );
		}
	}
}
*/