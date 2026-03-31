<?php
/**
 * Build Custom Hook Boxes.
 *
 * @package Dynamik
 */


/* Name: Site Font */
add_action( 'wp_head', 'site_font', 10 );
function site_font(){
	site_font_hook_content();
}

function site_font_hook_content(){ ?>
<link rel="stylesheet" href="//use.fontawesome.com/releases/v7.1.0/css/all.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <noscript rel="stylesheet"
    href="//use.fontawesome.com/releases/v7.1.0/css/all.css" />
</noscript>
<?php
}


/* Name: Site Header */
add_action( 'genesis_header', 'site_header', 10 );
function site_header(){
	site_header_hook_content();
}

function site_header_hook_content(){ ?>
<?php
    $gen_opt        = get_field('general_option', 'option');
    $hdr_opt        = get_field('header_options', 'option');
?>

<!-- Site Header Section -->
<header class="site-header fadeInDown relative">
    <div class="header-row hrd-layer relative">
        <div class="inner-width relative">
            <div class="hrd-col site-flex justify-content relative">
                <div class="site-logo relative">
                    <a class="main-logo relative" href="<?php echo get_bloginfo( 'url' ) ?>">
                        <img loading="lazy" src="<?php echo $gen_opt['site_logo']['url'] ?>" alt="<?php echo $gen_opt['site_logo']['alt'] ?>" title="<?php echo $gen_opt['site_logo']['title'] ?>" width="auto" height="auto"/>
                    </a>
                </div>
                <div class="site-details">
                    <div class="site-cta text-right relative">
                        <div class="site-info site-email medium relative">
                            <a href="mailto:<?php echo $gen_opt['site_email'] ?>"><?php echo $gen_opt['site_email'] ?></a>
                        </div>
                    </div>
                    <div class="site-menu"><?php echo genesis_do_nav() ?></div>
                </div>
            </div>
        </div> 
    </div>
</header>
<?php
}


/* Name: Site Page Banner */
add_action( 'genesis_after_header', 'site_page_banner', 10 );
function site_page_banner(){
	site_page_banner_hook_content();
}

function site_page_banner_hook_content(){ ?>
<?php if(!is_front_page()){ ?>
<?php
    $banner                 = get_field('pages_options', 'option');
    $df_page_banner         = $banner['default_page_banner'];
    $df_post_banner         = $banner['default_post_banner'];
    $page_banner            = get_field('page_banner', get_the_ID());
    $new_page_banner        = ( $page_banner ? $page_banner['url'] : $df_page_banner['url'] );
?>

<!-- Site Page Banner -->
<section class="site-section page-banner relative">
    <div class="inner-page-banner relative">
        <div class="page-banner-container relative">
        <?php if ( is_single() || is_archive() || is_category() ): ?>
            <div class="banner-bg background-image relative" style="background-image: url('<?php echo $df_post_banner['url'] ?>')">
        <?php elseif ( is_search() && isset($_GET['s']) ) : ?>
            <div class="banner-bg background-image relative" style="background-image: url('<?php echo $df_page_banner['url'] ?>')">
        <?php else : ?>
            <div class="banner-bg background-image relative" style="background-image: url('<?php echo $new_page_banner ?>')">
        <?php endif ?>
                <div class="inner-width relative">
                    <div class="banner-details site-flex justify-content-bottom-center relative">
                        <div class="page-title-container animate__animated hide-element text-center relative">
                            <?php if (is_archive()) : ?>
                                <div class="page-title bold uppercase relative"><?php echo get_the_archive_title() ?></div>
                            <?php elseif ( is_404() ) : ?>
                                <div class="page-title bold uppercase relative">Page Not Found</div>
                            <?php elseif ( is_singular('post') ) : ?>
                                <div class="page-title bold uppercase relative">Blog</div>
                            <?php elseif ( is_search() ) : ?>
                                <div class="page-title bold uppercase relative">Search Result</div>
                            <?php else : ?>
                                <div class="page-title bold uppercase relative"><?php echo get_the_title() ?></div>
                            <?php endif ?>
                            <div class="site-breadcrumbs"><?php echo genesis_breadcrumb() ?></div>
                        </div>
                    </div> 
                </div>      
            </div>
        </div>
    </div>
</section>
<?php
}
}


