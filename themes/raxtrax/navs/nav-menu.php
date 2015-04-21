<div id="jsNavMenu" class="container">
    <a href="/" class="logo">
        <img src="<?php bloginfo("template_url"); ?>/img/vector/logo-black.svg" alt="John Splithoff" height="40">
    </a>
    <?php
    $args = array(
        'theme_location'  => '',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul class="row">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
    );
    wp_nav_menu( $args ); ?>
</div>