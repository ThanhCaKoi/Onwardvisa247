<?php get_header(); ?>

<!-- Single Post Container with Glass Effect -->
<div class="container" style="padding: 120px 20px 80px; max-width: 1000px; margin: 0 auto;">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-card'); ?> style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 50px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.5);">
            
            <!-- Post Meta (Date, Author, Category) -->
            <div class="post-meta" style="margin-bottom: 20px; color: #64748b; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                <span><i class="far fa-calendar-alt" style="color: #3b66a5; margin-right: 5px;"></i> <?php echo get_the_date('F j, Y'); ?></span>
                <span><i class="far fa-user" style="color: #3b66a5; margin-right: 5px;"></i> <?php the_author(); ?></span>
                <span><i class="far fa-folder-open" style="color: #3b66a5; margin-right: 5px;"></i> <?php the_category(', '); ?></span>
            </div>

            <!-- Title -->
            <header class="entry-header" style="margin-bottom: 30px;">
                <h1 class="entry-title" style="font-size: 2.8rem; color: #1e293b; font-weight: 800; line-height: 1.2; letter-spacing: -0.5px;"><?php the_title(); ?></h1>
            </header>

            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail" style="margin-bottom: 40px; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 4px solid #fff;">
                    <?php the_post_thumbnail('full', array('style' => 'width: 100%; height: auto; display: block; transition: transform 0.3s;')); ?>
                </div>
            <?php endif; ?>

            <!-- Main Content -->
            <div class="entry-content" style="font-size: 1.15rem; line-height: 1.8; color: #334155;">
                <style>
                    .entry-content p { margin-bottom: 1.5em; }
                    .entry-content h2 { font-size: 1.8rem; margin-top: 40px; margin-bottom: 20px; color: #1e293b; font-weight: 700; }
                    .entry-content h3 { font-size: 1.5rem; margin-top: 30px; margin-bottom: 15px; color: #334155; font-weight: 700; }
                    .entry-content ul, .entry-content ol { margin-bottom: 1.5em; padding-left: 20px; }
                    .entry-content li { margin-bottom: 10px; }
                    .entry-content blockquote { border-left: 4px solid #3b66a5; padding-left: 20px; font-style: italic; color: #555; background: #f1f8ff; padding: 20px; border-radius: 0 12px 12px 0; margin-bottom: 1.5em; }
                    .entry-content img { max-width: 100%; height: auto; border-radius: 8px; }
                </style>
                <?php the_content(); ?>
            </div>

            <!-- Footer / Back Button -->
            <div class="post-footer" style="margin-top: 60px; padding-top: 30px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <a href="<?php echo home_url(); ?>" class="btn-back" style="text-decoration: none; color: #fff; background: #3b66a5; padding: 12px 25px; border-radius: 50px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: background 0.2s;">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
                
                <!-- Share (Cosmetic) -->
                <div class="share-links" style="color: #64748b;">
                    <span style="margin-right: 10px; font-weight: 600;">Share:</span>
                    <a href="#" style="color: #3b5998; margin-right: 10px; font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #1da1f2; margin-right: 10px; font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #0077b5; font-size: 1.2rem;"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </article>
    <?php endwhile; else: ?>
        <p><?php _e('Sorry, no content matched your criteria.'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
