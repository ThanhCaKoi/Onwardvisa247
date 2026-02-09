<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post(); // Load content from WordPress Editor/Elementor
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <?php if ( ! is_front_page() && ! has_block( 'core/cover' ) ) : ?>
                    <!-- Show Title only if not Front Page and no Cover Block -->
                    <header class="entry-header container" style="padding-top: 40px; padding-bottom: 20px;">
                        <h1 class="entry-title" style="font-size: 2.5rem; color: #333; font-weight: 700;">
                            <?php the_title(); ?>
                        </h1>
                    </header>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    // This creates the "canvas" for Elementor or Block Editor
                    the_content();

                    // Pagination for multi-part pages
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bestonwardticket' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->
            <?php
        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
