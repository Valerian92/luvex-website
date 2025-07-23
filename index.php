<?php get_header(); ?>

<div class="container">
    <main class="section">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="card">
                    <header class="card__header">
                        <h1 class="card__title"><?php the_title(); ?></h1>
                    </header>
                    <div class="card__content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="text-center">
                <h2>Keine Inhalte gefunden</h2>
                <p>Es wurden keine Inhalte gefunden.</p>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>