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
  <div id="container" style="background-image: url('<?php echo get_custom("background_image"); ?>');">

    <?php include_once 'nav-top.php'; ?>
