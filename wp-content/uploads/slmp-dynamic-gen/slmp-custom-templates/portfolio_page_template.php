<?php
/*
 * Template Name: Portfolio Template
*/
?>


<?php
add_action( 'genesis_entry_content', 'custom_blog_loop', 11 );
function custom_blog_loop() {
    if ( 1 >= get_query_var( 'paged' ) ) {
        add_action( 'genesis_loop', 'genesis_standard_loop', 6 );
    }
    global $post;

    $args = wp_parse_args(
        genesis_get_custom_field( 'query_args' ),
        array(
        'post_type'   => 'portfolio',
        'post_status' => 'publish',
        'paged'       => get_query_var( 'paged' ) )
    );

    global $wp_query;
        $wp_query = new WP_Query( $args );

    if ( have_posts() ) : ?>
    <div class="portfolio-section portfolio-archive-container relative">
        <div class="portfolio-items site-flex justify-content-center relative"> 
        <?php
            while ( have_posts() ) : the_post();
                $thumbnail_id       = get_post_thumbnail_id($post->ID);
                $post_image         = wp_get_attachment_image_src($thumbnail_id, 'full');
                $link               = get_permalink();
        ?>  
            <article class="<?php echo implode (' ', get_post_class('col-3 porfolio-item animate__animated hide-element relative') ) ?>">
                <div class="project-img relative">
                    <img src="<?php echo $post_image[0] ?>" alt="Thumbnail" title="Thumbnail">
                    <a href="<?php echo $link ?>" target="_self">View Project</a>
                </div>
            </article>
        <?php endwhile; ?>
        </div>
    <?php echo genesis_posts_nav();?>
    </div>
    <?php
    remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
    do_action( 'genesis_after_endwhile' );
    endif;

    wp_reset_query();
}

genesis();