/* Name: Site Hero */
add_action( 'genesis_after_header', 'site_hero', 10 );
function site_hero(){
	site_hero_hook_content();
}

function site_hero_hook_content(){ ?>
<?php if(is_front_page()){ ?>
<?php
    $hero_opt       = get_field('hero_option', 'option');
?>

<!-- Hero Section -->
<section class="full-width-section hero-section relative">
    <div class="hero-bg background-image" style="background-image: url('<?php echo $hero_opt['background_image']['url'] ?>')"></div>
    <div class="inner-width relative">
        <div class="hero-row site-flex justify-content relative">
            <div class="hero-col hero-caption col-2 relative">
                <?php if ( $hero_opt['details']['label_1'] ): ?>
                    <div class="hr-lbl-s hr-label-1 uppercase relative"><?php echo $hero_opt['details']['label_1'] ?></div>
                <?php endif ?>
                <?php if ( $hero_opt['details']['label_2'] ): ?>
                    <div class="hr-lbl-b hr-label-2 semi-bold relative">
                        <h1><?php echo $hero_opt['details']['label_2'] ?></h1>
                    </div>
                <?php endif ?>
                <?php if ( $hero_opt['details']['label_3'] ): ?>
                    <div class="hr-lbl-b hr-label-3 semi-bold relative"><?php echo $hero_opt['details']['label_3'] ?></div>
                <?php endif ?>
                <?php if ( $hero_opt['details']['label_4'] ): ?>
                    <div class="hr-lbl-b hr-label-4 semi-bold relative"><?php echo $hero_opt['details']['label_4'] ?></div>
                <?php endif ?>
                <div class="hero-btn relative">
                    <?php if ( $hero_opt['button_1'] ): ?>
                        <a class="button" href="<?php echo $hero_opt['button_1'] ?>" target="_self">
                            <span>See Portfolio</span>
                        </a>
                    <?php endif ?>
                    <?php if ( $hero_opt['button_2'] ): ?>
                        <a class="button" href="<?php echo $hero_opt['button_2'] ?>" target="_self">
                            <span>Contact Me</span>
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <?php if ( $hero_opt['image'] ): ?>
                <div class="hero-col hero-img col-2 relative">
                    <div class="hr-img animate__animated hide-element relative">
                        <img src="<?php echo $hero_opt['image']['url'] ?>" alt="<?php echo $hero_opt['image']['alt'] ?>" title="<?php echo $hero_opt['image']['title'] ?>">
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>
<?php
}
}


/* Name: Site About */
add_action( 'genesis_before_content_sidebar_wrap', 'site_about', 10 );
function site_about(){
	site_about_hook_content();
}

