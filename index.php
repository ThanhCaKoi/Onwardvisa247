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
        // 1. Fetch Posts from Remote REST API
        $api_url = 'http://180.93.35.12/wp-json/wp/v2/posts?_embed&per_page=12';
        $response = wp_remote_get($api_url);

        $posts_data = array();
        
        if ( !is_wp_error($response) && wp_remote_retrieve_response_code($response) == 200 ) {
            $posts_data = json_decode(wp_remote_retrieve_body($response), true);
        }

        if ( !empty($posts_data) ) : ?>
            
            <!-- Posts Grid -->
            <div class="blog-list-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 40px;">
                <?php foreach ( $posts_data as $post ) : 
                    // Extract Data
                    $title = $post['title']['rendered'];
                    $excerpt = $post['excerpt']['rendered'];
                    $link = $post['link']; // Remote Link
                    $date = date('M j, Y', strtotime($post['date']));
                    
                    // Featured Image
                    $img_url = 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop'; // Default
                    if (isset($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
                        $img_url = $post['_embedded']['wp:featuredmedia'][0]['source_url'];
                    }

                    // Category
                    $category = 'News';
                    if (isset($post['_embedded']['wp:term'][0][0]['name'])) {
                        $category = $post['_embedded']['wp:term'][0][0]['name'];
                    }
                ?>
                    <a href="<?php echo esc_url($link); ?>" target="_blank" class="grid-post-item" style="text-decoration: none; color: inherit; display: block; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        
                        <!-- Thumbnail Image -->
                        <div style="height: 220px; overflow: hidden; position: relative; background: #e2e8f0;">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(strip_tags($title)); ?>" style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s ease;">
                        </div>

                        <!-- Content -->
                        <div style="padding: 25px;">
                            <!-- Meta -->
                            <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                <span><i class="far fa-calendar-alt"></i> <?php echo $date; ?></span>
                                <span>&bull;</span>
                                <span style="color: #3b66a5; font-weight: 600;"><?php echo $category; ?></span>
                            </div>

                            <!-- Title -->
                            <h3 style="font-size: 1.25rem; line-height: 1.4; margin-bottom: 10px; font-weight: 700; color: #1e293b; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo $title; ?></h3>
                            
                            <!-- Excerpt -->
                            <div class="grid-post-excerpt" style="font-size: 0.95rem; color: #64748b; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo wp_trim_words($excerpt, 20, '...'); ?>
                            </div>

                            <!-- Read More Link (Cosmetic) -->
                            <div style="margin-top: 20px; font-size: 0.9rem; color: #3b66a5; font-weight: 600; display: flex; align-items: center; gap: 5px;">
                                Read Original Article <i class="fas fa-external-link-alt" style="font-size: 0.8em; transition: transform 0.3s;"></i>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Note: Pagination is not supported for remote API in this simple implementation -->

        <?php else: ?>
            
            <!-- Empty State / API Error -->
            <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto;">
                <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 20px;"><i class="fas fa-wifi"></i></div>
                <h3 style="font-size: 1.5rem; color: #334155; margin-bottom: 10px;">Unable to load posts</h3>
                <p style="color: #64748b;">We are currently unable to fetch the latest articles from the server. Please check your connection or try again later.</p>
                <p style="font-size: 0.8rem; color: #999; margin-top: 10px;"><?php echo (is_wp_error($response)) ? $response->get_error_message() : ''; ?></p>
            </div>

        <?php endif; ?>
    </div>
</div>

<style>
/* Grid Hover Effects */
.grid-post-item:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important; }
.grid-post-item:hover img { transform: scale(1.05); }
.grid-post-item:hover .fa-arrow-right { transform: translateX(5px); }
</style>

<?php get_footer(); ?>
