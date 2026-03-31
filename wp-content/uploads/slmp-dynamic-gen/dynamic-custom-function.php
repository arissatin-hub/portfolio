<?php
    
/*
* Gutenberg Full-Width.
*/
add_theme_support('align-wide');

/*
* Enable shortcode in acf field.
*/
add_filter('acf/format_value/type=text', 'do_shortcode');
add_filter('acf/format_value/type=textarea', 'do_shortcode');
add_filter('acf/format_value/type=acfe_code_editor', 'do_shortcode');
add_filter( 'widget_text', 'do_shortcode' );
add_filter('wpcf7_autop_or_not', '__return_false');
add_filter( 'the_title', 'do_shortcode' );
add_filter( 'single_post_title', 'do_shortcode' );

/*
*Remove Site Header
*/
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

/*
*Repositions primary navigation menu
*/
remove_action( 'genesis_after_header', 'genesis_do_nav' );
/*
*Removes Site Logo
*/
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

/*
*Remove Footer
*/
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

/*
*Prevent Image Upload Scale
*/
add_filter( 'big_image_size_threshold', '__return_false' );

/*
*Add ACF Option Page
*/
if( function_exists('acf_add_options_page') ) {
    $parent_option = acf_add_options_page(array(
        'page_title'  => 'Theme Options',
        'menu_title'  => 'Theme Options',
        'menu_slug'   => 'theme-options',
        'capability'  => 'edit_posts',
        'icon_url'    => 'dashicons-admin-site',
        'redirect'    => false
    ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Site Sections',
        'menu_title'  => 'Site Sections',
        'parent_slug' => $parent_option['menu_slug'],
     ));
    acf_add_options_sub_page(array(
        'page_title'  => 'Custom Design',
        'menu_title'  => 'Custom Design',
        'parent_slug' => $parent_option['menu_slug'],
     ));
}

/*
*Custom Breadcrumbs Display
*/
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );
function sp_breadcrumb_args( $args ) {
    $archive_month = get_the_time('m');
    $args['home']                   = '<span class="home-icon relative"><i class="fa-solid fa-house"></i></span>';
    $args['sep']                    = '<span class="separator" aria-label="breadcrumb separator">></span>';
    $args['prefix']                 = '<div class="breadcrumb"><span class="bc-wrap">';
    $args['suffix']                 = '</span></div>';
    $args['labels']['prefix']       = '';
    $args['labels']['date']         = '';
    $args['labels']['404']          = 'Not found';
    return $args;
}

/*
*Breadcrumbs Structure
*/
add_filter( 'genesis_single_crumb', __NAMESPACE__ . '\\site_add_blog_crumb', 10, 2 );
add_filter( 'genesis_archive_crumb', __NAMESPACE__ . '\\site_add_blog_crumb', 10, 2 );
function site_add_blog_crumb( $crumb, $args ) {
    $page_title = get_the_title();
    $archive_title = get_the_archive_title();
    
    if ( is_category() || is_archive() || is_single() ) {
        return '<span class="breadcrumb-link-wrap"><a href="https://arissatin-hub.github.io/portfolio/project/">' . 'Project' . '</a></span>' . $args['sep'] . ' ' . $page_title;
    } else {
        return $crumb;
    }
}

/*
*Remove breadcrumbs schema itemlist error
*/
add_filter( 'genesis_attr_breadcrumb-link-wrap', 'custom_schema_empty', 20 );
function custom_schema_empty( $attributes ){
    $attributes['itemtype'] = '';
    $attributes['itemprop'] = '';
    $attributes['itemscope'] = '';
    return $attributes;
}

/*
*Remove breadcrumbs link schema item error
*/
add_filter( 'genesis_breadcrumb_link', 'custom_link_markup', 10, 4 );
function custom_link_markup( $link, $url, $title, $content ) {
    $itemprop_item = '';
    $itemprop_name = '';

    $link = sprintf( '<a href="%s"%s>%s</a>', esc_attr( $url ), $title, $content );  
    return $link;
}

/*
*Pagination Preview Button
*/
add_filter( 'genesis_prev_link_text', 'modify_previous_link_text' );
function modify_previous_link_text($text) {
    $text = '<i class="fa fa-angle-double-left"></i>';
    return $text;
}

/*
*Pagination Next Button
*/
add_filter( 'genesis_next_link_text', 'modify_next_link_text' );
function modify_next_link_text($text) {
    $text = '<i class="fa fa-angle-double-right"></i>';
    return $text;
}