function site_about_hook_content(){ ?>
<?php if(is_front_page()){ ?>
<?php
    $about_opt       = get_field('about_options', 'option');
?>

<!-- About Section -->
<section class="full-width-section about-section relative">
    <div class="site-section site-about top-bot-padding relative">
        <div class="inner-width relative">
            <div class="about-row site-flex justify-content relative">
                <?php if ( $about_opt['image'] ): ?>
                    <div class="about-col about-left animate__animated hide-element col-3-12 relative">
                        <img src="<?php echo $about_opt['image']['url'] ?>" alt="<?php echo $about_opt['image']['alt'] ?>" title="<?php echo $about_opt['image']['title'] ?>">
                    </div>
                <?php endif ?>
                <div class="about-col about-right animate__animated hide-element col-9-12 relative">
                    <?php if ( $about_opt['sub_heading'] ): ?>
                        <div class="section-sub-heading uppercase relative"><?php echo $about_opt['sub_heading'] ?></div>
                    <?php endif ?>
                    <?php if (  $about_opt['heading'] ): ?>
                        <div class="section-heading bold relative"><?php echo $about_opt['heading'] ?></div>
                    <?php endif ?>
                    <?php if (  $about_opt['description'] ): ?>
                        <div class="section-desc c-white relative"><?php echo $about_opt['description'] ?></div>
                    <?php endif ?>
                    <?php if ( $about_opt['button'] ): ?>
                        <div class="section-btn relative">
                            <a class="button" href="<?php echo $about_opt['button'] ?>" target="_self">
                                <span>Read More</span>
                            </a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
}


/* Name: Site Portfolio */
add_action( 'genesis_before_footer', 'site_portfolio', 10 );
function site_portfolio(){
	site_portfolio_hook_content();
}

function site_portfolio_hook_content(){ ?>
<?php if(is_front_page()){ ?>
<?php
    $port_opt               = get_field('portfolio_options', 'option');
    $portfolio_posts        = get_posts(['post_type' => 'portfolio', 'numberposts' => 6, 'post_status' => 'publish', 'orderby' => 'post_date']);
?>

<!-- Portfolio Section -->
<section class="full-width-section portfolio-section relative">
    <div class="portfolio-bg background-image" style="background-image: url('<?php echo $port_opt['background_image']['url'] ?>')"></div>
    <div class="site-section site-portfolio top-bot-padding relative">
        <div class="inner-width relative">
            <div class="heading-wrap text-center relative">
                <?php if ( $port_opt['sub_heading'] ): ?>
                    <div class="section-sub-heading uppercase relative"><?php echo $port_opt['sub_heading'] ?></div>
                <?php endif ?>
                <?php if (  $port_opt['heading'] ): ?>
                    <div class="section-heading bold relative"><?php echo $port_opt['heading'] ?></div>
                <?php endif ?>
                <?php if (  $port_opt['description'] ): ?>
                    <div class="section-desc c-white relative"><?php echo $port_opt['description'] ?></div>
                <?php endif ?>
            </div>
            <?php if ( $portfolio_posts ): ?>
                <div class="portfolio-items site-flex justify-content-center relative">
                    <?php foreach ( $portfolio_posts as $post ):
                        $thumbnail_id  = get_post_thumbnail_id($post->ID);
                        $post_image     = wp_get_attachment_image_src($thumbnail_id, 'full');
                        $link           = get_permalink($post->ID);
                    ?>
                        <div class="col-3 porfolio-item animate__animated hide-element relative">
                            <div class="project-img relative">
                                <img src="<?php echo $post_image[0] ?>" alt="Thumbnail" title="Thumbnail">
                                <a href="<?php echo $link ?>" target="_self">View Project</a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <?php if ( $port_opt['button'] ): ?>
                <div class="section-btn text-center relative">
                    <a class="button" href="<?php echo $port_opt['button'] ?>" target="_self">
                        <span>View More</span>
                    </a>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>
<?php
}
}


/* Name: Site Contact */
add_action( 'genesis_before_footer', 'site_contact', 10 );
function site_contact(){
	site_contact_hook_content();
}

function site_contact_hook_content(){ ?>
<?php if(!is_page(array(13))){ ?>
<?php
    $contact_opt               = get_field('cta_options', 'option');
?>

<!-- Contact Section -->
<section class="full-width-section contact-section relative"></div>
    <div class="site-section site-contact top-bot-padding relative">
        <div class="inner-width relative">
            <div class="heading-wrap text-center relative">
                <?php if ( $contact_opt['sub_heading'] ): ?>
                    <div class="section-sub-heading uppercase relative"><?php echo $contact_opt['sub_heading'] ?></div>
                <?php endif ?>
                <?php if (  $contact_opt['heading'] ): ?>
                    <div class="section-heading bold relative"><?php echo $contact_opt['heading'] ?></div>
                <?php endif ?>
                <?php if (  $contact_opt['description'] ): ?>
                    <div class="section-desc c-white relative"><?php echo $contact_opt['description'] ?></div>
                <?php endif ?>
            </div>
            <?php if ( $contact_opt['button'] ): ?>
                <div class="section-btn text-center relative">
                    <a class="button" href="<?php echo $contact_opt['button'] ?>" target="_self">
                        <span>Contact Me</span>
                    </a>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>
<?php
}
}


/* Name: Site Footer */
add_action( 'genesis_footer', 'site_footer', 10 );
function site_footer(){
	site_footer_hook_content();
}

function site_footer_hook_content(){ ?>
<?php
    $footer_opt               = get_field('footer_options', 'option');
?>

<!-- Footer Section -->
<footer class="site-footer relative">
    <div class="footer-bg background-image" style="background-image: url('<?php echo $footer_opt['background_image']['url'] ?>')"></div>
    <div class="footer-wrap relative">
        <div class="inner-width relative">
            <div class="footer-menu relative"><?php echo do_shortcode('[slmp_navigation menu="4"]') ?></div>
        </div>
    </div>  
</footer>
<?php
}


