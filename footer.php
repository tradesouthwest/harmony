<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package:   ClassicPress
 * @subpackage Harmony
 * @since      Harmony 1.0.0
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="harmony-small-sidebar">
		<?php get_sidebar(); ?>
	</div>    
	<div class="site-info">
		<p><span class="foot-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
			rel="home"><?php bloginfo( 'name' ); ?></a></span>
		<?php
		if ( function_exists( 'the_privacy_policy_link' ) ) {
			the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
		}
		?>
		<small><a class="classicpress-credit" href="<?php echo esc_url( __( 'https://www.classicpress.net/', 'harmony' ) ); ?>" class="imprint">
		<?php
		printf( esc_attr__( 'Proudly powered by %s', 'harmony' ), 'ClassicPress' );
		?></a></small></p>
	</div><!-- .site-info -->
	<div class="harmony-btt">
		<div class="upto">
    		<button class="back_to_top" onclick="backToTop();" 
			title="<?php esc_attr_e('Top of page link', 'april'); ?>"><sup>^</sup></button>
		</div>
	</div>

</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
