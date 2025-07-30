<?php
/**
 * UV News Page Template
 * Main blog page for UV technology insights
 * 
 * @package Luvex
 * @since 2.0.0
 */

get_header(); ?>

<section class="uv-news-hero">
    <div class="uv-news-hero__container container--medium">
        <div class="uv-news-hero__content">
            <h1 class="uv-news-hero__title">
                UV Technology <span class="text-highlight">Insights</span>
            </h1>
            <h2 class="uv-news-hero__subtitle">
                Latest developments, research, and industry trends in UV technology
            </h2>
            <p class="uv-news-hero__description">
                Stay ahead of the curve with expert analysis, technical insights, and real-world applications from the UV technology industry.
            </p>
        </div>
    </div>
</section>

<!-- Featured Article -->
<section class="featured-article">
    <div class="container--medium">
        <?php
        // Get the most recent post
        $featured_post = get_posts(array(
            'numberposts' => 1,
            'post_status' => 'publish'
        ));
        
        if ($featured_post) :
            $post = $featured_post[0];
            setup_postdata($post);
        ?>
        <div class="featured-article__card">
            <div class="featured-article__layout">
                <div class="featured-article__image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large'); ?>
                    <?php else : ?>
                        <div class="placeholder-image">
                            <i class="fa-solid fa-lightbulb"></i>
                            <span>UV Technology</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="featured-article__content">
                    <div class="featured-article__meta">
                        <span class="featured-badge">Featured Article</span>
                        <time class="featured-date"><?php echo get_the_date('F j, Y'); ?></time>
                    </div>
                    <h3 class="featured-article__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="featured-article__excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                    </div>
                    <div class="featured-article__footer">
                        <div class="featured-author">
                            <i class="fa-solid fa-user"></i>
                            <span><?php the_author(); ?></span>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="featured-read-more">
                            Read Full Article
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>

<!-- Categories Navigation -->
<section class="uv-categories">
    <div class="container--medium">
        <h2 class="text-center mb-2">Explore by Technology</h2>
        <div class="uv-categories__grid">
            
            <!-- Water Treatment -->
            <div class="category-card">
                <div class="category-card__icon">
                    <i class="fa-solid fa-water"></i>
                </div>
                <h3 class="category-card__title">Water Treatment</h3>
                <p class="category-card__description">
                    UV disinfection systems, municipal applications, and water safety innovations.
                </p>
                <a href="<?php echo get_category_link(get_cat_ID('Water Treatment')); ?>" class="category-card__link">
                    Explore Articles
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- LED UV Technology -->
            <div class="category-card">
                <div class="category-card__icon">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <h3 class="category-card__title">LED UV Systems</h3>
                <p class="category-card__description">
                    Next-generation LED UV technology, efficiency improvements, and applications.
                </p>
                <a href="<?php echo get_category_link(get_cat_ID('LED UV')); ?>" class="category-card__link">
                    Explore Articles
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Industry Insights -->
            <div class="category-card">
                <div class="category-card__icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="category-card__title">Industry Insights</h3>
                <p class="category-card__description">
                    Market trends, regulatory updates, and strategic industry analysis.
                </p>
                <a href="<?php echo get_category_link(get_cat_ID('Industry Insights')); ?>" class="category-card__link">
                    Explore Articles
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Research Updates -->
            <div class="category-card">
                <div class="category-card__icon">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <h3 class="category-card__title">Research Updates</h3>
                <p class="category-card__description">
                    Latest research findings, peer-reviewed studies, and scientific breakthroughs.
                </p>
                <a href="<?php echo get_category_link(get_cat_ID('Research')); ?>" class="category-card__link">
                    Explore Articles
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            
        </div>
    </div>
</section>

<!-- Recent Articles -->
<section class="recent-articles">
    <div class="container--medium">
        <div class="recent-articles__header">
            <h2>Latest UV Technology Articles</h2>
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="view-all-link">
                View All Articles
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="articles-grid">
            <?php
            $recent_posts = get_posts(array(
                'numberposts' => 6,
                'offset' => 1, // Skip the featured post
                'post_status' => 'publish'
            ));
            
            foreach ($recent_posts as $post) :
                setup_postdata($post);
            ?>
            <article class="article-card">
                <div class="article-card__image">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    <?php else : ?>
                        <div class="article-placeholder">
                            <i class="fa-solid fa-atom"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="article-card__content">
                    <div class="article-card__meta">
                        <time class="article-date"><?php echo get_the_date('M j, Y'); ?></time>
                        <?php
                        $categories = get_the_category();
                        if ($categories) :
                        ?>
                        <span class="article-category"><?php echo esc_html($categories[0]->name); ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="article-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="article-card__excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </div>
                    <div class="article-card__author">
                        <i class="fa-solid fa-user"></i>
                        <span><?php the_author(); ?></span>
                    </div>
                </div>
            </article>
            <?php
            endforeach;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="uv-newsletter-cta">
    <div class="container--narrow">
        <div class="newsletter-cta__content">
            <div class="newsletter-cta__icon">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <h2 class="newsletter-cta__title">Stay Updated with UV Technology</h2>
            <p class="newsletter-cta__description">
                Get the latest UV technology insights, research updates, and industry analysis delivered to your inbox.
            </p>
            <form class="newsletter-signup" method="post" action="">
                <div class="newsletter-input-group">
                    <input type="email" name="newsletter_email" placeholder="Your email address" required>
                    <button type="submit" class="newsletter-submit">
                        Subscribe
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
                <p class="newsletter-privacy">
                    We respect your privacy. Unsubscribe at any time.
                </p>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>