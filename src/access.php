<?php
/* ACCESSIBILITY STUFF */
global $docandtee_theme_style, $docandtee_text_size, $docandtee_text_only;
$docandtee_theme_style = 'standard';

function accessible_scripts_init() {
	/* Do what's necessary to make the accessibility links work. */
	global $docandtee_theme_style, $docandtee_text_size, $docandtee_text_only;

	$docandtee_theme_style = ( !empty( $_COOKIE['theme-style'] ) ) ? $_COOKIE['theme-style'] : 'standard';
	$docandtee_text_size = ( !empty( $_COOKIE['theme-text-size'] ) ) ? $_COOKIE['theme-text-size'] : 'standard';
	$docandtee_text_only = ( !empty( $_COOKIE['theme-text-only'] ) ) ? $_COOKIE['theme-text-only'] : false;
	$cookie_time = 1209600;

	/* Update the options when user makes a selection. */
	if ( !empty( $_GET[ 'style' ] ) ) {
		switch( addslashes( $_GET[ 'style' ] ) ) {
			case 'blackandwhite':
				$docandtee_theme_style = 'blackandwhite';
				break;
			case 'highcontrast':
				$docandtee_theme_style = 'highcontrast';
				break;
			default:
				$docandtee_theme_style = 'standard';
				break;
		}
		setcookie( 'theme-style', $docandtee_theme_style, time() + $cookie_time, COOKIEPATH, COOKIE_DOMAIN );
	}

	if ( !empty( $_GET[ 'size' ] ) ) {
		switch( addslashes( $_GET[ 'size' ] ) ) {
			case 'medium':
				$docandtee_text_size = 'medium';
				break;
			case 'large':
				$docandtee_text_size = 'large';
				break;
			case 'xl':
				$docandtee_text_size = 'xl';
				break;
			default:
				$docandtee_text_size = 'standard';
				break;
		}
		setcookie( 'theme-text-size', $docandtee_text_size, time() + $cookie_time, COOKIEPATH, COOKIE_DOMAIN );
	}

	if ( !empty( $_GET[ 'text-only' ] ) ) {
		$docandtee_text_only = ( 'yes' == addslashes( $_GET[ 'text-only' ] ) )? 'yes' : 'no';
		setcookie( 'theme-text-only', $docandtee_text_only, time() + $cookie_time, COOKIEPATH, COOKIE_DOMAIN );
	}

}

add_action( 'init', 'accessible_scripts_init' );


/*function docandtee_accessibility_body_class( $classes = '' ) {
	global $docandtee_theme_style, $docandtee_text_size, $docandtee_text_only;

	$classes[] = 'theme-style-' . $docandtee_theme_style;
	$classes[] = 'theme-text-size-' . $docandtee_text_size;

	if ( $docandtee_text_only ) {
		$classes[] = 'theme-text-only';
	}

	return $classes;
}
add_filter( 'body_class', 'docandtee_accessibility_body_class' );*/


function docandtee_is_text_only() {
	global $docandtee_text_only;
	return ( $docandtee_text_only );
}
?>