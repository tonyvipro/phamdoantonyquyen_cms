<?php
/**
 * The template for displaying single posts and pages
 */

// If it is a single post, delegate to single.php
if ( is_single() ) {
    locate_template( 'single.php', true );
    return;
}

get_header();
?>

<main id="site-content">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', get_post_type() );

        endwhile;
    endif;
    ?>

</main>

<?php
get_footer();