<!DOCTYPE html> 
<html <?php language_attributes(); ?> class="no-js">

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <meta content="<?php get_the_title(); ?>" name="<?php bloginfo('description'); ?>">

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

        <header id="header" class="header d-flex align-items-center sticky-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
                <a href="/" class="logo d-flex align-items-center">
                    <img src="<?php bloginfo('template_url'); ?>/assets/img/logo-barbaracruz.png" alt="Marca da Fisioterapeuta Bárbara Cruz" class="img-fluid">
                </a>
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="/#about-2">À Propos</a></li>
                        <li><a href="/#lessoins">Mes Prestations</a></li>
                        <li><a href="/#contact">Contact</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>
        </header>

        <main class="main">



            <!-- Services Section -->
            <section id="lessoins" class="services section bg-dourado"> 
                <div class="container">
                    <div class="row">
                        <img src="<?php bloginfo('template_url'); ?>/assets/img/sol.svg" alt="Imagem estilizada de um sol, commposta por traços finos e delicados" height="200px">
                        <h1 class="fw-light text-center"><?php the_title(); ?></h1>
                    </div>
                </div>
            </section><!-- /Services Section -->

            


            <!-- Services Loop Section -->
            <section class="service-1 section bg-dourado"> 
                <div class="container">
                    <div class="row">
                        <div class="offset-md-0 offset-lg-1 col-sm-12 col-md-5 col-lg-5 col-xl-4 mb-5">
                            <div class="img-fluid sombra imagem" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>);"></div>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 offset-xl-1 mb-4">
                            <p class="content-title"><?php the_title(); ?></p>
                            <p class="content-subtitle"><?php echo get_post_meta(get_the_ID(), '_servicos_subtitle', true); ?></p>
                            <p><?php the_content(); ?></p>
                            <div class="d-flex gap-2">
                                <a href="<?php echo get_theme_mod('lessoins-link1','https://wa.me/+33659665678'); ?>" class="btn btn-get-started">Prendre rendez-vous</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
















</main>


<footer id="footer" class="footer">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-lg-7">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-center">
                        <img src="<?php bloginfo('template_url'); ?>/assets/img/logo-barbaracruz-terracota.svg" alt="marca da Fisioterapeuta Bárbara Cruz" height="150px"  style="display: block; margin: auto;">
                    </div>
                    <div class="col-lg-4 d-flex align-items-center">
                        <img src="<?php bloginfo('template_url'); ?>/assets/img/sol-terracota.svg" alt="Imagem estilizada de um sol, commposta por traços finos e delicados" height="200px" class="" style="display: block; margin: auto;">
                    </div>
                    <div class="col-sm-12 col-lg-4 d-lg-flex align-items-center text-center text-lg-start">
                        <p><i class="bi bi-geo-alt-fill"></i> Bourg la Reine</br>
                        <i class="bi bi-phone"></i> 06 59 66 56 78</br>
                        <i class="bi bi-instagram"></i> @barbaracruz.br</br>
                        <i class="bi bi-envelope"></i> contact@barbaracruz.fr</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


<!-- Preloader -->
<div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="<?php bloginfo('template_url'); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/vendor/php-email-form/validate.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/vendor/aos/aos.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

        <!-- Main JS File -->
        <script src="<?php bloginfo('template_url'); ?>/assets/js/main.js"></script>

    </body>
</html>