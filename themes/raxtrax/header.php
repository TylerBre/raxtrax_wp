<?php $current_page = $pagename; ?>
<!doctype html>

<html lang="en-US">
<head>
  <meta charset "utf-8">
  <title><?php bloginfo('name'); ?></title>

  <meta name="description" content="<?php bloginfo('description'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!-- <meta name="keywords" content="<?php echo get_custom("meta"); ?>"> -->
  <meta name="author" content="RaxTrax Recoding">

  <!-- share meta -->
  <meta property="og:title"          content="<?php bloginfo('name'); ?>">
  <meta property="og:type"           content="website">
  <meta property="og:url"            content="http://raxtrax.com">

  <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/style.css">

  <?php wp_head(); ?>
</head>
<body>
  <?php if ($current_page == 'gallery') : ?>
    <div id="container" class='gallery'>
  <?php else : ?>
    <div id="container" style="background-image: url('<?php echo get_custom("background_image"); ?>');">
  <?php endif; ?>

    <?php include_once 'nav-top.php'; ?>

    <!-- Cart Tab -->
    <?php $cart = WC()->cart->get_cart(); $cart_count = 0; ?>
    <?php foreach ($cart as $cart_item) { $cart_count += $cart_item['quantity']; } ?>
    <?php if ($cart_count > 0): ?>
      <div id="cart-container">
        <div class="cart-tab">
          <a href="<?php bloginfo("url"); ?>/cart" class="cart-icon">
            <b><?php echo $cart_count; ?></b>
            My Cart
          </a>
        </div>
      </div>
    <?php endif; ?>

    <b id="header-gradient" class="no-mobi"></b>

    <?php include_once 'nav-primary.php'; ?>

    <!-- PAGE CONTENT -->
    <section id="content">
