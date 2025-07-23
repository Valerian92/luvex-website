<?php get_header(); ?>

<div class="container">
    <main class="section">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="card">
                <h1 class="card__title"><?php the_title(); ?></h1>
                <div class="card__content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; else : ?>
            <div class="text-center">
                <h2>Keine Inhalte gefunden</h2>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>