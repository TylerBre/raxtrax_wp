<header class="topbar navbar navbar-inverse navbar-fixed-top visible-xs" role="banner">
  <div class="navbar-header">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a href="/" class="navbar-brand">
      <img src="<?php bloginfo("template_url"); ?>/img/vector/logo.svg" alt="John Splithoff" height="23">
    </a>
  </div>
  <div class="container">
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
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
          'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
          'depth'           => 0,
          'walker'          => ''
      );
      wp_nav_menu( $args ); ?>
    </nav>
  </div>
</header>