<?php get_header(); ?>

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
                           <div class="img-fluid sombra imagem" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>); height: 400px;"></div>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 offset-xl-1 mb-4">
                            <p class="content-title"><?php the_title(); ?></p>
                            <p class="content-subtitle"><?php echo get_post_meta(get_the_ID(), '_servicos_subtitle', true); ?></p>
                            <div style="color: #F3EDE0;"><?php the_content(); ?></div>
                            <div class="d-flex gap-2">
                                <a href="<?php echo get_theme_mod('lessoins-link1','https://wa.me/+33659665678'); ?>" class="btn btn-get-started">Prendre rendez-vous</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>





</main>

<?php get_footer(); ?>