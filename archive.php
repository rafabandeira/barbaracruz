<?php get_header(); ?>

<div class="row">
    <div class="col-md-8">
        <header class="mb-4">
            <h1>
                <?php
                    if ( is_category() ) single_cat_title();
                    elseif ( is_tag() ) single_tag_title();
                    elseif ( is_author() ) { the_post(); echo 'Artigos de ' . get_the_author(); rewind_posts(); }
                    elseif ( is_day() ) echo 'Arquivos de ' . get_the_date();
                    elseif ( is_month() ) echo 'Arquivos de ' . get_the_date('F Y');
                    elseif ( is_year() ) echo 'Arquivos de ' . get_the_date('Y');
                    else _e( 'Arquivos', 'barbaracruz' );
                ?>
            </h1>
        </header>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class('mb-4'); ?>>
                    <h2><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h2>
                    <p class="text-muted small"><?php echo get_the_date(); ?> | <?php the_author_posts_link(); ?></p>
                    <div><?php the_excerpt(); ?></div>
                </article>
            <?php endwhile; ?>

            <nav class="mt-4"><?php the_posts_pagination(); ?></nav>
        <?php else : ?>
            <p><?php _e( 'Nenhum conteúdo encontrado.', 'barbaracruz' ); ?></p>
        <?php endif; ?>
    </div>

    <div class="col-md-4"><?php get_sidebar(); ?></div>
</div>

<?php get_footer(); ?>