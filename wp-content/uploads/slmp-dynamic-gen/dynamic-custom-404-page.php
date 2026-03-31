<?php
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'genesis_404' );
function genesis_404() {
    $all_posts       = get_posts(['post_type' => 'post', 'post_per_page' => '-1', 'post_status' => 'publish', 'orderby' => 'post_date']);
?>
    <div class="post hentry">
        <h1 class="entry-title"><?php _e( 'Not Found, Error 404', 'genesis' ); ?></h1>
        <div class="entry-content">
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
            <p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), home_url() ); ?></p>
            <div class="archive-page">
                <h4><?php _e( 'Pages:', 'genesis' ); ?></h4>
                <ul>
                    <?php
                        $pages = get_pages();
                        $exclude = array();
                        $exclude_pages      = get_field('pages_options', 'option')['exclude_page_404'];
                        if ( $exclude_pages ) {
                            foreach ( $exclude_pages as $xpage ) {
                                $posts          = get_post($xpage);
                                $exclude[]        = $posts->ID;
                            }
                        }
                        wp_list_pages( 'title_li=&exclude=' . implode( ',' , $exclude ) );
                    ?>
                </ul>
            </div>
            <?php if ( $all_posts ): ?>
                <div class="archive-page">
                    <h4><?php _e( 'Categories:', 'genesis' ); ?></h4>
                    <ul>
                        <?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
                    </ul>
                    <h4><?php _e( 'Authors:', 'genesis' ); ?></h4>
                    <ul>
                        <?php wp_list_authors( 'genesis' ); ?>
                    </ul>
                    <h4><?php _e( 'Monthly:', 'genesis' ); ?></h4>
                    <ul>
                        <?php wp_get_archives( 'type=monthly' ); ?>
                    </ul>
                    <h4><?php _e( 'Recent Posts:', 'genesis' ); ?></h4>
                    <ul>
                        <?php wp_get_archives( 'type=postbypost&limit=100' ); ?>
                    </ul>
                </div> 
            <?php endif ?>
        </div>
    </div>
<?php
}
genesis();