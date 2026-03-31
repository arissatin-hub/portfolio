<?php

add_action( 'genesis_entry_content', 'portfolio_layout', 8 );
function portfolio_layout() {

    $id             = get_the_ID();
    $field_value    = get_field('portfolio_details', $id);
    $content_url    = content_url();

    if ( is_single() ) { ?>
        <div class="post-layout relative">
            <div class="ptf-layout layout-desktop">
                <div class="desk-image-wrap relative">
                    <div class="desk-monitor relative">
                        <div class="desk-monitor-head relative">
                            <img src="<?php echo $content_url. '/uploads/2026/02/top-laptop-image.webp'?>" alt="Top Laptop" title="Top Laptop">
                        </div>
                        <div class="desk-monitor-screen relative">
                            <div class="desk-monitor-screen-image">
                                <img src="<?php echo $field_value['desktop_view']['url'] ?>" alt="<?php echo $field_value['desktop_view']['alt'] ?>" title="<?php echo $field_value['desktop_view']['title'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="laptop-keyboard relative">
                        <img src="<?php echo $content_url. '/uploads/2026/02/bottom-laptop-image.webp'?>" alt="Bottom Laptop" title="Bottom Laptop">
                    </div>
                </div>
            </div>
            <div class="ptf-layout layout-mobile">
                <div class="mob-image-wrap relative">
                    <div class="mob-view relative" style="background-image: url('<?php echo $content_url. '/uploads/2026/02/Mobile-View-Body.webp'?>')">
                        <div class="mob-view-screen relative">
                            <div class="mob-view-screen-image relative">
                                <img src="<?php echo $field_value['mobile_view']['url'] ?>" alt="<?php echo $field_value['mobile_view']['alt'] ?>" title="<?php echo $field_value['mobile_view']['title'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-btn relative">
                <div class="section-btn relative">
                    <a class="button" href="<?php echo $field_value['live_site_url'] ?>" target="__blank">
                        <span>View Live Site</span>
                    </a>
                </div>
            </div>
        </div>
    <?php }
}

genesis();