/*
*Move scripts to footer
*/
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );
function remove_head_scripts() { 
    remove_action('wp_head', 'wp_print_scripts'); 
    remove_action('wp_head', 'wp_print_head_scripts', 9); 
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5); 
}

/*
* Remove Some CSS in Homepage
*/
add_action( 'wp_enqueue_scripts', 'remove_css_homepage', 100 );
function remove_css_homepage()  { 
    if (is_home() || is_front_page()) {
        wp_dequeue_style('addtoany');
        wp_dequeue_style('review-style');
        wp_dequeue_style('widgetopts-styles');
    } 
}

/*
* Dashicon CSS not in Homepage
*/
add_action('wp_enqueue_scripts', 'load_dashicons');
function load_dashicons(){
    if ( !is_front_page() ) {
        wp_enqueue_style('dashicons');
    } 
}

/*
* Remove default google recaptcha script
*/
remove_action( 'wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', 20 );

/*
*Force full width content.
*/
add_filter( 'genesis_pre_get_option_site_layout', 'force_full_width' );
function force_full_width() {
    return 'full-width-content';
}

/*
*   SLMP Sitemap
*/
add_shortcode('slmp_sitemap', 'slmp_sitemap');
function slmp_sitemap( $atts ) {
     ob_start();
     $args = shortcode_atts( array(
            'echo' => '0',
            'title_li' => '',
            'exclude' => '',
            'items_wrap'      => '%3$s',
            'depth'           => 0,
        ), $atts );
        $html = wp_list_pages($args);
        echo '<ul class="html-sitemap">' . $html . '</ul>';
        return ob_get_clean();
    }

/*
*   Navigation
*/
add_shortcode('slmp_navigation', 'slmp_navigation');
function slmp_navigation( $atts, $content = null ) {
    ob_start();
        extract(shortcode_atts(array( 'menu'  => '' ), $atts));
        echo wp_nav_menu( array( 'menu' => $menu ));
    return ob_get_clean();
}

/*
* Enqueue Scripts
*/
add_action( 'wp_enqueue_scripts', 'my_custom_scripts_styles' );
function my_custom_scripts_styles() {
    $ss_dir = wp_upload_dir()["baseurl"];
    
    //Gutenberg Styles
    wp_enqueue_style( 
        'my-gutenberg-front-css', 
        $ss_dir . '/custom-design/gutenberg/front-end.css',
        '1.1.0', 
        'all'
    );
    //Animate CSS
    wp_enqueue_style( 
        'animate-css', 
        '//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css',
        '4.1.1', 
        'all'
    );
}

/*
* Gutenberg Admin Styles
*/
add_action('admin_enqueue_scripts',  'my_gutenberg_admin_enqueue_scripts');
function my_gutenberg_admin_enqueue_scripts() {
    $sss_dir = wp_upload_dir()["baseurl"];
    //Gutenberg Styles Admin
    wp_enqueue_style(
        'my-gutenberg-admin-css',
        $sss_dir . '/custom-design/gutenberg/style-editor.css',
        '1.0.0',
        'all'
    );
    //Custom ACF Admin Js
    wp_enqueue_script( 
        'custom-admin-js', 
        $sss_dir . '/custom-design/js/custom-script.js', 
        array( 'jquery' ), 
        '1.0.0',
        true
    );
}

/**
* Post Type: Portfolios.
*/
add_action( 'init', 'my_cpts_portfolio' );
function my_cpts_portfolio() {

    $labels = [
        "name"              => esc_html__( "Projects", "project" ),
        "singular_name"     => esc_html__( "Projects", "project" ),
    ];

    $args = [
        "label"                 => esc_html__( "Projects", "project" ),
        "labels"                => $labels,
        "description"           => "",
        "public"                => true,
        "publicly_queryable"    => true,
        "show_ui"               => true,
        "show_in_rest"          => true,
        "rest_base"             => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace"        => "wp/v2",
        "has_archive"           => true,
        "show_in_menu"          => true,
        "show_in_nav_menus"     => true,
        "delete_with_user"      => false,
        "exclude_from_search"   => false,
        "capability_type"       => "post",
        "map_meta_cap"          => true,
        "hierarchical"          => true,
        "can_export"            => true,
        "rewrite"               => [ "slug" => "projects", "with_front" => true ],
        "query_var"             => true,
        "menu_icon"             => "dashicons-portfolio",
        "supports"              => [ "title", "thumbnail" ],
        "show_in_graphql"       => false,
    ];

    register_post_type( "portfolio", $args );
}