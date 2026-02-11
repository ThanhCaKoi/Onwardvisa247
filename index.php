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
        // --- 0. HERO SLIDER SECTION ---
        
        // Query for Slider specific posts (e.g., sticky posts or just latest 3)
        $slider_args = array(
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'ignore_sticky_posts' => 1
        );
        $slider_query = new WP_Query($slider_args);
        
        if ($slider_query->have_posts()) : 
        ?>
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        
        <div class="blog-hero-slider-wrapper" style="margin-bottom: 60px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            <div class="swiper blogHeroSwiper">
                <div class="swiper-wrapper">
                    <?php while ($slider_query->have_posts()) : $slider_query->the_post(); 
                        $s_img = 'https://images.unsplash.com/photo-1436491865332-7a615321cea7?q=80&w=2074&auto=format&fit=crop';
                        if (has_post_thumbnail()) {
                            $s_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        }
                    ?>
                    <div class="swiper-slide" style="position: relative; height: 500px; display: flex; align-items: center; justify-content: center; background-size: cover; background-position: center; background-image: url('<?php echo esc_url($s_img); ?>');">
                        
                        <!-- Overlay -->
                        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(59, 102, 165, 0.6) 100%);"></div>
                        
                        <!-- Content -->
                        <div class="slide-content" style="position: relative; z-index: 10; text-align: center; color: #fff; max-width: 800px; padding: 20px;">
                            <h2 style="font-size: 3rem; font-weight: 800; margin-bottom: 20px; line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.3);"><?php the_title(); ?></h2>
                            
                            <div style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 30px; opacity: 0.9; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo get_the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" style="display: inline-block; padding: 12px 30px; border: 2px solid #fff; color: #fff; text-decoration: none; border-radius: 50px; font-weight: 600; transition: all 0.3s ease; background: rgba(255,255,255,0.1); backdrop-filter: blur(5px);">
                                Read more
                            </a>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
                
                <!-- Navigation (Optional, added for better UX) -->
                <div class="swiper-button-next" style="color: rgba(255,255,255,0.7);"></div>
                <div class="swiper-button-prev" style="color: rgba(255,255,255,0.7);"></div>
            </div>
        </div>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var swiper = new Swiper(".blogHeroSwiper", {
                    spaceBetween: 30,
                    effect: "fade",
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            });
        </script>
        
        <style>
             /* Custom Dots Color */
            .swiper-pagination-bullet { background: #fff; opacity: 0.5; width: 10px; height: 10px; }
            .swiper-pagination-bullet-active { opacity: 1; background: #fff; transform: scale(1.2); }
            
            /* Button Hover */
            .slide-content a:hover {
                background: #fff;
                color: #3b66a5 !important;
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            }
        </style>
        <?php endif; ?>

        <?php 
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
        
        $args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
            'paged'          => $paged
        );

        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) : ?>
            
            <div class="blog-list-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 40px;">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $title = get_the_title();
                    $excerpt = get_the_excerpt();
                    $link = get_permalink();
                    $date = get_the_date('M j, Y');
                    
                    $img_url = 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop'; // Default
                    if ( has_post_thumbnail() ) {
                        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    }

                    $categories = get_the_category();
                    $category = !empty($categories) ? $categories[0]->name : 'News';
                ?>
                    <a href="<?php echo esc_url($link); ?>" class="grid-post-item" style="text-decoration: none; color: inherit; display: block; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        
                        <div style="height: 220px; overflow: hidden; position: relative; background: #e2e8f0;">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(strip_tags($title)); ?>" style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s ease;">
                        </div>

                        <div style="padding: 25px;">
                            <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                <span><i class="far fa-calendar-alt"></i> <?php echo $date; ?></span>
                                <span>&bull;</span>
                                <span style="color: #3b66a5; font-weight: 600;"><?php echo $category; ?></span>
                            </div>

                            <h3 style="font-size: 1.25rem; line-height: 1.4; margin-bottom: 10px; font-weight: 700; color: #1e293b; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo $title; ?></h3>
                            
                            <div class="grid-post-excerpt" style="font-size: 0.95rem; color: #64748b; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo wp_trim_words($excerpt, 20, '...'); ?>
                            </div>

                            <div style="margin-top: 20px; font-size: 0.9rem; color: #3b66a5; font-weight: 600; display: flex; align-items: center; gap: 5px;">
                                Read Article <i class="fas fa-arrow-right" style="font-size: 0.8em; transition: transform 0.3s;"></i>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <div style="margin-top: 60px; text-align: center;">
                <?php
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $the_query->max_num_pages,
                    'current'      => max( 1, $paged ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'plain',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_next'    => true,
                    'prev_text'    => '<i class="fas fa-chevron-left"></i>',
                    'next_text'    => '<i class="fas fa-chevron-right"></i>',
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );
                ?>
            </div>
            
            <?php wp_reset_postdata(); ?>

        <?php else: ?>
            
            <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto;">
                <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 20px;"><i class="far fa-folder-open"></i></div>
                <h3 style="font-size: 1.5rem; color: #334155; margin-bottom: 10px;">No posts found</h3>
                <p style="color: #64748b;">There are no articles to display at the moment. Please check back later.</p>
                <p style="font-size: 0.8rem; color: #999; margin-top: 10px;">Query Status: Empty Result Set</p>
            </div>

        <?php endif; ?>
    </div>
</div>

<style>
.grid-post-item:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important; }
.grid-post-item:hover img { transform: scale(1.05); }
.grid-post-item:hover .fa-arrow-right { transform: translateX(5px); }
</style>

<?php get_footer(); ?>
