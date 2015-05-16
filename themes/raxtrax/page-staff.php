<?php /* Template Name: Staff Page */
get_header(); ?>

<?php
  $pageID = get_the_ID();

  $staffs = new WP_Query(array(
    'post_type' => array('staff')
  ));
  $staffs = $staffs->posts;
?>

<div class="container staff">
  <section class="head">
    <h1><?php the_field('sub_header'); ?><span> - <small><?php the_field('disclaimer'); ?></small></span></h1>
    <div class="inset-shadow"></div>
    <b></b>
  </section>
  <section class="scrollable-content nano no-mobi">
    <div class="content">
    <?php foreach ($staffs as $staff) : ?>
      <div class="col staff">
        <div class="col col1">
          <div class="static staff">
            <?php $image = get_field('image', $staff->ID); ?>
            <div style="background-image: url('<?php echo $image['url']; ?>');">
              <img src="<?php echo $image['url']; ?>" width="202" style="visibility:hidden;">
            </div>
          </div>
        </div>
        <div class="col col2">
          <h2><strong><?php echo $staff->post_title; ?></strong> - <small><?php echo strtoupper(get_field('position', $staff->ID)); ?></small></h2>
          <p><?php echo $staff->post_content; ?></p>
        </div>
        <div class="border horizontal"></div>
      </div>
    <?php endforeach; ?>
      <div class="clearfix"></div>
    </div>
  </section>

  <!-- mobile staff -->
  <section class="scrollable-content mobi">
  <?php foreach ($staffs as $staff) : ?>
    <?php $image = get_field('image', $staff->ID); ?>
    <div class="col staff">
      <div class="col col2">
        <h2><strong><?php echo $staff->post_title; ?></strong> - <small><?php echo strtoupper(get_field('position', $staff->ID)); ?></small></h2>

        <div class="static mobi">
          <div style="background-image: url('<?php echo $image['url']; ?>');">
            <img src="<?php echo $image['url']; ?>" width="100%">
          </div>
        </div>
        <p><?php echo $staff->post_content; ?></p>
      </div>
      <div class="border horizontal"></div>
    </div>
  <?php endforeach; ?>
    <div class="clearfix"></div>
  </section>
</div>

<?php get_footer(); ?>
