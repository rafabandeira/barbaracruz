<?php

// Setup
if ( ! function_exists( 'barbara_setup' ) ) :
function barbara_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	// Post Thumbnails
	add_theme_support( 'post-thumbnails' );
}
endif; // barbara_setup
add_action( 'after_setup_theme', 'barbara_setup' );

// Título
function barbara_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) { return $title; }
	$title .= get_bloginfo( 'name', 'display' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'banews' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'barbara_wp_title', 10, 2 );

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
		echo '...';
	} else {
		echo $excerpt;
	}
}

// Paginação Notícias
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
// Paginação Busca
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
// Previous/next post navigation.
function navegacao_post() {
    echo the_post_navigation( array(
        'screen_reader_text' => '', 
        'prev_text' => '<i class="bi bi-arrow-left"></i>',
        'next_text' => '<i class="bi bi-arrow-right"></i>',
    ) );
}

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');
//Lets add Open Graph Meta Info
function insert_fb_in_head() {
global $post;
if ( !is_singular()) //if it is not a post or a page
    return;
    echo '<meta property="og:title" content="'.get_the_title().'"/>';
    echo '<meta property="og:type" content="article"/>';
    echo '<meta property="og:url" content="'.get_permalink().'"/>';
    echo '<meta property="og:site_name" content="Barbara Cruz"/>';
if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
    $default_image="https://barbaracruz.bandeiragroup.com.br/wp-content/themes/barbaracruz/assets/img/logo.png"; //replace this with a default image on your server or an image in your media library
    echo '<meta property="og:image" content="'.$default_image.'"/>';
}
else{
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    echo '<meta property="og:image" content="'.esc_attr( $thumbnail_src[0] ).'"/>';
}
echo "";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );




/////////////////////////////////////////
// Adiciona página de ABERTURA DO SITE //
/////////////////////////////////////////
function barbaracruz_add_admin_page() {
    add_menu_page(
        'Abertura do Site',
        'Abertura do Site',
        'manage_options',
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
    // 🔹 Campos com valores padrão
    register_setting( 'barbaracruz_options_group', 'hero_image', array(
        'default' => get_bloginfo('template_url') . '/assets/img/hero.avif'
    ));
    register_setting( 'barbaracruz_options_group', 'hero_title', array(
        'default' => 'Barbara Cruz'
    ));
    register_setting( 'barbaracruz_options_group', 'hero_text', array(
        'default' => 'Bien-être au naturel'
    ));
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
}
add_action( 'admin_init', 'barbaracruz_register_settings' );
/**
 * Callbacks dos campos
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
    $valor = get_option( 'hero_title', '<span>B</span>arbara <span>C</span>ruz' );
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






//////////////////////////////////
// Adiciona menu de QUEM EU SOU //
//////////////////////////////////
function barbaracruz_add_quem_eu_sou_page() {
    add_menu_page(
        'Quem eu sou',               // Título da página
        'Quem eu sou',               // Nome no menu
        'manage_options',            // Permissão
        'quem-eu-sou',               // Slug da página
        'barbaracruz_render_quem_eu_sou_page', // Callback para renderizar
        'dashicons-id',              // Ícone
        4                            // Posição
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
    $valor = get_option( 'about2_title', '<span>Q</span>ui suis-je' );
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
    ));
}
// Iniciar o tipo de post
add_action('init', 'create_post_type_servicos');



// Criar o tipo de post para o Mosaico de Fotos
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

function servicos_subtitle_metabox_callback($post) {
    $value = get_post_meta($post->ID, '_servicos_subtitle', true);
    echo '<input type="text" style="width:100%" name="servicos_subtitle_field" value="' . esc_attr($value) . '" placeholder="Digite o subtítulo aqui" />';
}

function servicos_ordem_metabox_callback($post) {
    $value = get_post_meta($post->ID, '_servicos_ordem', true);
    echo '<input type="number" min="0" style="width:100%" name="servicos_ordem_field" value="' . esc_attr($value) . '" placeholder="Ex: 1" />';
}

function servicos_cor_metabox_callback($post) {
    $value = get_post_meta($post->ID, '_servicos_cor', true);
    ?>
    <select name="servicos_cor_field" style="width:100%">
        <option value="bg-dourado" <?php selected($value, 'bg-dourado'); ?>>Dourado</option>
        <option value="bg-terracota" <?php selected($value, 'bg-terracota'); ?>>Terracota</option>
        <option value="bg-areia" <?php selected($value, 'bg-areia'); ?>>Areia</option>
    </select>
    <?php
}

function servicos_save_custom_meta($post_id) {
    if (array_key_exists('servicos_subtitle_field', $_POST)) {
        update_post_meta($post_id, '_servicos_subtitle', sanitize_text_field($_POST['servicos_subtitle_field']));
    }
    if (array_key_exists('servicos_ordem_field', $_POST)) {
        update_post_meta($post_id, '_servicos_ordem', intval($_POST['servicos_ordem_field']));
    }
    if (array_key_exists('servicos_cor_field', $_POST)) {
        update_post_meta($post_id, '_servicos_cor', sanitize_text_field($_POST['servicos_cor_field']));
    }
}
add_action('save_post', 'servicos_save_custom_meta');





/////////////////////////////////////////////////////////
// Verificar atualizações do tema via servidor pessoal //
/////////////////////////////////////////////////////////
delete_site_transient('update_themes');
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
// Garantir que o código funcione em Multisite
function update_checker_multisite_network() {
    if ( is_multisite() ) {
        $sites = get_sites();
        foreach ( $sites as $site ) {
            switch_to_blog( $site->blog_id );
            // Executar o código de verificação para cada site
            $transient = get_site_transient( 'update_themes' );
            $transient = update_checker( $transient );
            set_site_transient( 'update_themes', $transient );
            restore_current_blog();
        }
    }
}
add_action( 'admin_init', 'update_checker_multisite_network' );





?>