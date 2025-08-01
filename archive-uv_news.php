<?php
/**
 * Archive Template for UV News
 * Displays all UV News articles
 * 
 * @package Luvex
 */
get_header(); ?>

<section class="luvex-hero">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV Technology <span class="text-highlight">News</span>
            </h1>
            <h2 class="luvex-hero__subtitle">
                Latest insights, research, and industry developments
            </h2>
            <p class="luvex-hero__description">
                Stay updated with the latest UV technology trends, research breakthroughs, and industry news.
            </p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container container--medium">
        
        <?php if (have_posts()) : ?>
            
            <div class="news-grid">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article class="news-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="news-card__image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="news-card__content">
                            <div class="news-card__meta">
                                <time class="news-date"><?php echo get_the_date('M j, Y'); ?></time>
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'uv_news_category');
                                if ($categories && !is_wp_error($categories)) :
                                    $category = $categories[0];
                                ?>
                                <span class="news-category"><?php echo esc_html($category->name); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="news-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            
                            <div class="news-card__excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                            </div>
                            
                            <div class="news-card__footer">
                                <div class="news-author">
                                    <i class="fa-solid fa-user"></i>
                                    <span><?php the_author(); ?></span>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="news-read-more">
                                    Read More
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="news-pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '<i class="fa-solid fa-chevron-left"></i> Previous',
                    'next_text' => 'Next <i class="fa-solid fa-chevron-right"></i>',
                ));
                ?>
            </div>
            
        <?php else : ?>
            
            <div class="no-news">
                <div class="no-news__content">
                    <i class="fa-solid fa-newspaper"></i>
                    <h3>No news articles yet</h3>
                    <p>Check back soon for UV technology updates and industry insights.</p>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
</section>

<?php get_footer(); ?>