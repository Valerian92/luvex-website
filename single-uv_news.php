<?php
/**
 * Single Template for UV News Articles
 * 
 * @package Luvex
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<article class="single-news">
    
    <!-- News Hero -->
    <section class="news-hero">
        <div class="news-hero__container container--narrow">
            
            <div class="news-meta">
                <div class="news-meta__left">
                    <time class="news-date">
                        <i class="fa-solid fa-calendar"></i>
                        <?php echo get_the_date('F j, Y'); ?>
                    </time>
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'uv_news_category');
                    if ($categories && !is_wp_error($categories)) :
                        $category = $categories[0];
                    ?>
                    <span class="news-category">
                        <i class="fa-solid fa-tag"></i>
                        <?php echo esc_html($category->name); ?>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="news-meta__right">
                    <span class="news-author">
                        <i class="fa-solid fa-user"></i>
                        <?php the_author(); ?>
                    </span>
                </div>
            </div>
            
            <h1 class="news-hero__title"><?php the_title(); ?></h1>
            
            <?php if (has_excerpt()) : ?>
                <div class="news-hero__excerpt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>
            
        </div>
    </section>
    
    <!-- Featured Image -->
    <?php if (has_post_thumbnail()) : ?>
    <section class="news-featured-image">
        <div class="container--medium">
            <div class="featured-image-wrapper">
                <?php the_post_thumbnail('large'); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
    <!-- News Content -->
    <section class="news-content">
        <div class="container--narrow">
            <div class="news-content__wrapper">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    
    <!-- News Footer -->
    <section class="news-footer">
        <div class="container--narrow">
            
            <!-- Tags -->
            <?php
            $tags = get_the_terms(get_the_ID(), 'uv_news_tag');
            if ($tags && !is_wp_error($tags)) :
            ?>
            <div class="news-tags">
                <h4><i class="fa-solid fa-tags"></i> Related Topics</h4>
                <div class="tag-list">
                    <?php foreach ($tags as $tag) : ?>
                        <span class="tag"><?php echo esc_html($tag->name); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Navigation -->
            <div class="news-navigation">
                <div class="news-nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                    <div class="news-nav-prev">
                        <span class="nav-label">
                            <i class="fa-solid fa-chevron-left"></i>
                            Previous Article
                        </span>
                        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-title">
                            <?php echo get_the_title($prev_post->ID); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                    <div class="news-nav-next">
                        <span class="nav-label">
                            Next Article
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                        <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-title">
                            <?php echo get_the_title($next_post->ID); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="back-to-news">
                    <a href="/uv-news/" class="btn btn--secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to All News
                    </a>
                </div>
            </div>
            
        </div>
    </section>
    
</article>

<?php endwhile; ?>

<?php get_footer(); ?>