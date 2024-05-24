<?php 
/**
 * Support for logo upload, output. 
 *
 * @since 1.0.1 
 */

 add_action( 'harmony_theme_logo', 'harmony_theme_custom_logo' );
	function harmony_theme_custom_logo() 
	{
		$output = '';

		if ( function_exists( 'the_custom_logo' ) ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo           = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );

			if ( has_custom_logo() ) {
				$output = '<div class="header-logo">
				<img src="'. esc_url( $logo[0] ) .'" alt="'. get_bloginfo( 'name' ) .'" 
				class="harmony-attachment-logo"/>
				</div>'; 
			} else { 
				$output = 'brand'; 
			}
		}
			// Output sanitized in header to assure all html displays.
			return $output;
	}