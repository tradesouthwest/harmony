<?php
//namespace Harmony;
/**
 * Theme Support Page in admin view
 * If you prefer a class to autoload try: https://www.wpexplorer.com/wordpress-theme-options/#admin-panel-class
 * 
 * @package:   ClassicPress
 * @subpackage harmony
 * @since      harmony 1.0.0
 */
add_action('admin_menu', 'harmony_create_theme_options_page');
add_action('admin_init', 'harmony_register_and_build_fields');

/**
 * Add theme menu
 *
 * @since 1.0.0
 * @uses add_theme_page()
 * $page_title, $menu_title, $capability, $menu_slug, $function
 */
function harmony_create_theme_options_page() {
   add_theme_page( esc_html__( 'Theme Help', 'harmony' ), 
                  esc_html__( 'Theme Help', 'harmony' ), 
                  'administrator', 
                  'harmony_theme', 
                  'harmony_options_page_fn'
                );
}

/**
 * Register our settings.
 * 
 * register_setting     $option_group, $option_name, $args = array() 
 * add_settings_section $id, $title, $callback, $page, $args = array()
 * add_settings_field   $id, $title, $callback, $page, $section, $args = array() 
 */
function harmony_register_and_build_fields() {
    register_setting('harmony_theme', 
                    'harmony_theme', 
                    array( 
                        'sanitize_callback' => 'sanitize_text_field',
                    )
                );
    add_settings_section('main_section', 
                        esc_html__( 'Main Settings', 'harmony' ), 
                        'harmony_section_info_cb', 
                        __FILE__
                    );
    add_settings_field('harmony_ad_one', 
                      esc_html__( 'Basic Info', 'harmony' ),
                      'harmony_ad_setting_one', 
                      __FILE__, 
                      'main_section'
                    );
    add_settings_field('harmony_ad_two', 
                      esc_html__( 'Customizer Link', 'harmony' ), 
                      'harmony_ad_setting_two', 
                      __FILE__, 
                      'main_section'
                    ); 
}


// @since 1.0.0 
function harmony_section_info_cb() {
    echo esc_html__( 'Produced by ', 'harmony' ) 
    . '<a href="'. esc_url("https://tradesouthwest.com/").'" title="TradeSouthWest" target="_blank">TradeSouthWest</a>.';
    echo '<figure><img src="'. esc_url( get_template_directory_uri( ) . '/includes/TSWlogo.png' ) .'" alt="TSW" height="90"/></figure>';
}

/**
 * The "My Options" page html.
 */
function harmony_options_page_fn() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        return;
    }
?>
    <div id="theme-options-wrap" class="wrap widefat">
        <div class="icon32" id="icon-tools"></div>

          <h2><?php esc_html_e( 'Harmony Theme Guide', 'harmony' ); ?></h2>
          <p><?php esc_html_e( 'General Help', 'harmony' ); ?></p>

        <form method="post" action="options.php">

          <?php settings_fields('harmony_theme'); ?>
          <?php do_settings_sections(__FILE__); ?>
        
        </form>
    <style id="harmony-options-css">
    #theme-options-wrap {
        width: 93%;
        padding: 3em;
        background: #fafeff;   
        border-top: 1px solid white;}
    #theme-options-wrap #icon-tools {
        position: relative;
        top: -10px;}	
    #theme-options-wrap input, #theme-options-wrap textarea {
        padding: .7em;}
    #theme-options-wrap em{color:#646464}</style>
</div>
<?php
}

// Ad one
function harmony_ad_setting_two() {
   echo '<a class="button secondary" href="' . esc_url( admin_url( '/' ) . 'customize.php') .'" 
        title="' . esc_attr__( 'Customize Theme Here', 'harmony' ) . '">'
        . esc_html__( 'Customize Theme Here', 'harmony' ) . '</a>';
}

// Ad two
function harmony_ad_setting_one() {
    echo '<h4>'. esc_html__( 'Theme Options Include:', 'harmony' ) . '</h4>
    <hr><pre>'. esc_attr__('
    - Alignment of Font for content
    - Choose the Font Family type.
    - Set maximum width of articles.
      ', 'harmony' ) .'</pre>';
    echo '<h4>'. esc_html__( 'Support available at: ', 'harmony' ) . '</h4>
    <hr><p>https://github.com/tradesouthwest/harmony/issues</p>';
} 
