<?php

get_header(); ?>

<section class="single-column">

    <main id="main" class="main main-content">
        
        <?php 
        if ( have_posts() ) 
        { ?>
            <?php 
            if ( is_category() ) {
                $title = single_cat_title( '', false );
            } elseif ( is_tag() ) {
                $title = single_tag_title( '', false );
            } elseif ( is_author() ) {
                $title = '<span class="vcard">' . get_the_author() . '</span>';
            } elseif ( is_post_type_archive() ) {
                $title = post_type_archive_title( '', false );
            } elseif ( is_tax() ) {
                $title = single_term_title( '', false );
            } else {
                $title = '';
            }
                echo esc_html( $title );   
            ?>
            <?php
            // Start the loop.
            while ( have_posts() ) :
                the_post(); 

                    get_template_part( 'parts/excerpt' );
            ?>
            <?php 
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