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
    $remote_json = 'https://bandeiragroup.com.br/temas/barbaracruz/barbaracruz.json';
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





// Incluir as funções de personalização
require get_template_directory(). '/assets/inc/custom-hero.php';
require get_template_directory(). '/assets/inc/custom-quisuisje.php';
require get_template_directory(). '/assets/inc/custom-lessoins.php';


?>