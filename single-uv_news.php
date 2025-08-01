<?php
/**
 * The template for displaying a single UV News post.
 *
 * @package Luvex
 */

get_header(); ?>

<main id="main" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('single-uv_news-container'); ?>>

            <!-- Article Header -->
            <header class="single-news-header">
                <?php
                $categories = get_the_terms(get_the_ID(), 'uv_news_category');
                if ($categories && !is_wp_error($categories)) {
                    $category = $categories[0];
                    echo '<a href="' . esc_url(get_term_link($category)) . '" class="category-link">' . esc_html($category->name) . '</a>';
                }
                ?>
                
                <h1 class="entry-title"><?php the_title(); ?></h1>

                <div class="entry-meta">
                    <div class="meta-item author">
                        <i class="fa-solid fa-user fa-fw"></i>
                        <span>By <?php the_author_posts_link(); ?></span>
                    </div>
                    <div class="meta-item date">
                        <i class="fa-solid fa-calendar-days fa-fw"></i>
                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
                    </div>
                    <div class="meta-item reading-time">
                        <i class="fa-solid fa-book-open fa-fw"></i>
                        <span><?php echo round(str_word_count(strip_tags(get_the_content())) / 200); ?> min read</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="single-news-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <!-- Article Content -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <!-- Article Footer -->
            <footer class="single-news-footer">
                <?php
                $tags = get_the_terms(get_the_ID(), 'uv_news_tag'); // Annahme: Tag-Taxonomie ist 'uv_news_tag'
                if ($tags && !is_wp_error($tags)) :
                ?>
                    <div class="news-tags-section">
                        <h4 class="tags-title">Related Topics:</h4>
                        <div class="tag-list">
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_term_link($tag)); ?>" class="tag-link"><?php echo esc_html($tag->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Post Navigation -->
                <nav class="post-navigation" aria-label="Post">
                    <h2 class="screen-reader-text">Post navigation</h2>
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post();
                        if ($prev_post) :
                        ?>
                            <div class="nav-previous">
                                <a href="<?php echo get_permalink($prev_post->ID); ?>" rel="prev">
                                    <span class="nav-label"><i class="fa-solid fa-arrow-left"></i> Previous Article</span>
                                    <span class="nav-title"><?php echo get_the_title($prev_post->ID); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php
                        $next_post = get_next_post();
                        if ($next_post) :
                        ?>
                            <div class="nav-next">
                                <a href="<?php echo get_permalink($next_post->ID); ?>" rel="next">
                                    <span class="nav-label">Next Article <i class="fa-solid fa-arrow-right"></i></span>
                                    <span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </nav>

            </footer>

        </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
