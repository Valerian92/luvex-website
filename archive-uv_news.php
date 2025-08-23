<?php
/**
 * The template for displaying the UV News archive page.
 *
 * @package Luvex
 */

get_header(); ?>

<main id="main" class="site-main">

<!-- 
==============================================================================
NEUE HERO SECTION (Split Layout)
==============================================================================
- Die Klasse wurde zu `luvex-hero--split-compact` geändert.
- Die innere Struktur nutzt nun Flexbox für eine Links/Rechts-Aufteilung.
-->
<section class="luvex-hero luvex-hero--split-compact">
    <div class="luvex-hero__container">
        <!-- Linke Seite: Textinhalte -->
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                UV Technology <span class="text-highlight">News</span>
            </h1>
            <p class="luvex-hero__description">
                The latest news and innovations in UV technology.
            </p>
        </div>
        <!-- Rechte Seite: Buttons -->
        <div class="luvex-hero__cta-container">
            <a href="#latest-articles" class="luvex-hero__cta-secondary">
                <i class="fas fa-newspaper"></i>
                <span>Latest Articles</span>
            </a>
            <a href="#newsletter" class="luvex-hero__cta">
                <i class="fas fa-envelope"></i>
                <span>Subscribe</span>
            </a>
        </div>
    </div>
</section>


<!-- Filter und Suche bleibt unverändert -->
<section class="news-filter-section">
    <div class="news-filter-container">
        <div class="news-filter-categories" role="group" aria-label="Article Categories">
            <button class="news-filter-btn active">All Topics</button>
            <button class="news-filter-btn">UV-C LEDs</button>
            <button class="news-filter-btn">Water Treatment</button>
            <button class="news-filter-btn">Air Purification</button>
            <button class="news-filter-btn">Research</button>
        </div>
        <form role="search" method="get" class="news-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="news-search-input" placeholder="Search articles..." value="<?php echo get_search_query(); ?>" name="s" />
            <input type="hidden" name="post_type" value="uv_news" />
            <i class="fa-solid fa-search news-search-icon"></i>
        </form>
    </div>
</section>
    
    <!-- Artikel-Grid -->
    <section class="news-grid-section">
        <div class="news-grid-container">

            <?php if ( have_posts() ) : ?>

                <?php
                $post_counter = 0;
                ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php if ( $post_counter === 0 && !is_paged() ) : ?>
                        
                        <div class="featured-article-wrapper">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('news-card featured-article'); ?>>
                                <div class="news-card__image-container">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large', ['class' => 'news-card__image']); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="https://placehold.co/800x600/1B2A49/6dd5ed?text=UV-C+LED" alt="Placeholder Image" class="news-card__image">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="news-card__content">
                                    <span class="news-card__featured-tag">Featured Article</span>
                                    <h2 class="news-card__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="news-card__excerpt line-clamp-3">
                                        <?php echo wp_trim_words( get_the_excerpt(), 30 ); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="news-card__read-more">
                                        Read Full Story <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                        
                        <div class="news-grid">

                    <?php else : ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('news-card standard-article'); ?>>
                            <div class="news-card__image-container">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large', ['class' => 'news-card__image']); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="https://placehold.co/600x400/1B2A49/6dd5ed?text=LUVEX+News" alt="Placeholder Image" class="news-card__image">
                                    </a>
                                <?php endif; ?>
                                
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'uv_news_category');
                                if ($categories && !is_wp_error($categories)) :
                                    $category = $categories[0];
                                ?>
                                    <div class="news-card__category-tag"><?php echo esc_html($category->name); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="news-card__content">
                                <h3 class="news-card__title line-clamp-2">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="news-card__excerpt line-clamp-3">
                                    <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                                </div>
                                <div class="news-card__meta">
                                    <span>By <?php the_author(); ?></span>
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
                                </div>
                            </div>
                        </article>

                    <?php endif; ?>
                    
                    <?php $post_counter++; ?>

                <?php endwhile; ?>
                
                <?php if ( $post_counter > 0 ) : ?>
                    </div>
                <?php endif; ?>


                <!-- Pagination -->
                <div class="news-pagination">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                        'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <p>No news articles found.</p>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
