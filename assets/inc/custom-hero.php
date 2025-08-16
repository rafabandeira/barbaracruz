<?php

// Personalizar itens do tema
function barbara_customize_register($wp_customize) {
    //HERO
    $wp_customize -> add_section('hero', array(
        'title' => __('Abertura do site', 'Bárbara Cruz'),
        'priority' => 20
    ));

    //  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('hero_image', array(
        'default' => get_template_directory_uri() . '/assets/img/hero.jpg',
        'transport'     => 'refresh',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',

    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label'    => __('Imagem', 'Bárbara Cruz'),
        'section'  => 'hero',
        'settings' => 'hero_image',
        'priority' => 1
    )));

    //  =============================
    //  = TÍTULO
    //  =============================
    $wp_customize -> add_setting('hero_title', array(
        'default' => _x('<span>B</span>ÁRBARA <span>C</span>RUZ', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('hero_title',array(
        'label' => __('Título', 'Bárbara Cruz'),
        'description' => 'Para deixar a primeira letra maior usar <b>&lt;span&gt;</b> antes e <b>&lt;/span&gt;</b> depois da letra.',
        'section' => 'hero',
        'priority' => 2
    ));
    $wp_customize -> add_setting('hero_text', array(
        'default' => _x('Bien-être au naturel', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('hero_text',array(
        'section' => 'hero',
        'priority' => 3
    ));

}

add_action('customize_register','barbara_customize_register');
?>