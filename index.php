<?php get_header(); ?>

<!-- Blog Home Wrapper -->
<div class="blog-home-container" style="background: #f8f9fa; padding: 60px 0 80px;">
    <div class="container">
        <!-- Page Title & Intro -->
        <div style="text-align: center; margin-bottom: 60px;">
            <h1 style="font-size: 2.5rem; color: #1e293b; font-weight: 700; margin-bottom: 15px;">Our Blog</h1>
            <p style="font-size: 1.1rem; color: #64748b; max-width: 600px; margin: 0 auto;">Latest news, tips, and insights for your journey.</p>
        </div>

        <?php 
        // Force query for blog posts to ensure they appear
        $all_posts_query = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 12, // Show 12 posts per page
            'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        ));

        if ( $all_posts_query->have_posts() ) : ?>
            
            <!-- Posts Grid -->
            <div class="blog-list-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 40px;">
                <?php while ( $all_posts_query->have_posts() ) : $all_posts_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="grid-post-item" style="text-decoration: none; color: inherit; display: block; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        
                        <!-- Thumbnail Image -->
                        <div style="height: 220px; overflow: hidden; position: relative; background: #e2e8f0;">
                            <?php if(has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', array('style' => 'width:100%; height:100%; object-fit:cover; transition: transform 0.5s ease;')); ?>
                            <?php else: ?>
                                 <!-- Fallback Image if No Featured Image -->
                                 <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop" alt="Travel" style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s ease;">
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div style="padding: 25px;">
                            <!-- Meta -->
                            <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date('M j, Y'); ?></span>
                                <?php if(has_category()): ?>
                                    <span>&bull;</span>
                                    <span style="color: #3b66a5; font-weight: 600;"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- Title -->
                            <h3 style="font-size: 1.25rem; line-height: 1.4; margin-bottom: 10px; font-weight: 700; color: #1e293b; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php the_title(); ?></h3>
                            
                            <!-- Excerpt -->
                            <div class="grid-post-excerpt" style="font-size: 0.95rem; color: #64748b; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </div>

                            <!-- Read More Link (Cosmetic) -->
                            <div style="margin-top: 20px; font-size: 0.9rem; color: #3b66a5; font-weight: 600; display: flex; align-items: center; gap: 5px;">
                                Read Article <i class="fas fa-arrow-right" style="font-size: 0.8em; transition: transform 0.3s;"></i>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="blog-pagination" style="margin-top: 60px; text-align: center;">
                <?php 
                echo paginate_links(array(
                    'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, get_query_var('paged') ),
                    'total'     => $all_posts_query->max_num_pages,
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                    'type'      => 'list',
                    'class'     => 'pagination-list'
                )); 
                ?>
            </div>

        <?php else: ?>
            
            <!-- Empty State (No posts found) -->
            <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto;">
                <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 20px;"><i class="far fa-folder-open"></i></div>
                <h3 style="font-size: 1.5rem; color: #334155; margin-bottom: 10px;">No posts found</h3>
                <p style="color: #64748b;">It looks like there are no articles published yet. Check back soon!</p>
                <?php if (current_user_can('publish_posts')) : ?>
                    <a href="<?php echo admin_url('post-new.php'); ?>" style="display: inline-block; margin-top: 20px; padding: 10px 25px; background: #3b66a5; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">Create First Post</a>
                <?php endif; ?>
            </div>

        <?php endif; ?>
    </div>
</div>

<style>
/* Grid Hover Effects */
.grid-post-item:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important; }
.grid-post-item:hover img { transform: scale(1.05); }
.grid-post-item:hover .fa-arrow-right { transform: translateX(5px); }

/* Pagination Styling */
.blog-pagination ul { display: inline-flex; list-style: none; padding: 0; gap: 8px; }
.blog-pagination a, .blog-pagination span { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: 0.2s; background: white; color: #64748b; border: 1px solid #e2e8f0; }
.blog-pagination a:hover { border-color: #3b66a5; color: #3b66a5; }
.blog-pagination .current { background: #3b66a5; color: white; border-color: #3b66a5; cursor: default; }
</style>

<?php get_footer(); ?>
