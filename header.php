<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <meta content="<?php bloginfo( 'description' ); ?>" name="description">

    <?php wp_head(); ?>

</head>
<body class="index-page">

<?php
// Ocultado, pois a lógica de "Quem eu sou" deve estar no menu
// $about2_title = get_option('about2_title', 'Qui suis-je');
// $about2_image = get_option('about2_image', get_template_directory_uri() . '/assets/img/barbara.avif');
// $about2_text  = get_option('about2_text', '...');
?>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo d-flex align-items-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-barbaracruz.png" alt="Marca da Fisioterapeuta Bárbara Cruz" class="img-fluid">
        </a>
        <nav id="navmenu" class="navmenu">

            <?php
            // CORREÇÃO DE MENU E PERFORMANCE:
            // O menu estático e as queries WP_Query foram removidos.
            // Substituído por wp_nav_menu() (menu registado em functions.php).
            // Vá a Aparência > Menus para criar e gerir o seu menu.
            
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false, // Não envolve o menu numa div
                'items_wrap'     => '<ul>%3$s</ul>', // %3$s = os <li> do menu
                'fallback_cb'    => false, // Não mostrar nada se o menu não existir
                'depth'          => 1 // Apenas menus de nível 1 (sem dropdowns)
            ) );
            ?>
            
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>