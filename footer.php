<footer id="footer" class="footer">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="row">
                    <div class="col-lg-4 d-lg-flex text-center text-lg-start">
                        <h1>Barbara Cruz</h1>
                    </div>
                    <div class="col-sm-12 col-lg-8 d-lg-flex text-center text-lg-start">
                        
                        <?php
                        // CORREÇÃO: Substituído conteúdo estático (hardcoded) por opções do tema.
                        // Gerenciável em "AbertURA do Site" > "Configurações do Rodapé"
                        $footer_phone = get_option('footer_phone', '06 59 66 56 78');
                        $footer_insta = get_option('footer_instagram', '@barbaracruz.br');
                        $footer_email = get_option('footer_email', 'contact@barbaracruz.fr');
                        ?>
                        
                        <p>
                            <i class="bi bi-geo-alt-fill"></i> Bourg la Reine<br>
                            
                            <?php if ( !empty($footer_phone) ) : ?>
                                <i class="bi bi-phone"></i> <?php echo esc_html($footer_phone); ?><br>
                            <?php endif; ?>
                            
                            <?php if ( !empty($footer_insta) ) : ?>
                                <i class="bi bi-instagram"></i> <?php echo esc_html($footer_insta); ?><br>
                            <?php endif; ?>
                            
                            <?php if ( !empty($footer_email) ) : ?>
                                <i class="bi bi-envelope"></i> <?php echo esc_html($footer_email); ?>
                            <?php endif; ?>
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<div id="preloader"></div>

<?php wp_footer(); ?>
</body>
</html>