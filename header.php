<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <meta content="<?php get_the_title(); ?>" name="description">

        <!-- Vendor CSS Files -->
        <link href="<?php bloginfo('template_url'); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php bloginfo('template_url'); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="<?php bloginfo('template_url'); ?>/assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="<?php bloginfo('template_url'); ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="<?php bloginfo('template_url'); ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="<?php bloginfo('template_url'); ?>/assets/css/main.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Forum&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Open Graph Meta Tags -->
        <meta property="og:url" content="<?php get_permalink(); ?>">
        <meta property="og:type" content="article">
        <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>">
        <meta property="og:description" content="<?php custom_excerpt(150); ?>">
        <meta property="og:image" content="<?php echo get_the_post_thumbnail_url($post->ID); ?>"><!-- Load error, please check URL -->

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="<?php echo $_SERVER['HTTP_HOST']; ?>">
        <meta property="twitter:url" content="<?php get_permalink(); ?>">
        <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?>">
        <meta name="twitter:description" content="<?php custom_excerpt(150); ?>">
        <meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url($post->ID); ?>">

    </head>
    <body class="index-page"> 

<?php
    $about2_title = get_option('about2_title', 'Qui suis-je');
    $about2_image = get_option('about2_image', get_bloginfo('template_url') . '/assets/img/barbara.avif');
    $about2_text  = get_option('about2_text', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. <em><strong>Mes formations: </strong></em>– Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. – Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.');
?>

        <header id="header" class="header d-flex align-items-center sticky-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
                <a href="/" class="logo d-flex align-items-center">
                    <img src="<?php bloginfo('template_url'); ?>/assets/img/logo-barbaracruz.png" alt="Marca da Fisioterapeuta Bárbara Cruz" class="img-fluid">
                </a>
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <?php if ( $about2_title || $about2_image || $about2_text ) : ?><li><a href="#about-2"><?php echo $about2_title; ?></a></li><?php endif; ?>
                        <li><a href="#lessoins">Mes Prestations</a></li>
                        <li class="d-none"><a href="#">Actualités</a></li>
                        <li class="d-none"><a href="#">Prendre rendez-vous</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>
        </header>