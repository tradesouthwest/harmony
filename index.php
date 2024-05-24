<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package:   ClassicPress
 * @subpackage Harmony
 * @since      Harmony 1.0.0
 */

get_header(); ?>

<section class="single-column">

		<main id="main" class="main main-content">
		
			<?php if ( have_posts() ) 
			{ ?>
				<?php
				// Start the loop.
				while ( have_posts() ) :
					the_post();
					
					if ( is_home() ) {

						get_template_part( 'parts/excerpt' );
						
					} else {
						
						get_template_part( 'parts/content' );
						
					}

				// End the loop.
				endwhile;
				?>

				<div id="postPagination" class="post-navigation">
					<?php
					// Previous/next page navigation.
					the_posts_pagination( ); 
					?>
				</div>

			<?php 
			} else { 
				
					get_template_part( 'parts/nocontent' );
			} ?>

		</main>

</section>

<?php get_footer(); ?>