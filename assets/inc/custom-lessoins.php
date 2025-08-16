<?php

// Personalizar itens do tema
function lessoins_customize_register($wp_customize) {
    // Adicionar um painel principal para "Les Soins"
    $wp_customize->add_panel('lessoins_panel', array(
        'title' => __('Les Soins', 'Bárbara Cruz'),
        'description' => __('Configurações para os serviços Les Soins', 'Bárbara Cruz'),
        'priority' => 40,
    ));

    // Adicionar seção para o título principal
    $wp_customize->add_section('lessoins_titulo', array(
        'title' => __('Título Principal', 'Bárbara Cruz'),
        'panel' => 'lessoins_panel',
        'priority' => 1
    ));
    
    //  =============================
    //  = TÍTULO
    //  =============================
    $wp_customize -> add_setting('lessoins-title', array(
        'default' => _x('<span>L</span>es <span>S</span>oins', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-title',array(
        'label' => __('Título', 'Bárbara Cruz'),
        'section' => 'lessoins_titulo',
        'priority' => 1
    ));

    // Adicionando subseções para cada serviço
    $wp_customize->add_section('lessoins_servico1', array(
        'title' => __('Serviço 1', 'Bárbara Cruz'),
        'panel' => 'lessoins_panel',
        'priority' => 2
    ));

    $wp_customize->add_section('lessoins_servico2', array(
        'title' => __('Serviço 2', 'Bárbara Cruz'),
        'panel' => 'lessoins_panel',
        'priority' => 3
    ));

    $wp_customize->add_section('lessoins_servico3', array(
        'title' => __('Serviço 3', 'Bárbara Cruz'),
        'panel' => 'lessoins_panel',
        'priority' => 4
    ));

    //  =============================
    //  = SERVIÇO 1
    //  =============================
    $wp_customize->add_setting('lessoins-image1', array(
        'default' => get_template_directory_uri() . '/assets/img/massagem-1.jpg',
        'transport' => 'refresh',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'lessoins-image1', array(
        'label'    => __('Imagem do Serviço 1', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico1',
        'settings' => 'lessoins-image1',
        'priority' => 1
    )));
    $wp_customize -> add_setting('lessoins-titulo1', array(
        'default' => _x('Dreinage lymphatique', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-titulo1',array(
        'label'    => __('Título do Serviço 1', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico1',
        'priority' => 2
    ));
    $wp_customize -> add_setting('lessoins-subtitulo1', array(
        'default' => _x('méthode Renata França®', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-subtitulo1',array(
        'label'    => __('Subtítulo do Serviço 1', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico1',
        'priority' => 3
    ));
    $wp_customize -> add_setting('lessoins-texto1', array(
        'default' => _x('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.<br>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-texto1',array(
        'type' => 'textarea',
        'description' => 'Para dar o efeito do <b>ENTER</b> no parágrafo, usar <b>&lt;br&gt;</b> depois do ponto final. ',
        'section' => 'lessoins_servico1',
        'priority' => 4
    ));
    $wp_customize -> add_setting('lessoins-link1', array(
        'default' => _x('https://wa.me/+33659665678', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-link1',array(
        'label'    => __('Link do Serviço 1', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico1',
        'priority' => 5
    ));

    //  =============================
    //  = SERVIÇO 2
    //  =============================
    $wp_customize->add_setting('lessoins-image2', array(
        'default' => get_template_directory_uri() . '/assets/img/massagem-2.jpg',
        'transport' => 'refresh',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'lessoins-image2', array(
        'label'    => __('Imagem do Serviço 2', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico2',
        'settings' => 'lessoins-image2',
        'priority' => 1
    )));
    $wp_customize -> add_setting('lessoins-titulo2', array(
        'default' => _x('Thérapies orientales', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-titulo2',array(
        'label'    => __('Título do Serviço 2', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico2',
        'priority' => 2
    ));
    $wp_customize -> add_setting('lessoins-subtitulo2', array(
        'default' => _x('', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-subtitulo2',array(
        'label'    => __('Subtítulo do Serviço 2', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico2',
        'priority' => 3
    ));
    $wp_customize -> add_setting('lessoins-texto2', array(
        'default' => _x('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.<br>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-texto2',array(
        'type' => 'textarea',
        'description' => 'Para dar o efeito do <b>ENTER</b> no parágrafo, usar <b>&lt;br&gt;</b> depois do ponto final. ',
        'section' => 'lessoins_servico2',
        'priority' => 4
    ));
    $wp_customize -> add_setting('lessoins-link2', array(
        'default' => _x('https://wa.me/+33659665678', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-link2',array(
        'label'    => __('Link do Serviço 2', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico2',
        'priority' => 5
    ));


    //  =============================
    //  = SERVIÇO 3
    //  =============================
    $wp_customize->add_setting('lessoins-image3', array(
        'default' => get_template_directory_uri() . '/assets/img/massagem-3.jpg',
        'transport' => 'refresh',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'lessoins-image3', array(
        'label'    => __('Imagem do Serviço 3', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico3',
        'settings' => 'lessoins-image3',
        'priority' => 1
    )));
    $wp_customize -> add_setting('lessoins-titulo3', array(
        'default' => _x('Naturopathie', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-titulo3',array(
        'label'    => __('Título do Serviço 3', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico3',
        'priority' => 2
    ));
    $wp_customize -> add_setting('lessoins-subtitulo3', array(
        'default' => _x('', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-subtitulo3',array(
        'label'    => __('Subtítulo do Serviço 3', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico3',
        'priority' => 3
    ));
    $wp_customize -> add_setting('lessoins-texto3', array(
        'default' => _x('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.<br>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-texto3',array(
        'type' => 'textarea',
        'description' => 'Para dar o efeito do <b>ENTER</b> no parágrafo, usar <b>&lt;br&gt;</b> depois do ponto final. ',
        'section' => 'lessoins_servico3',
        'priority' => 4
    ));
    $wp_customize -> add_setting('lessoins-link3', array(
        'default' => _x('https://wa.me/+33659665678', 'Bárbara Cruz'),
        'type' => 'theme_mod'
    ));
    $wp_customize -> add_control('lessoins-link3',array(
        'label'    => __('Link do Serviço 3', 'Bárbara Cruz'),
        'section'  => 'lessoins_servico3',
        'priority' => 5
    ));

}

add_action('customize_register','lessoins_customize_register');
?>