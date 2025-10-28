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
        
        <?php
        // CORREÇÃO: Substituído logo estático (hardcoded) pela função 'custom_logo'
        // O logo agora é gerenciável em Aparência > Personalizar > Identidade do Site
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo_url = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        $logo_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
        
        // Fallback para o alt text
        if ( empty($logo_alt) ) {
            $logo_alt = get_bloginfo( 'name' );
        }

        // Define a imagem do logo (customizável ou fallback)
        if ( has_custom_logo() && $logo_url ) {
            $logo_src = esc_url( $logo_url[0] );
            $alt_text = esc_attr( $logo_alt );
        } else {
            // Fallback para o logo original
            $logo_src = get_template_directory_uri() . '/assets/img/logo-barbaracruz.png';
            $alt_text = esc_attr( 'Marca da Fisioterapeuta Bárbara Cruz' ); // Manter o alt original
        }
        ?>
        
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo d-flex align-items-center">
            <img src="<?php echo $logo_src; ?>" alt="<?php echo $alt_text; ?>" class="img-fluid">
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