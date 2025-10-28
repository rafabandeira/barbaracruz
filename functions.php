<?php

// Setup do tema
if ( ! function_exists( 'barbara_setup' ) ) :
function barbara_setup() {
	// Adiciona suporte a feeds RSS de posts e comentários
	add_theme_support( 'automatic-feed-links' );
	// Adiciona suporte a imagens destacadas
	add_theme_support( 'post-thumbnails' );
	// Adiciona suporte a títulos de página
	add_theme_support( 'title-tag' );
	
	// CORREÇÃO: Adiciona suporte ao Logo Customizável
    add_theme_support( 'custom-logo', array(
        'height'      => 100, // Ajuste conforme necessário
        'width'       => 400, // Ajuste conforme necessário
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // REGISTO DE MENU CORRIGIDO: Adiciona suporte a menus
    register_nav_menus( array(
        'primary' => __( 'Menu Principal', 'barbaracruz' ),
    ) );
}
endif;
add_action( 'after_setup_theme', 'barbara_setup' );

// Título - Removido
// A função `wp_title` já foi substituída por `add_theme_support('title-tag')`,
// que é a melhor prática atual do WordPress.

// Resumo
function custom_excerpt($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '&hellip;'; // Use a entidade HTML para "..."
	} else {
		echo $excerpt;
	}
}

// Enfileirar scripts e estilos
function barbara_enqueue_scripts() {
    // Enfileira estilos
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css', [], '5.3.3' );
    wp_enqueue_style( 'bootstrap-icons', get_template_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css', [], '1.11.3' );
    wp_enqueue_style( 'aos', get_template_directory_uri() . '/assets/vendor/aos/aos.css', [], '2.3.4' );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css', [], '11.0.5' );
    wp_enqueue_style( 'glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/css/glightbox.min.css', [], '3.2.0' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css', [], filemtime(get_template_directory() . '/assets/css/main.css') );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Forum&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&display=swap', [], null );

    // Enfileira scripts
    // NOTA: Bootstrap 5 não requer 'jquery' como dependência, mas outros scripts o utilizam.
    wp_enqueue_script( 'bootstrap-bundle', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', ['jquery'], '5.3.3', true );
    wp_enqueue_script( 'php-email-form-validate', get_template_directory_uri() . '/assets/vendor/php-email-form/validate.js', ['jquery'], '1.0', true );
    wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/vendor/aos/aos.js', [], '2.3.4', true );
    wp_enqueue_script( 'swiper-bundle', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', [], '11.0.5', true );
    wp_enqueue_script( 'glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js', [], '3.2.0', true );
    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js', ['jquery'], '5.0.0', true );
    wp_enqueue_script( 'isotope-layout', get_template_directory_uri() . '/assets/vendor/isotope-layout/isotope.pkgd.min.js', ['jquery'], '3.0.6', true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/main.js'), true );
}
add_action( 'wp_enqueue_scripts', 'barbara_enqueue_scripts' );

// Paginação e navegação
function my_pagination() {
    global $wp_query;
    echo paginate_links( array(
        'base' => str_replace( 9999999999999, '%#%', esc_url( get_pagenum_link( 9999999999999 ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total' => $wp_query->max_num_pages,
        'type' => 'list',
        'prev_next' => true,
        'prev_text' => '<i class="bi bi-arrow-left"></i>',
        'next_text' => '<i class="bi bi-arrow-right"></i>',
        'show_all' => false,
        'mid_size' => 3,
        'end_size' => 1,
    ) );
}
function paginacao_busca() {
    global $busca_query;
    echo paginate_links( array(
        'base' => str_replace( 9999999999999, '%#%', esc_url( get_pagenum_link( 9999999999999 ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total' => $busca_query->max_num_pages,
        'type' => 'list',
        'prev_next' => true,
        'prev_text' => '<i class="bi bi-arrow-left"></i>',
        'next_text' => '<i class="bi bi-arrow-right"></i>',
        'show_all' => false,
        'mid_size' => 3,
        'end_size' => 1,
    ) );
}
function navegacao_post() {
    the_post_navigation( array(
        'screen_reader_text' => '',
        'prev_text' => '<i class="bi bi-arrow-left"></i>',
        'next_text' => '<i class="bi bi-arrow-right"></i>',
    ) );
}

// Adicionando Open Graph e tags
function barbara_add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'barbara_add_opengraph_doctype');
function barbara_insert_fb_in_head() {
    if ( !is_singular() ) {
        return;
    }
    // NOTA: Recomenda-se usar um plugin de SEO para isto,
    // pois ele evitará duplicatas e terá mais opções.
    global $post;
    echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '"/>';
    echo '<meta property="og:type" content="article"/>';
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '"/>';
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '"/>';
    if( has_post_thumbnail( $post->ID ) ) {
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_url( $thumbnail_src[0] ) . '"/>';
    } else {
        $default_image = get_template_directory_uri() . '/assets/img/logo.png';
        echo '<meta property="og:image" content="' . esc_url($default_image) . '"/>';
    }
}
add_action( 'wp_head', 'barbara_insert_fb_in_head', 5 );





/**
 * Remove as caixas padrão e o painel de boas-vindas do painel do WordPress.
 */
function barbaracruz_remove_dashboard_widgets() {
    // Remove o painel de boas-vindas.
    remove_action( 'welcome_panel', 'wp_welcome_panel' );

    // Remove as caixas padrão do painel.
    remove_meta_box( 'dashboard_right_now',   'dashboard', 'normal' );  // Visão geral / At a Glance
    remove_meta_box( 'dashboard_activity',    'dashboard', 'normal' );  // Atividade
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side'   );  // Rascunho Rápido / Quick Draft
    remove_meta_box( 'dashboard_primary',     'dashboard', 'side'   );  // Novidades do WordPress / WordPress News
    remove_meta_box( 'dashboard_secondary',   'dashboard', 'side'   );  // Outras notícias do WordPress
    remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );  // Saúde do Site
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); // Links de Entrada
    remove_meta_box( 'dashboard_plugins',     'dashboard', 'normal' );  // Plugins
}
add_action( 'wp_dashboard_setup', 'barbaracruz_remove_dashboard_widgets' );

/**
 * Adiciona uma caixa personalizada ao painel.
 */
function barbaracruz_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'barbaracruz_custom_dashboard_widget',          // ID do widget
        'Guia Rápido do Site',                          // Título do widget
        'barbaracruz_custom_dashboard_widget_content'   // Nome da função que exibe o conteúdo
    );
}
add_action( 'wp_dashboard_setup', 'barbaracruz_add_dashboard_widgets' );

/**
 * Conteúdo da caixa personalizada do painel.
 */
function barbaracruz_custom_dashboard_widget_content() {
    echo '<h3>Seja bem-vindo(a) ao seu painel!</h3>';
    echo '<p>Aqui estão alguns links úteis para gerenciar o site:</p>';
    echo '<ul>';
    echo '<li><a href="' . esc_url( admin_url( 'themes.php?page=opcoes-tema' ) ) . '">Configurar "Abertura do Site" e "Rodapé"</a></li>';
    echo '<li><a href="' . esc_url( admin_url( 'customize.php' ) ) . '">Alterar o Logo do Site</a></li>';
    echo '<li><a href="' . esc_url( admin_url( 'themes.php?page=quem-eu-sou' ) ) . '">Configurar a seção "Quem Eu Sou"</a></li>';
    echo '<hr>';
    echo '<li><a href="' . esc_url( admin_url( 'post-new.php?post_type=servicos' ) ) . '">Adicionar Novo Serviço</a></li>';
    echo '<li><a href="' . esc_url( admin_url( 'edit.php?post_type=servicos' ) ) . '">Ver Todos os Serviços</a></li>';
    echo '<li><a href="' . esc_url( admin_url( 'edit.php?post_type=depoimentos' ) ) . '">Gerenciar Depoimentos</a></li>';
    echo '<li><a href="' . esc_url( admin_url( 'edit.php?post_type=mosaico_fotos' ) ) . '">Gerenciar Fotos do Mosaico</a></li>';
    echo '</ul>';
    echo '<p>Para qualquer dúvida ou suporte, entre em contato com o desenvolvedor.</p>';
}





/**
 * Remove os menus padrão do painel de administração.
 */
function barbaracruz_remove_admin_menus() {
    // Remove o menu "Páginas".
    remove_menu_page( 'edit.php?post_type=page' );
    // Remove o menu "Comentários".
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'barbaracruz_remove_admin_menus' );




/////////////////////////////////////////
// Adiciona página de ABERTURA DO SITE //
/////////////////////////////////////////
function barbaracruz_add_admin_page() {
    add_menu_page(
        'Abertura do Site',
        'AbertURA do Site',
        'edit_published_posts',
        'opcoes-tema',
        'barbaracruz_render_page',
        'dashicons-welcome-view-site',
        4 
    );
}
add_action( 'admin_menu', 'barbaracruz_add_admin_page' );
/**
 * Renderiza a página no painel
 */
function barbaracruz_render_page() {
    ?>
    <div class="wrap">
        <h1>Opções do Tema</h1>
        <p>Use esta página para gerenciar a seção de abertura (Hero) e as informações de contato do rodapé.</p>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'barbaracruz_options_group' );
                do_settings_sections( 'opcoes-tema' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}
/**
 * Registra as opções (imagem, título e texto)
 */
function barbaracruz_register_settings() {
    // 🔹 Campos com valores padrão (Grupo Hero)
    register_setting( 'barbaracruz_options_group', 'hero_image', array(
        'default' => get_bloginfo('template_url') . '/assets/img/hero.avif'
    ));
    register_setting( 'barbaracruz_options_group', 'hero_title', array(
        'default' => 'Barbara Cruz'
    ));
    register_setting( 'barbaracruz_options_group', 'hero_text', array(
        'default' => 'Bien-être au naturel'
    ));
    
    // Seção Hero
    add_settings_section(
        'barbaracruz_section',
        'Configurações da Seção Hero',
        null,
        'opcoes-tema'
    );
    add_settings_field(
        'hero_image',
        'Imagem de Fundo',
        'barbaracruz_hero_image_callback',
        'opcoes-tema',
        'barbaracruz_section'
    );
    add_settings_field(
        'hero_title',
        'Título',
        'barbaracruz_hero_title_callback',
        'opcoes-tema',
        'barbaracruz_section'
    );
    add_settings_field(
        'hero_text',
        'Texto',
        'barbaracruz_hero_text_callback',
        'opcoes-tema',
        'barbaracruz_section'
    );

    // 
    // CORREÇÃO: Adicionando campos para o Rodapé (Footer)
    // 
    
    // 🔹 Campos com valores padrão (Grupo Rodapé)
    register_setting( 'barbaracruz_options_group', 'footer_phone', array( 'default' => '06 59 66 56 78' ));
    register_setting( 'barbaracruz_options_group', 'footer_instagram', array( 'default' => '@barbaracruz.br' ));
    register_setting( 'barbaracruz_options_group', 'footer_email', array( 'default' => 'contact@barbaracruz.fr' ));
    
    // Seção Rodapé
    add_settings_section(
        'barbaracruz_footer_section',
        'Configurações do Rodapé',
        null,
        'opcoes-tema'
    );

    // Campos Rodapé
    add_settings_field(
        'footer_phone',
        'Telefone',
        'barbaracruz_footer_phone_callback',
        'opcoes-tema',
        'barbaracruz_footer_section'
    );
    add_settings_field(
        'footer_instagram',
        'Instagram',
        'barbaracruz_footer_instagram_callback',
        'opcoes-tema',
        'barbaracruz_footer_section'
    );
    add_settings_field(
        'footer_email',
        'Email',
        'barbaracruz_footer_email_callback',
        'opcoes-tema',
        'barbaracruz_footer_section'
    );
}
add_action( 'admin_init', 'barbaracruz_register_settings' );
/**
 * Callbacks dos campos Hero
 */
function barbaracruz_hero_image_callback() {
    $valor = get_option( 'hero_image', get_bloginfo('template_url') . '/assets/img/hero.avif' );
    ?>
    <div style="margin-bottom:10px;">
        <img id="hero_image_preview" src="<?php echo esc_url($valor); ?>" style="max-width:300px; display:block; margin-bottom:10px;">
        <input type="hidden" id="hero_image" name="hero_image" value="<?php echo esc_attr($valor); ?>" />
        <button type="button" class="button" id="hero_image_button">Selecionar imagem</button>
        <button type="button" class="button" id="hero_image_remove">Remover</button>
    </div>
    <script>
        jQuery(document).ready(function($){
            var mediaUploader;
            $('#hero_image_button').click(function(e) {
                e.preventDefault();
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Escolher imagem',
                    button: { text: 'Usar esta imagem' },
                    multiple: false
                });
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#hero_image').val(attachment.url);
                    $('#hero_image_preview').attr('src', attachment.url).show();
                });
                mediaUploader.open();
            });
            $('#hero_image_remove').click(function(){
                $('#hero_image').val('');
                $('#hero_image_preview').hide();
            });
        });
    </script>
    <?php
}
function barbaracruz_hero_title_callback() {
    $valor = get_option( 'hero_title', 'Barbara Cruz' );
    echo '<input type="text" name="hero_title" value="' . esc_attr( $valor ) . '" class="regular-text" />';
    echo '<p class="description">Deixe em branco para não exibir.</p>';
}
function barbaracruz_hero_text_callback() {
    $valor = get_option( 'hero_text', 'Bien-être au naturel' );
    echo '<input type="text" name="hero_text" value="' . esc_attr( $valor ) . '" class="regular-text" />';
    echo '<p class="description">Deixe em branco para não exibir.</p>';
}
function barbaracruz_admin_scripts($hook) {
    // Só carrega na página de opções do tema
    if ( $hook != 'toplevel_page_opcoes-tema' ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'barbaracruz_admin_scripts');


/**
 * CORREÇÃO: Callbacks dos campos de Rodapé
 */
function barbaracruz_footer_phone_callback() {
    $valor = get_option( 'footer_phone', '06 59 66 56 78' );
    echo '<input type="text" name="footer_phone" value="' . esc_attr( $valor ) . '" class="regular-text" placeholder="06 59 66 56 78" />';
}
function barbaracruz_footer_instagram_callback() {
    $valor = get_option( 'footer_instagram', '@barbaracruz.br' );
    echo '<input type="text" name="footer_instagram" value="' . esc_attr( $valor ) . '" class="regular-text" placeholder="@barbaracruz.br" />';
    echo '<p class="description">Insira o @ do instagram (Ex: @barbaracruz.br).</p>';
}
function barbaracruz_footer_email_callback() {
    $valor = get_option( 'footer_email', 'contact@barbaracruz.fr' );
    echo '<input type="email" name="footer_email" value="' . esc_attr( $valor ) . '" class="regular-text" placeholder="contact@barbaracruz.fr" />';
}



//////////////////////////////////
// Adiciona menu de QUEM EU SOU //
//////////////////////////////////
function barbaracruz_add_quem_eu_sou_page() {
    add_menu_page(
        'Quem eu sou',               // Título da página
        'Quem eu sou',               // Nome no menu
        'edit_published_posts',      // Permissão
        'quem-eu-sou',               // Slug da página
        'barbaracruz_render_quem_eu_sou_page', // Callback para renderizar
        'dashicons-id',              // Ícone
        5                            // Posição
    );
}
add_action( 'admin_menu', 'barbaracruz_add_quem_eu_sou_page' );
/**
 * Renderiza a página "Quem eu sou"
 */
function barbaracruz_render_quem_eu_sou_page() {
    ?>
    <div class="wrap">
        <h1>Configurações - Quem eu sou</h1>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'barbaracruz_quem_eu_sou_group' );
                do_settings_sections( 'quem-eu-sou' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}
/**
 * Registra opções para a página "Quem eu sou"
 */
function barbaracruz_register_quem_eu_sou_settings() {
    // 🔹 Campos com valores padrão
    register_setting( 'barbaracruz_quem_eu_sou_group', 'about2_title', array(
        'default' => 'Qui suis-je'
    ));
    register_setting( 'barbaracruz_quem_eu_sou_group', 'about2_image', array(
        'default' => get_bloginfo('template_url') . '/assets/img/barbara.avif'
    ));
    register_setting( 'barbaracruz_quem_eu_sou_group', 'about2_text', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. <em><strong>Mes formations: </strong></em>– Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. – Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'
    ));
    // 🔹 Seção
    add_settings_section(
        'barbaracruz_section_about2',
        'Conteúdo da seção "Quem eu sou"',
        null,
        'quem-eu-sou'
    );
    // Campo: Título
    add_settings_field(
        'about2_title',
        'Título',
        'barbaracruz_about2_title_callback',
        'quem-eu-sou',
        'barbaracruz_section_about2'
    );
    // Campo: Imagem
    add_settings_field(
        'about2_image',
        'Imagem',
        'barbaracruz_about2_image_callback',
        'quem-eu-sou',
        'barbaracruz_section_about2'
    );
    // Campo: Texto
    add_settings_field(
        'about2_text',
        'Texto',
        'barbaracruz_about2_text_callback',
        'quem-eu-sou',
        'barbaracruz_section_about2'
    );
}
add_action( 'admin_init', 'barbaracruz_register_quem_eu_sou_settings' );
function barbaracruz_about2_title_callback() {
    $valor = get_option( 'about2_title', 'Qui suis-je' );
    echo '<input type="text" name="about2_title" value="' . esc_attr( $valor ) . '" class="regular-text" />';
}
function barbaracruz_about2_image_callback() {
    $valor = get_option( 'about2_image', get_bloginfo('template_url') . '/assets/img/barbara.avif' );
    ?>
    <div style="margin-bottom:10px;">
        <img id="about2_image_preview" src="<?php echo esc_url($valor); ?>" style="max-width:300px; display:block; margin-bottom:10px;">
        <input type="hidden" id="about2_image" name="about2_image" value="<?php echo esc_attr($valor); ?>" />
        <button type="button" class="button" id="about2_image_button">Selecionar imagem</button>
        <button type="button" class="button" id="about2_image_remove">Remover</button>
    </div>
    <script>
        jQuery(document).ready(function($){
            var mediaUploader;
            $('#about2_image_button').click(function(e) {
                e.preventDefault();
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Escolher imagem',
                    button: { text: 'Usar esta imagem' },
                    multiple: false
                });
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#about2_image').val(attachment.url);
                    $('#about2_image_preview').attr('src', attachment.url).show();
                });
                mediaUploader.open();
            });
            $('#about2_image_remove').click(function(){
                $('#about2_image').val('');
                $('#about2_image_preview').hide();
            });
        });
    </script>
    <?php
}
function barbaracruz_about2_text_callback() {
    $valor = get_option( 'about2_text' );
    $config_editor = array(
        'textarea_name' => 'about2_text',
        'textarea_rows' => 10,
        'media_buttons' => false, // se quiser permitir botão de adicionar mídia, mude para true
        'teeny'         => false, // versão reduzida (false = editor completo)
        'tinymce'       => true,  // habilita TinyMCE
        'quicktags'     => true   // habilita editor HTML
    );
    wp_editor( $valor, 'about2_text_editor', $config_editor );
}
function barbaracruz_admin_scripts_quem_eu_sou($hook) {
    // slug da página = 'toplevel_page_quem-eu-sou'
    if ( $hook !== 'toplevel_page_quem-eu-sou' ) {
        return;
    }
    wp_enqueue_media();             // carrega media uploader
    wp_enqueue_script('jquery');    // garante que jQuery está presente
}
add_action('admin_enqueue_scripts', 'barbaracruz_admin_scripts_quem_eu_sou');






