<?php $homepage = get_page_by_path("home-page"); ?>

<div class="container">
    <a href="/" class="logo">
        <img src="<?php bloginfo("template_url"); ?>/img/vector/logo.svg" alt="John Splithoff" height="40">
    </a>
    <div class="row">
        <div class="col-sm-6">
            <?php foreach (get_field("captions", $homepage->ID) as $i => $caption) : ?>
                <p class="caption uppercase hidden-sm hidden-xs <?php if ($i == 0) echo "active"; ?>"><?php echo $caption['caption']; ?></p>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-6 audio-player-column">
            <div class="pull-right">
                <?php
                $args = array(
                    'theme_location'  => '',
                    'menu'            => 3,
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
                    'items_wrap'      => '<ul>%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                );

                wp_nav_menu( $args ); ?>

                <?php require_once("audio-widget.php"); ?>
            </div>
        </div>
    </div>
</div>