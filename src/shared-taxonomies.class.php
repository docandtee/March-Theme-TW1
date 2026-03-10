<?php

/* Main plug-in class. */
class docandtee_SharedTaxonomies_WP {
	
	/* Plug-in setup. */
	const version = '1';
	
	/* Plug-in helpers & settings. */
	private static $instance = false; // Instance tracker.
	private $settings = null; // Holds plugin settings.
	private $init_functions = array();
	
	/* Taxonomies. */
	private $shared_taxonomies = array();
	private $src_post_types = array();
	private $dst_post_types = array();
	
	
	/* If an instance exists, returns it.  If not, it creates one and return it. */
	final public static function getInstance() {
		
		if ( !self::$instance ) {
			// No instance; Create a new instance of DocandTee_JSON class.
			self::$instance = new self;
		}
		
		return self::$instance;
		
	}
	
	/* Constructing function - setup plug-in. */
	public function __construct() {
		
		/* Store instance if not already done so. */
		if ( !self::$instance ) {
			self::$instance = $this;
		}
		
		/* Add plugin setup. */
		add_action( 'init', array( $this, 'plugin_init' ), 150 );
		add_action( 'save_post', array( $this, 'save_post' ), 10, 1 );
		add_action( 'before_delete_post', array( $this, 'delete_post' ) );
		add_action( 'pre_get_posts', array( $this, 'modify_query' ) );
		
	}
	
	/* Add a new taxonomy. */
	public function add_taxonomy( $slug, $src_post_type, $dst_post_type ) {
		
		if ( isset( $this->shared_taxonomies[ $slug ] ) ) {
			return false;
		}
		
		$this->shared_taxonomies[ $slug ] = array(
			'src_post_type' => $src_post_type,
			'dst_post_type' => ( array ) $dst_post_type
		);
		
		$this->src_post_types[ $slug ] = $src_post_type;
		$this->dst_post_types[ $slug ] = ( array ) $dst_post_type;
		
		return true;
		
	}
	
	/* Check if there is anything to do. */
	private function have_work() {
		return ( empty( $this->shared_taxonomies ) ) ? false : true;
	}
	
	/* On post save. */
	public function plugin_init() {
		
		if ( !$this->have_work() || empty( $this->init_functions ) ) {
			return;
		}
		
		foreach( $this->init_functions as $f ) {
			if ( is_callable( $f ) ) {
				$f();
			}
		}
		
	}
	
	/* On post save. */
	public function save_post( $post_id ) {
		
		if ( !$this->have_work() ) {
			return $post_id;
		}
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) ) {
			// Do nothing for auto-save.
			return $post_id;
		}
		
		$post_type = get_post_type( $post_id );
		if ( !in_array( $post_type, $this->src_post_types ) ) {
			// Do nothing if not a src type.
			return $post_id;
		}
		
		$taxonomy = array_search( $post_type, $this->src_post_types );
		if ( empty( $taxonomy ) ) {
			return $post_id;
		}
		
		if ( !in_array( get_post_status( $post_id ), array( 'publish', 'pending', 'draft' ) ) ) {
			
			$terms = get_the_terms( $post_id, $taxonomy );
			if ( !empty( $terms ) ) {
			
				foreach( $terms as $t ) {
					if ( 0 == $t->count ) {
						wp_delete_term( $t->term_id, $taxonomy );
					}
				}
				
			}
			
			return $post_id;
		}
		
		/*if ( !current_user_can( 'edit_post', $post_id ) ) {
			// Security check.
			return $post_id;
		}*/

		$post_title = get_the_title( $post_id );
		
		if ( !empty( $post_title ) ) {
			
			$current_terms = wp_get_post_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );
			if ( !is_wp_error( $current_terms ) && !empty( $current_terms ) ) {
				
				$update_term = (int) $current_terms[ 0 ];
				$new_slug = sanitize_title( $post_title );
				
				wp_update_term( $update_term, $taxonomy, array(
					'name' => $post_title,
					'slug' => $new_slug
				) );
				
			} else {
				
				$new_term = wp_insert_term( $post_title, $taxonomy );
				
				if ( !is_wp_error( $new_term ) ) {
					wp_set_object_terms( $post_id, $new_term[ 'term_id' ], $taxonomy, true );
				}
				
			}
			
		}
		
		return $post_id;
		
	}
	
	/* On post deletion. */
	public function delete_post( $post_id ) {
		
		if ( !$this->have_work() ) {
			return $post_id;
		}
		
		$post_type = get_post_type( $post_id );
		
		if ( !in_array( $post_type, $this->src_post_types ) ) {
			return $post_id;
		}
		
		if ( $taxonomy = array_search( $post_type, $this->src_post_types ) ) {
			
			$terms = get_the_terms( $post_id, $taxonomy );
			if ( !empty( $terms ) ) {
			
				foreach( $terms as $t ) {
					if ( 0 == $t->count ) {
						wp_delete_term( $t->term_id, $taxonomy );
					}
				}
				
			}
			
		}
		
		return $post_id;
		
	}
	
	/* Modify post queries. */
	public function modify_query( $query ) {
		
		if ( !$this->have_work() ) {
			return;
		}
		
		global $wp_query;
		
		if ( $query->is_main_query() && is_tax( array_keys( $this->shared_taxonomies ) ) && !is_admin() ) {
			
			if ( $taxonomy = get_query_var( 'taxonomy' ) && isset( $this->shared_taxonomies[ $taxonomy ] ) ) {
				$query->set( 'post_type', $this->shared_taxonomies[ $taxonomy ][ 'dst_post_type' ] );
			}
			
		}
		
	}
	
	/* Get master post ID by sub post ID. */
	public function getMasterIDBySubPostID( $post_id ) {
		
		$post_type = get_post_type( $post_id );
		
		$in_array = false;
		foreach( $this->dst_post_types as $check_types ) {
			if ( in_array( $post_type, $check_types ) ) {
				$in_array = true;
				break;
			}
		}
		if ( !$in_array ) {
			return false;
		}
		
		$taxonomy = null;
		$master_post_type = null;
		foreach( $this->shared_taxonomies as $tax => &$args ) {
			if ( in_array( $post_type, $args[ 'dst_post_type' ] ) ) {
				$taxonomy = $tax;
				$master_post_type = $args[ 'src_post_type' ];
			}
		}
		
		if ( empty( $taxonomy ) || empty( $master_post_type ) ) {
			return false;
		}
		
		$term = wp_get_post_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );
		
		if ( is_wp_error( $term ) || empty( $term ) ) {
			return false;
		}
		
		$term_id = (int) $term[ 0 ];
		
		$the_query = new WP_Query( array(
			'post_type' => $master_post_type,
			'posts_per_page' => 1,
			'fields' => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $term_id,
				)
			)
		) );
		
		if ( !$the_query->have_posts() ) {
			return false;
		}
		
		if ( !empty( $the_query->posts ) ) {
			return $the_query->posts[ 0 ];
		}
		
		return false;
		
	}
	
	/* On final completion of plug-in execution. */
	public function __destruct() {
		
		
		
	}
	
}

?>