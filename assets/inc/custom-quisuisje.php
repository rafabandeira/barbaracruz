<?php

// Personalizar itens do tema
function quisuisje_customize_register($wp_customize) {
    //Qui Suis-je
    $wp_customize -> add_section('quisuisje', array(
        'title' => __('Qui Suis-je', 'Bárbara Cruz'),
        'priority' => 30
    ));

    //  =============================
    //  = IMAGEM
    //  =============================
    $wp_customize->add_setting('quisuisje-imagem', array(
        'default' => get_template_directory_uri().'/assets/img/barbara.png',
        'transport' => 'refresh',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'quisuisje-imagem', array(
        'label' => __('Imagem', 'Bárbara Cruz'),
        'section' => 'quisuisje',
        'settings' => 'quisuisje-imagem',
        'priority' => 1
    )));

    //  =============================
    //  = TITULO
    //  =============================
    $wp_customize -> add_setting('quisuisje-titulo', array(
        'default' => _x('<span>Q</span>ui suis-je', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('quisuisje-titulo',array(
        'label' => __('Título', 'Bárbara Cruz'),
        'description' => 'Para deixar a primeira letra maior usar <b>&lt;span&gt;</b> antes e <b>&lt;/span&gt;</b> depois da letra.',
        'section' => 'quisuisje',
        'priority' => 2
    ));

    //  =============================
    //  = TEXTO
    //  =============================
    $wp_customize -> add_setting('quisuisje-texto', array(
        'default' => _x('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</br><em>Mes formations:</em>– Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. <br>– Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('quisuisje-texto',array(
        'label' => __('Texto', 'Bárbara Cruz'),
        'type' => 'textarea',
        'description' => 'Para dar o efeito do <b>ENTER</b> no parágrafo, usar <b>&lt;br&gt;</b> depois do ponto final. <br><br>Já para criar um subtitulo, utilizar <b>&lt;em&gt;</b> antes e <b>&lt;/em&gt;</b> depois da palavra ou frase.',
        'section' => 'quisuisje',
        'priority' => 3
    ));

}

add_action('customize_register','quisuisje_customize_register');
?>