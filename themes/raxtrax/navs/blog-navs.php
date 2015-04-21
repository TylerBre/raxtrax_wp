<?php
$newspage = get_page_by_path("news");
$header_bg = get_field("header_background_image", $newspage->ID); ?>

<!-- NAVIGATION -->
<header class="header-wrapper" style="background-image: url(<?php echo $header_bg['sizes']['large']; ?>);">
    <div class="topbar aux-menu on-dark hidden-xs">
        <?php require_once("aux-menu.php"); ?>
    </div>
    <nav class="topbar nav-menu hidden-xs" role="navigation">
        <?php require_once("nav-menu.php"); ?>
    </nav>
</header>