<?php
/**
 * Harmony Customizer functionality
 *
 * @package:   ClassicPress
 * @subpackage Harmony/includes
 * @since      Harmony 1.0.0
 */
//namespace Harmony;

/**
 * Page options settings
 */

// A1
add_action( 'wp_enqueue_scripts', 'harmony_theme_customizer_css', 15 );  
// A2
add_action( 'customize_register', 'harmony_register_theme_customizer_setup' );


/** A1
 * CUSTOM FONT OUTPUT, CSS
 * The @font-face rule should be added to the stylesheet before any styles. (priority 2)
 * @uses background-image as linear gradient meerly remove any input background image.
 * @since 1.0.0
*/
function harmony_theme_customizer_css($args) {
    
    if( get_theme_mods() ) : 

		$fntfamily = 'sans-serif';
		$fntalign  = 'justify';
		$maxw      = '980';	
		$brndclr   = '#efefef';
		$excclrd   = '#e9e9e9';
		$thumb     = 'center';

	$fntfamily = ( empty( get_theme_mod( 'harmony_fontfamily' ) ) ) 
				 ? esc_attr( $fntfamily )  
			     : wp_strip_all_tags( get_theme_mod( 'harmony_fontfamily' ) );
	$fntalign  = ( empty( get_theme_mod( 'harmony_fontalign' ) ) ) 
				 ? esc_attr( $fntalign )  
			     : wp_strip_all_tags( get_theme_mod( 'harmony_fontalign' ) );
	$thumb     = ( empty( get_theme_mod( 'harmony_thumbnail' ) ) ) 
				 ? esc_attr( $thmb ) 
                 : get_theme_mod( 'harmony_thumbnail' );   
	$maxw      = ( empty( get_theme_mod( 'harmony_maxwidth' ) ) ) 
				 ? esc_attr( $maxw )
                 : get_theme_mod( 'harmony_maxwidth' );
	$brclr     = ( empty( get_theme_mod( 'harmony_brandcolor' ) ) ) 
				 ? esc_attr( $brndclr )
                 : get_theme_mod( 'harmony_brandcolor' );
	$excclr    = ( empty( get_theme_mod( 'harmony_shadowclr' ) ) ) 
				 ? esc_attr( $excclrd )
                 : get_theme_mod( 'harmony_shadowclr' );

	/* use above set of values into inline styles */
	$cssstyles = 'body, button, input, select, textarea, p{ 
		font-family: '. esc_attr( $fntfamily ) .';}
		.page .single-column p, .single single-column p{ 
			text-align: ' . esc_attr( $fntalign ) . ';}
		.site-branding, .harmony-small-sidebar, #nav a, .post-navigation a, .harmony-btt button {
			background: ' . esc_attr( $brclr ) .'; box-shadow: 0 0 0 1px ' . esc_attr( $excclr ) . ';}
		.harmony-has-thumbnail { 
			justify-content: ' . esc_attr( $thumb ) . ';}
		@media screen and ( min-width: 768px ) { 
			.blog .single-column, .page .single-column, .single single-column{max-width: '. esc_attr( $maxw ) .'px;margin: 0 auto;}}';
	
		/* Add as inline styles to head */
		wp_register_style( 'harmony-inline-customizer', true );
		wp_enqueue_style( 'harmony-inline-customizer' );
		wp_add_inline_style( 'harmony-inline-customizer', $cssstyles );

	endif;
	
		return false;
}

/**
 * Add section to the Options menu.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @since 1.0.0
*/