//////////////////////////////////////////////
// Criar o tipo de post para os Depoimentos //
//////////////////////////////////////////////
function create_post_type_depoimentos() {

    register_post_type('depoimentos',
    // Definir as opções
    array(
        'labels' => array(
            'name' => __('Depoimentos'),
            'singular_name' => __('Depoimento'),
            'add_new' => __('Novo depoimento'),
            'add_new_item' => __('Adicionar novo depoimento'),
            'edit_item' => __( 'Editar depoimento' ),
            'new_item' => __( 'Novo depoimento' ),
        ),
        'supports' => array(
            'title', 'editor'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-businessperson',
        'rewrite' => array('slug' => 'depoimentos'),
        'menu_position' => 7    // Posição
    ));
}
// Iniciar o tipo de post
add_action('init', 'create_post_type_depoimentos');


///////////////////////////////////////////
// Criar o tipo de post para os Serviços //
///////////////////////////////////////////
function create_post_type_servicos() {
    register_post_type('servicos',
    // Definir as opções
    array(
        'labels' => array(
            'name' => __('Serviços'),
            'singular_name' => __('Serviço'),
            'add_new' => __('Novo serviço'),
            'add_new_item' => __('Adicionar novo serviço'),
            'edit_item' => __( 'Editar serviço' ),
            'new_item' => __( 'Novo serviço' ),
        ),
        'supports' => array(
            'title', 'editor', 'thumbnail', 'excerpt' 
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-heart',
        'rewrite' => array('slug' => 'servicos'),
        'menu_position' => 6    // Posição

    ));
}
// Iniciar o tipo de post
add_action('init', 'create_post_type_servicos');





////////////////////////////////////////////////// 
// Criar o tipo de post para o Mosaico de Fotos //
//////////////////////////////////////////////////
function create_post_type_mosaico_fotos() {
    register_post_type('mosaico_fotos',
    // Definir as opções
    array(
        'labels' => array(
            'name' => __('Mosaico de Fotos'),
            'singular_name' => __('Foto'),
            'add_new' => __('Adicionar Nova Foto'),
            'add_new_item' => __('Adicionar Nova Foto'),
            'edit_item' => __( 'Editar Foto' ),
            'new_item' => __( 'Nova Foto' ),
        ),
        'supports' => array(
            'title', 'thumbnail'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'rewrite' => array('slug' => 'mosaico-fotos'),
        'menu_position' => 8    // Posição
    ));
}
// Iniciar o tipo de post
add_action('init', 'create_post_type_mosaico_fotos');



// Adiciona os campos subtítulo, ordem e cor ao post type Serviços
function servicos_add_custom_metaboxes() {
    add_meta_box(
        'servicos_subtitle',
        __('Subtítulo'),
        'servicos_subtitle_metabox_callback',
        'servicos',
        'normal',
        'high'
    );
    add_meta_box(
        'servicos_ordem',
        __('Ordem de Exibição'),
        'servicos_ordem_metabox_callback',
        'servicos',
        'side',
        'default'
    );
    add_meta_box(
        'servicos_cor',
        __('Cor de Fundo'),
        'servicos_cor_metabox_callback',
        'servicos',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'servicos_add_custom_metaboxes');

// CORREÇÃO DE SEGURANÇA: Adiciona o campo nonce
function servicos_subtitle_metabox_callback($post) {
    // Adiciona um nonce field para verificação
    wp_nonce_field('servicos_custom_meta_nonce', 'servicos_nonce_field');
    
    $value = get_post_meta($post->ID, '_servicos_subtitle', true);
    echo '<input type="text" style="width:100%" name="servicos_subtitle_field" value="' . esc_attr($value) . '" placeholder="Digite o subtítulo aqui" />';
}

function servicos_ordem_metabox_callback($post) {
    // O nonce já foi adicionado no callback anterior, não é necessário repetir
    $value = get_post_meta($post->ID, '_servicos_ordem', true);
    echo '<input type="number" min="0" style="width:100%" name="servicos_ordem_field" value="' . esc_attr($value) . '" placeholder="Ex: 1" />';
}

function servicos_cor_metabox_callback($post) {
    // O nonce já foi adicionado no callback anterior, não é necessário repetir
    $value = get_post_meta($post->ID, '_servicos_cor', true);
    ?>
    <select name="servicos_cor_field" style="width:100%">
        <option value="bg-dourado" <?php selected($value, 'bg-dourado'); ?>>Dourado</option>
        <option value="bg-terracota" <?php selected($value, 'bg-terracota'); ?>>Terracota</option>
        <option value="bg-areia" <?php selected($value, 'bg-areia'); ?>>Areia</option>
    </select>
    <?php
}

// CORREÇÃO DE SEGURANÇA: Adiciona verificações na função de guardar
function servicos_save_custom_meta($post_id) {
    
    // 1. Verificar se o nosso nonce foi enviado.
    if ( ! isset( $_POST['servicos_nonce_field'] ) ) {
        return;
    }

    // 2. Verificar se o nonce é válido.
    if ( ! wp_verify_nonce( $_POST['servicos_nonce_field'], 'servicos_custom_meta_nonce' ) ) {
        return;
    }

    // 3. Se for um autosave, não fazer nada.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // 4. Verificar as permissões do utilizador.
    if ( isset( $_POST['post_type'] ) && 'servicos' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    } else {
        return; // Se não for do tipo 'servicos', saia
    }

    // Agora, podemos guardar os dados.

    // Guardar Subtítulo
    if (array_key_exists('servicos_subtitle_field', $_POST)) {
        update_post_meta(
            $post_id, 
            '_servicos_subtitle', 
            sanitize_text_field($_POST['servicos_subtitle_field'])
        );
    }
    
    // Guardar Ordem
    if (array_key_exists('servicos_ordem_field', $_POST)) {
        update_post_meta(
            $post_id, 
            '_servicos_ordem', 
            intval($_POST['servicos_ordem_field'])
        );
    }
    
    // Guardar Cor
    if (array_key_exists('servicos_cor_field', $_POST)) {
        update_post_meta(
            $post_id, 
            '_servicos_cor', 
            sanitize_text_field($_POST['servicos_cor_field'])
        );
    }
}
add_action('save_post', 'servicos_save_custom_meta');





/////////////////////////////////////////////////
// Reordena os menus nativos "Posts" e "Mídia" //
/////////////////////////////////////////////////
function barbaracruz_reorder_menus() {
    remove_menu_page( 'edit.php' ); // Remove o menu "Posts"
    remove_menu_page( 'upload.php' ); // Remove o menu "Mídia"
    add_menu_page(
        'Posts',
        'Posts',
        'edit_published_posts',
        'edit.php',
        '', // A função de callback é vazia pois o WordPress já a define
        'dashicons-admin-post',
        9 // Posição 
    );
    add_menu_page(
        'Mídia',
        'Mídia',
        'edit_published_posts',
        'upload.php',
        '',
        'dashicons-admin-media',
        10 // Posição 
    );
}
add_action( 'admin_menu', 'barbaracruz_reorder_menus', 99 );











///////////////////////////////////////////////
// Oculta menus do painel de administração   //
// para usuários que não são administradores //
///////////////////////////////////////////////
function barbaracruz_remove_menus_for_non_admins() {
    if ( ! current_user_can( 'manage_options' ) ) {
        remove_menu_page( 'themes.php' );         // Oculta o menu "Aparência"
        remove_menu_page( 'plugins.php' );        // Oculta o menu "Plugins"
        remove_menu_page( 'tools.php' );          // Oculta o menu "Ferramentas"
    }
}
add_action( 'admin_menu', 'barbaracruz_remove_menus_for_non_admins' );





/////////////////////////////////////////////////////////
// Verificar atualizações do tema via servidor pessoal //
/////////////////////////////////////////////////////////

// CORREÇÃO DE PERFORMANCE: A linha delete_site_transient() foi removida daqui.

function update_checker( $transient ) {
    if ( empty( $transient->checked ) ) {
        return $transient;
    }
    // URL do JSON de atualizações
    $remote_json = 'https://raw.githubusercontent.com/rafabandeira/barbaracruz/refs/heads/main/barbaracruz.json';
    // Buscar dados do JSON
    $response = wp_remote_get( $remote_json, array(
        'timeout' => 10,
        'headers' => array( 'Accept' => 'application/json' )
    ) );
    // Se houver erro, retorne o transient original
    if ( is_wp_error( $response ) ) {
        return $transient;
    }
    // Verifica se a resposta é válida
    if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
        return $transient;
    }
    // Decodificar JSON
    $remote_data = json_decode( wp_remote_retrieve_body( $response ) );
    // Verificar se a decodificação foi bem-sucedida e se os campos necessários estão presentes
    if ( json_last_error() !== JSON_ERROR_NONE || ! isset( $remote_data->version, $remote_data->details_url, $remote_data->download_url ) ) {
        return $transient; // Retornar o transient original se houver erro na decodificação ou campos ausentes
    }
    // Identificar slug e versão do tema
    $theme_slug = get_template(); // Slug do tema (nome da pasta)
    $current_version = wp_get_theme( $theme_slug )->get( 'Version' );
    // Comparar versões
    if ( version_compare( $current_version, $remote_data->version, '<' ) ) {
        $transient->response[ $theme_slug ] = array(
            'theme'        => $theme_slug,
            'new_version'  => $remote_data->version,
            'details_url'  => esc_url( $remote_data->details_url ),
            'package'      => esc_url( $remote_data->download_url ),
        );
    }
    return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'update_checker' );


// CORREÇÃO DE PERFORMANCE: A função 'update_checker_multisite_network' foi removida
// por ser redundante e causar problemas de performance.


?>