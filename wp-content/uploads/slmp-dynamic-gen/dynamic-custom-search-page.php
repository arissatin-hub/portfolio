<?php
/**
 * Genesis Custom Search Result
 */
function result_custom_loop() {
    
    global $post;
    $post_types = array( 'page', 'post' );
    $s = isset( $_GET["s"] ) ? $_GET["s"] : "";
    $exclude_pages      = get_field('pages_options', 'option')['exclude_search_result'];
    
    $args = array(
        'post_type'      => $post_types,
        'post__not_in'   => $exclude_pages,
        's'              => $s,
        'post_status'    => 'publish',
        'order'          => 'ASC',
        'orderby'        => 'title',
        'paged'          => get_query_var( 'paged' )
    );

    global $wp_query;
    $wp_query = new WP_Query( $args ) ?>

    <div class="search-content relative">
    <header class="entry-header"></header>
    <h1 class="archive-title">Search Results for: <?php echo $_GET["s"] ?></h1>
    <?php if ( have_posts() ) : ?>
        <div class="search-result relative">
        <?php while ( have_posts() ) : the_post();
            $content            = get_the_content(''); 
            $regex              = ['/\[sfs(.*?)\]/s', '/\[slmp(.*?)\]/s', '/\[contact-form-7(.*?)\]/s', '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#'];
            $content            = preg_replace($regex,'', $content);
            $excerpt_word_count = 25;
            $excerpt_end        = '';
            $excerpt_length     = apply_filters('excerpt_length', $excerpt_word_count);
            $excerpt_more       = apply_filters('excerpt_more', '... ' . $excerpt_end);
            $excerpt            = wp_trim_words( $content, $excerpt_length, $excerpt_more );
        ?>
            <article class="<?php echo implode (' ', get_post_class('search-result-item relative') ) ?>">
                <div class="search-result-title sec-font bold">
                    <a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a>
                </div>
                <div class="search-result-excerpt">
                    <p><?php echo do_shortcode(force_balance_tags($excerpt)) ?> <a class="more-link" href="<?php echo get_permalink() ?>">Continue Reading</a></p>
                </div>
            </article>
        <?php endwhile ?>
        <?php do_action( 'genesis_after_endwhile' ) ?>
        </div>
    <?php else : ?>
        <div class="search-result">
            <article class="no-result-search">
                <div class="result-search text-center">
                    <img loading="lazy" src="/wp-content/themes/slmp-genesis-child/dist/images/no-result-found.png" alt="No Result" title="No Result">
                </div>
                <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                    <label>
                        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                        <input type="search" class="search-field"
                            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
                            value="<?php echo get_search_query() ?>" name="s"
                            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                    </label>
                    <input type="submit" class="search-submit"
                        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
                </form>
            </article>
        </div>
    <?php endif ?>
    </div>
    <?php wp_reset_query();
}
add_action( 'genesis_loop', 'result_custom_loop' );
remove_action( 'genesis_loop', 'genesis_do_loop' );
genesis();