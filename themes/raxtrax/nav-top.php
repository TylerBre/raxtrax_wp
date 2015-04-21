<!-- HEADER -->
<header>
  <img id="mobile-logo" class="mobi inline-block" src="<?php bloginfo("template_url"); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" width="100%">
  <div id="links-container">
    <div id="contact-container">
      <a href="<?php bloginfo("url"); ?>" id="logo" class="no-mobi"><em><?php bloginfo('name'); ?></em></a>
      <div class="first">
        <a href="<?php echo get_custom("map_url"); ?>" target="_blank"><?php echo strtoupper(get_custom("address_1")); ?>
          <div class="location-icon mobi"></div>
          <span class="mobi inline"><?php echo strtoupper(get_custom("address_2")); ?></span>
        </a>
      </div>
      <b class="border no-mobi"></b>
      <div class="no-mobi"><?php echo strtoupper(get_custom("address_2")); ?></div>
      <b class="border no-mobi"></b>
      <div class="contact-links">
        <a href="tel:<?php echo get_custom("contact_number"); ?>">
          <div class="phone-icon mobi"></div>
          <span><?php echo get_custom("contact_number"); ?></span>
        </a>
      </div>
      <b class="border"></b>
      <div class="contact-links last">
        <a href="mailto:<?php echo get_custom("contact_email"); ?>">
          <div class="letter-icon mobi"></div>
          <span class="no-mobi"><?php echo strtoupper(get_custom("contact_email")); ?></span>
          <span class="mobi">CONTACT US</span>
        </a>
      </div>
    </div>
    <div id="nav-links-container" class="no-mobi">
      <a href="<?php bloginfo("url"); ?>" class="home first">HOME</a>
      <b class="border"></b>
      <a href="<?php bloginfo("url"); ?>/gallery" class="image-gallery-link">IMAGES</a>
      <b class="border"></b>
      <a href="<?php bloginfo("url"); ?>/audio_player" class="login-link last" onclick="window.open(this.href, 'detour_share_twitter', 'width=422,height=500'); return false;">SOUNDS</a>
    </div>
    <div class="clearfix"></div>
  </div>
</header>
