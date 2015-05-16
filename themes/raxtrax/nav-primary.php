<div id="navigation">
  <!-- NAVIGATION -->
  <nav>
    <a href="<?php bloginfo("url"); ?>/studios" class="studios first <?php if ($current_page == 'studios') echo 'active'; ?>">
      <div class="image mobi"></div>
      <div class="text">Studios</div>
    </a>
    <a href="<?php bloginfo("url"); ?>/gear" class="gear <?php if ($current_page == 'gear') echo 'active'; ?>">
      <div class="image mobi"></div>
      <div class="text">Gear</div>
    </a>
    <a href="<?php bloginfo("url"); ?>/staff" class="staff <?php if ($current_page == 'staff') echo 'active'; ?>">
      <div class="image mobi"></div>
      <div class="text">Staff</div>
    </a>
    <a href="<?php bloginfo("url"); ?>/clients" class="clients <?php if ($current_page == 'clients') echo 'active'; ?>">
      <div class="image mobi"></div>
      <div class="text">Clients</div>
    </a>
    <a href="<?php bloginfo("url"); ?>/store" class="store last <?php if ($current_page == 'store' || $current_page == '') echo 'active'; ?>">
      <div class="image mobi"></div>
      <div class="text">Store</div>
    </a>
<!--     <a href="<?php bloginfo("url"); ?>/blackspade_acoustics" class="blackspade last <?php if ($current_page == 'blackspade_acoustics') echo 'active'; ?>">
      <div class="image mobi"></div>
      <div class="text">Blackspade <span class="no-mobi">Acoustics</span></div>
    </a> -->
    <div class="clearfix"></div>
  </nav>

  <!-- PAGE DESCRIPTIONS -->
  <section id="page-description">
    <div class="description">
      <h1><?php the_field('sub_heading'); ?></h1>
      <p class="no-mobi"><?php the_field('text'); ?></p>
    </div>
  </section>
</div>
