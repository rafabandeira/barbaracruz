<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php get_the_title(); ?>" name="description">

    <?php wp_head(); ?>

</head>
<body class="index-page">

<?php
// Obtém os dados da seção "Quem eu sou"
$about2_title = get_option('about2_title', 'Qui suis-je');
$about2_image = get_option('about2_image', get_template_directory_uri() . '/assets/img/barbara.avif');
$about2_text  = get_option('about2_text', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. <em><strong>Mes formations: </strong></em>– Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. – Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');
?>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo d-flex align-items-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-barbaracruz.png" alt="Marca da Fisioterapeuta Bárbara Cruz" class="img-fluid">
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <?php 
                // Verifica se há posts para a seção "Quem eu sou"
                if ( !empty($about2_title) || !empty($about2_image) || !empty($about2_text) ) : ?>
                    <li><a href="#about-2"><?php echo esc_html($about2_title); ?></a></li>
                <?php endif; ?>

                <?php
                // Verifica se há posts do tipo "servicos"
                $servicos_query = new WP_Query([
                    'post_type'      => 'servicos',
                    'posts_per_page' => 1
                ]); 
                if ( $servicos_query->have_posts() ) : ?>
                <li><a href="#lessoins">Mes Prestations</a></li>
                <?php endif; ?>
                
                <?php
                // Verifica se há posts do tipo "post" (blog)
                $posts_query = new WP_Query([ 'posts_per_page' => 1 ]); 
                if ( $posts_query->have_posts() ) : ?>
                <li><a href="#blog">Blog</a></li>
                <?php endif; ?>

                <li><a href="#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>