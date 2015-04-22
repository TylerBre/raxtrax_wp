<?php /* Template Name: Checkout Page */ ?>

<?php get_header( 'shop' ); ?>

<div class="container store">
  <section class="head">
    <h1>Checkout</h1>
    <div class="inset-shadow"></div>
  </section>
  <section class="scrollable-content nano">
    <div class="content">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    <div class="clearfix"></div>
    </div>
  </section>
</div>
<?php get_footer( 'shop' ); ?>
