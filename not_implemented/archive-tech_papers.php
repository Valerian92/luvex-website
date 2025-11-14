<?php
/**
 * The template for displaying the Technical Papers archive page.
 *
 * @package Luvex
 */

get_header(); ?>

<main id="main" class="site-main">

    <!-- Hero Section -->
    <section class="news-hero-section">
        <div class="news-hero-content">
            <h1 class="title">Technical Papers</h1>
            <p class="subtitle">In-depth technical documentation and research findings in ultraviolet technology applications.</p>
        </div>
    </section>

    <!-- Filter und Suche -->
    <section class="news-filter-section">
        <div class="news-filter-container">
            <!-- Kategorie-Filter -->
            <div class="news-filter-categories" role="group" aria-label="Technical Paper Categories">
                <button class="news-filter-btn active">All Technologies</button>
                <button class="news-filter-btn">UV-C LEDs</button>
                <button class="news-filter-btn">UV-A Curing</button>
                <button class="news-filter-btn">Mercury UV</button>
                <button class="news-filter-btn">System Design</button>
            </div>
            
            <!-- Suchleiste -->
            <form role="search" method="get" class="news-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" class="news-search-input" placeholder="Search technical papers..." value="<?php echo get_search_query(); ?>" name="s" />
                <input type="hidden" name="post_type" value="tech_papers" />
                <i class="fa-solid fa-search news-search-icon"></i>
            </form>
        </div>
    </section>

    <!-- Technical Papers Grid -->
    <section class="news-grid-section">
        <div class="news-grid-container">

            <?php if ( have_posts() ) : ?>

                <?php
                $post_counter = 0;
                ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php if ( $post_counter === 0 && !is_paged() ) : ?>
                        
                        <!-- Featured Technical Paper -->
                        <div class="featured-article-wrapper">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('news-card featured-article'); ?>>
                                <div class="news-card__image-container">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large', ['class' => 'news-card__image']); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="https://placehold.co/800x600/1B2A49/6dd5ed?text=Technical+Paper" alt="Placeholder Image" class="news-card__image">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="news-card__content">
                                    <span class="news-card__featured-tag">Featured Technical Paper</span>
                                    <h2 class="news-card__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="news-card__excerpt line-clamp-3">
                                        <?php echo wp_trim_words( get_the_excerpt(), 30 ); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="news-card__read-more">
                                        Read Technical Paper <i class="fa-solid fa-arrow-right"></i>
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
                                        <img src="https://placehold.co/600x400/1B2A49/6dd5ed?text=LUVEX+Tech+Paper" alt="Placeholder Image" class="news-card__image">
                                    </a>
                                <?php endif; ?>
                                
                                <?php
                                $technologies = get_the_terms(get_the_ID(), 'uv_technologies');
                                if ($technologies && !is_wp_error($technologies)) :
                                    $technology = $technologies[0];
                                ?>
                                    <div class="news-card__category-tag"><?php echo esc_html($technology->name); ?></div>
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
                <p>No technical papers found.</p>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>