function harmony_register_theme_customizer_setup($wp_customize)
{
	$transport = ( $wp_customize->selective_refresh ? 'postMessage' : 'refresh' );
    // Theme font choice section
    $wp_customize->add_section( 'harmony_general', array(
        'title'       => __( 'Harmony Theme Settings', 'harmony' ),
        'capability'  => 'edit_theme_options',
		'priority'    => 20
    ) );

	//-----------------Settings and Controls -----------

	// Add setting & control for font type
	$wp_customize->add_setting( 
        'harmony_fontfamily', array(
		'type'              => 'theme_mod',
		'default'           => 'sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( 'harmony_fontfamily', array(
		'label'   => esc_html__( 'Font for Content', 'harmony'),
		'section'  => 'harmony_general',
		'settings'  => 'harmony_fontfamily',
		'description' => esc_html__( 'Choose the font family type.', 'harmony'),
		'type'        => 'select',
    	'choices'     => array(
			'inherit'    => esc_attr__( 'Select font', 'harmony' ),
        	'sans-serif' => esc_attr__( 'Sans Serif', 'harmony'),
			'serif'      => esc_attr__( 'Serif', 'harmony'),
			'Helvetica'  => esc_attr__( 'Helvetica', 'harmony'),
			'Arial'      => esc_attr__( 'Arial', 'harmony'),
			'monospace'  => esc_attr__( 'Monospace', 'harmony'),
        	)
	));

	$wp_customize->add_setting( 
        'harmony_fontalign', array(
		'type'              => 'theme_mod',
		'default'           => 'justify',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( 'harmony_fontalign', array(
		'label'   => esc_html__( 'Font Alignment', 'harmony'),
		'section'  => 'harmony_general',
		'settings'  => 'harmony_fontalign',
		'description' => esc_html__( 'Set how you want the paragraphs to display.', 'harmony'),
		'type'        => 'select',
    	'choices'     => array(
			'justify'  => esc_attr__( 'Justify', 'harmony' ),
        	'left'     => esc_attr__( 'Left', 'harmony'),
			'center'   => esc_attr__( 'Centered', 'harmony'),
			'right'    => esc_attr__( 'Right', 'harmony'),
			'inherit ' => esc_attr__( 'None', 'harmony')
			)
	));

	// position of thumbnail in excerpts
	$wp_customize->add_setting( 
        'harmony_thumbnail', array(
		'type'              => 'theme_mod',
		'default'           => 'center',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( 'harmony_thumbnail', array(
		'label'       => esc_html__( 'Position of Thumbnail', 'harmony'),
		'section'     => 'harmony_general',
		'settings'    => 'harmony_thumbnail',
		'description' => esc_html__( 'Set where you want the excerpt thumbnail to display.', 'harmony'),
		'type'        => 'select',
    	'choices'     => array(
        	'flex-start' => esc_attr__( 'Left', 'harmony'),
			'center'     => esc_attr__( 'Centered', 'harmony'),
			'flex-end'   => esc_attr__( 'Right', 'harmony'),
			'inherit'    => esc_attr__( 'None', 'harmony')
			)
	));

	$wp_customize->add_setting( 
		'harmony_maxwidth', array(
		'type'            => 'theme_mod',
		'default'          => '1200',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'          => 'refresh'
	));
	$wp_customize->add_control( 'harmony_maxwidth', array(
		'label'   => esc_html__( 'Maximum Width of Content', 'harmony'),
		'section'  => 'harmony_general',
		'settings'  => 'harmony_maxwidth',
		'description' => esc_html__( 'Sets the width of the aricles for pages and posts. (in pixels)', 'harmony'),
		'type'         => 'number'
	));
	
	/* Background */
	$wp_customize->add_setting(
		'harmony_brandcolor', array(
		'type'              => 'theme_mod',
		'default'           => '#fafafa',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'harmony_brandcolor',
		array('label'  => __( 'Background of Site Branding', 'harmony' ),
			'section'  => 'colors',
			'settings' => 'harmony_brandcolor'
		) ) 
	);
	/* Boxshadow color */
	$wp_customize->add_setting(
		'harmony_shadowclr', array(
		'type'              => 'theme_mod',
		'default'           => '#e9e9e9',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'harmony_shadowclr',
		array('label'  => __( 'BoxShadow Color', 'harmony' ),
			'section'  => 'colors',
			'settings' => 'harmony_shadowclr'
		) ) 
	);

}
