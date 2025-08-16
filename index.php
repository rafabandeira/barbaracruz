<?php get_header(); ?> 


        <main class="main">



            <!-- About Section -->
            <section id="about" class="about section" alt="Imagem de mulher plena, contemplando um lindo campo" style="background-image: url(<?php echo get_theme_mod('hero_image', ''.get_bloginfo('template_url').'/assets/img/hero.avif'); ?>);">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-8 mx-auto text-center">
                            <img src="<?php bloginfo('template_url'); ?>/assets/img/sol.svg" alt="Imagem estilizada de um sol, commposta por traços finos e delicados" height="200px">
                            <h1 class="mb-4 fw-light" data-aos="fade-up"><?php echo get_theme_mod('hero_title','<span>B</span>arbara <span>C</span>ruz' ); ?></h1>
                            <p data-aos="fade-up"><?php echo get_theme_mod('hero_text','Bien-être au naturel' ); ?></p>
                            <div class="linha-vertical"></div>
                        </div>
                    </div>
                </div>
            </section><!-- /About Section -->

            

            <!-- About 2 Section -->
            <section id="about-2" class="about-2 section light-background">
                <div class="container">
                    <div class="linha-vertical"></div>
                    <div class="content">
                        <div class="row">
                            <h1 class="fw-light content-title text-center"><?php echo get_theme_mod('quisuisje-titulo','<span>Q</span>ui suis-je' ); ?></h1>
                        </div>
                        <div class="row justify-content-center pt-5">

                            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 order-lg-2 offset-xl-1 mb-4">
                                <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
                                    <div class="sombra">
                                        <?php 
                                            $image_url = get_theme_mod('quisuisje-imagem', ''.get_bloginfo('template_url').'/assets/img/barbara.avif');
                                            if ($image_url) {
                                                echo '<img src="' . $image_url . '" class="img-fluid" alt="Imagem da Fisioterapeuta Bárbara Cruz">';
                                            } else { } 
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-4" data-aos="fade-up">
                                <div class="px-3">
                                    <?php echo get_theme_mod('quisuisje-texto','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</br><em>Mes formations:</em>– Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. <br>– Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.' ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /About 2 Section -->


            <!-- Services Section -->
            <section id="lessoins" class="services section bg-dourado"> 
                <div class="container">
                    <div class="row">
                        <img src="<?php bloginfo('template_url'); ?>/assets/img/sol.svg" alt="Imagem estilizada de um sol, commposta por traços finos e delicados" height="200px">
                        <h1 class="fw-light text-center"><?php echo get_theme_mod('lessoins-title','<span>M</span>es <span>P</span>restations' ); ?></h1>
                    </div>
                </div>
            </section><!-- /Services Section -->

            <!-- Services Loop Section -->
            <?php 
                // args
                $my_args_servicos = array( 
                    'post_type' => 'servicos', 
                    'order' => 'ASC', 
                    'posts_per_page' => -1,
                    'meta_key' => '_servicos_ordem',
                    'orderby' => 'meta_value_num',
                );
                // query
                $my_query_servicos = new WP_Query ( $my_args_servicos );
                
                if( $my_query_servicos->have_posts() ) : 
                while( $my_query_servicos->have_posts() ) : $my_query_servicos->the_post(); 
                    $cor = get_post_meta(get_the_ID(), '_servicos_cor', true);
                    if (!$cor) { $cor = 'bg-dourado'; }
            ?>
            <section class="service-1 section <?php echo esc_attr($cor); ?>"> 
                <div class="container">
                    <div class="row">
                        <div class="offset-md-0 offset-lg-1 col-sm-12 col-md-5 col-lg-5 col-xl-4 mb-5">
                            <div class="img-fluid sombra imagem" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>);"></div>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 offset-xl-1 mb-4">
                            <p class="content-title"><?php the_title(); ?></p>
                            <p class="content-subtitle"><?php echo get_post_meta(get_the_ID(), '_servicos_subtitle', true); ?></p>
                            <p><?php the_excerpt(); ?></p>
                            <div class="d-flex gap-2">
                                <a href="<?php the_permalink(); ?>" class="btn btn-get-started">En savoir plus</a>
                                <a href="<?php echo get_theme_mod('lessoins-link1','https://wa.me/+33659665678'); ?>" class="btn btn-get-started">Prendre rendez-vous</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php endwhile; endif; wp_reset_query(); ?><!-- /Services Loop Section --> 





            <!-- Testimonials Section -->
            <section id="testimonials" class="testimonials section bg-areia">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <div class="linha-vertical"></div>
                    <div class="row">
                        <h1 class="fw-light content-title text-center"><span>V</span>os avis</h1>
                    </div>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="swiper init-swiper">
                                <script type="application/json" class="swiper-config"> {
                                        "loop": true,
                                        "speed": 600,
                                        "autoplay": { "delay": 5000 },
                                        "slidesPerView": "auto",
                                        "pagination": {
                                            "el": ".swiper-pagination",
                                            "type": "bullets",
                                            "clickable": true
                                        },
                                        "breakpoints": {
                                            "320": {
                                                "slidesPerView": 1,
                                                "spaceBetween": 40 
                                            },
                                            "1200": {
                                                "slidesPerView": 1,
                                                "spaceBetween": 1 
                                            }
                                        }
                                    }
                                </script>
                                <div class="swiper-wrapper">
                                    <?php 
                                        // args
                                        $my_args_depoimentos = array( 'post_type' => 'depoimentos', 'order' => 'ASC', 'posts_per_page' => -1 );
                                        // query
                                        $my_query_depoimentos = new WP_Query ( $my_args_depoimentos );
                                    ?>
                                    <?php if( $my_query_depoimentos->have_posts() ) : 
                                        $depoimento = $depoimentos[0];
                                        $c = 0;
                                        while( $my_query_depoimentos->have_posts() ) : $my_query_depoimentos->the_post(); 
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="testimonial mx-auto">
                                            <blockquote><?php the_content(); ?></blockquote>
                                            <h3 class="name"><?php the_title(); ?></h3>
                                        </div>
                                    </div>
                                    <?php endwhile; endif; wp_reset_query(); ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>

                            <!-- Mosaico Section -->
                            <section id="portfolio" class="portfolio section">
                                <div class="container">
                                    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                                        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                                            <?php
                                                $args = array(
                                                    'post_type' => 'mosaico_fotos',
                                                    'posts_per_page' => -1,
                                                );
                                                $query = new WP_Query($args);
                                                if ($query->have_posts()) :
                                                    while ($query->have_posts()) : $query->the_post();
                                            ?>
                                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
                                                <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded')); ?>
                                            </div><!-- End Portfolio Item -->
                                            <?php endwhile; endif; wp_reset_postdata(); ?>
                                        </div><!-- End Portfolio Container -->
                                    </div>
                                </div>
                            </section><!-- /Mosaico Section -->

                        </div>
                    </div>
                </div>                
            </section><!-- /Testimonials Section -->



            <!-- Social Gallery Section --> 
            <section id="galeria" class="services section bg-dourado"> 
                <div class="container">
                    <div class="row">
                        <?php echo do_shortcode(' [insta-gallery id="0"] '); ?>
                    </div>
                </div>
            </section><!-- /Social Gallery Section -->




            <!-- Contact Section -->
            <section id="contact" class="contact section light-background">
                <div class="container">
                    <div class="linha-vertical"></div>
                    <div class="content">
                        <div class="row">
                            <h1 class="fw-light content-title text-center"><span>C</span>ontact</h1>
                        </div>
                        <div class="row justify-content-center pt-5">

                            <div class="col-lg-8">
                                <form action="<?php bloginfo('template_url'); ?>/forms/contact.php" method="post" role="form" class="php-email-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="name" class="form-control rounded-4 mb-3" id="name" placeholder="Nom" required="">
                                            <input type="text" name="phone" class="form-control rounded-4 mb-3" id="phone" placeholder="Numéro de contact" required="">
                                            <input type="email" name="email" class="form-control rounded-4 mb-3" id="email" placeholder="E-mail" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="form-control rounded-4" name="message" placeholder="Rédigez votre message" required=""></textarea>
                                        </div>
                                        <div class="col-md-12 my-3">
                                            <div class="rounded-0"><button type="submit">Envoyer</button></div>
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>
                                    </div>
                                </form>
                            </div><!-- End Contact Form -->
                        </div>
                    </div>
                </div>
            </section><!-- /About 2 Section -->



</main>


<?php get_footer(); ?>