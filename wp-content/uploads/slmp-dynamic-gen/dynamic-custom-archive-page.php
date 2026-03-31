<?php
remove_action( 'genesis_loop', 'genesis_do_loop' );
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

function sfl_post_info_filter($post_info) {
  $post_info = '<i class="icon icon-calendar"></i><time class="entry-time"></time> <span class="author-wrap"><i class="icon icon-person"></i></span>';
  return $post_info;
}
add_filter( 'genesis_post_info', 'sfl_post_info_filter' );
function sfl_archive_custom_loop() {
    global $post;

    if ( have_posts() ) : ?>
        <header class="entry-header">
            <h1 class="entry-title" itemprop="headline">Projects</h1>
            <p>I believe every website should solve a specific problem. In the list below, you’ll see how I’ve tackled various challenges—whether it was optimizing a checkout flow for better conversions of design. These projects showcase my ability to balance technical complexity with intuitive design.</p>
        </header>
        <div class="portfolio-section portfolio-archive-container relative">
            <div class="portfolio-items site-flex justify-content-center relative"> 
           <?php  
        do_action( 'genesis_before_while' );     
            $count=0;
        while ( have_posts() ) : the_post();
            do_action( 'genesis_before_entry' );
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
            <?php do_action( 'genesis_after_entry' ) ?>
            <?php endwhile ?>
            </div>
        <?php echo genesis_posts_nav() ?>
        </div>
        <?php
        remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
        do_action( 'genesis_after_endwhile' );
    else :
        do_action( 'genesis_loop_else' );
    endif;
}
add_action( 'genesis_loop', 'sfl_archive_custom_loop' );
genesis();