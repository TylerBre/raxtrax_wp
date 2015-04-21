<?php /* Template Name: Cart Page */  ?>

<?php include_once 'header-commerce.php'; ?>



<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php the_content(); ?>
<?php endwhile; endif; ?>
<?php include_once 'footer-commerce.php'; ?>
