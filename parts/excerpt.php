<?php
/**
 * The template part for displaying content
 *
 * @package    ClassicPress
 * @subpackage Themename
 * @since      Themename 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="excerpt-wrapper">
        
        <header class="content-title">
            <div class="mayhave-thumbnail">

                <?php 
                the_title(
                    sprintf( '<h2 class="article-title h4"><a href="%s" rel="bookmark">', 
                    esc_attr( esc_url( get_permalink() ) ) 
                    ),
                    '</a></h2>'
                ); ?>
                <?php 
                do_action( 'harmony_thumbnail' ); ?>

            </div>
        </header>
            <div class="entry-content">
                
                <?php 
                the_excerpt(); 
                ?>

            </div><!-- .entry-content -->
                <div class="after-entry">
                    <div class="harmony-heading-meta">
                        <p class="excerpt-meta"><small><strong class="by"><?php esc_html_e('By: ', 'harmony'); ?></strong> <em class="author"><?php the_author(); ?></em>
                        <span class="cat-as"> | <?php esc_html_e('Categorized as: ', 'harmony'); ?> <em><?php the_category( ' &bull; ' ); ?></em></span>
                        <span class="key-as"> | <?php esc_html_e('Keys: ', 'harmony'); ?><em> <?php the_tags( ' ' ); ?></em></span>
                        <span class="date-as"> | <?php esc_html_e('Added on: ', 'harmony'); ?> <em><?php the_date(); ?></em></span>
                        </small></p>
                    </div>    
                </div>
    </div>
</article><!-- #post-## -->
