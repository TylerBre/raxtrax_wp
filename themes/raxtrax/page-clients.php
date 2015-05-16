<?php /* Template Name: Clients Page */
get_header(); ?>

<?php
  $clients = new WP_Query(array(
    'post_type' => array('client'),
    'orderby' => 'title',
    'order' => 'ASC'
  ));
  $clients = $clients->posts;
  $featured_clients = array_filter(array_map(function ($item) {
    if (get_field('important', $item->ID)) return $item;
  }, $clients));

  $even = $odd = array();

  foreach ($clients as $index => $client) {
    if ($index % 2 == 0) {
      $even[] = $client;
    } else {
      $odd[] = $client;
    }
  }
?>

<div class="container clients">
  <div class="col col1 split no-mobi">
    <section class="head">
      <h1><span>Complete List</span></h1>
      <div class="inset-shadow"></div>
      <b></b>
    </section>
    <section class="scrollable-content nano">
      <div class="content">
        <table style="margin-top: 15px;">
        <?php foreach ($clients as $client) : ?>
          <?php $website = get_field('website', $client->ID); ?>
          <?php if ($website) : ?>
          <tr>
            <td><a href="<?php echo $website; ?>" target="_blank"><?php echo $client->post_title; ?></a></td>
          </tr>
          <?php else : ?>
          <tr>
            <td><?php echo $client->post_title; ?></td>
          </tr>
          <?php endif; ?>
        <?php endforeach; ?>
        </table>
      </div>
    </section>
  </div>

  <div class="border vertical no-mobi"></div>

  <div class="col col2 split no-mobi">
    <section class="head">
      <h1><?php the_field('sub_header'); ?></h1>
      <div class="inset-shadow"></div>
      <b></b>
    </section>
    <section class="scrollable-content nano">
      <div class="content">
        <article>
          <section class="client-gallery">
            <div id="slider1" class="multiple">
            <?php foreach ($featured_clients as $client) : ?>
              <?php $image = get_field('image', $client->ID); ?>
              <?php if($image): ?>
                <div style="background-image: url('<?php echo $image['url']; ?>');">
                  <img src="<?php echo $image['url']; ?>" width="145" style="visibility:hidden;" />
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
            </div>
          </section>
          <section class="client-featured-container">
          <?php foreach ($featured_clients as $index => $client) : ?>
            <?php $website = get_field('website', $client->ID); ?>
            <?php if ($website) : ?>
              <a href="<?php echo $website; ?>" target="_blank" class="featured-client link"><?php echo $client->post_title; ?></a>
            <?php else : ?>
              <span class="featured-client"><?php echo $client->post_title; ?></span>
            <?php endif; ?>
            <?php if (sizeof($featured_clients) != $index): ?>
              <span class="comma">,&nbsp;</span>
            <?php endif; ?>
          <?php endforeach; ?>
          </section>
        </article>
      </div>
    </section>
  </div>

  <!-- mobile clients -->

  <div class="col mobi">
    <section class="head">
      <h1><?php the_field('sub_header'); ?></h1>
      <div class="inset-shadow"></div>
      <b></b>
    </section>
    <section class="scrollable-content">

      <div class="list-column left">
        <table>
        <?php foreach ($even as $client) : ?>
          <?php $website = get_field('website', $client->ID); ?>
          <?php if ($website) : ?>
          <tr>
            <td><a href="<?php echo $website; ?>" target="_blank"><?php echo $client->post_title; ?></a></td>
          </tr>
          <?php else : ?>
          <tr>
            <td><?php echo $client->post_title; ?></td>
          </tr>
          <?php endif; ?>
        <?php endforeach; ?>
        </table>
      </div>
      <div class="list-column right">
        <table>
        <?php foreach ($odd as $client) : ?>
          <?php $website = get_field('website', $client->ID); ?>
          <?php if ($website) : ?>
          <tr>
            <td><a href="<?php echo $website; ?>" target="_blank"><?php echo $client->post_title; ?></a></td>
          </tr>
          <?php else : ?>
          <tr>
            <td><?php echo $client->post_title; ?></td>
          </tr>
          <?php endif; ?>
        <?php endforeach; ?>
        </table>
      </div>
    </section>
  </div>


  <div class="clearfix"></div>
</div>
<script src="/javascripts/plugins/easing1.3.js" type="text/javascript"></script>
<script src="/javascripts/plugins/image-slider.js" type="text/javascript"></script>
<script type="text/javascript">
  $('.head .inset-shadow').css('opacity', '0');
  $('.scrollable-content .content').scroll(function() {
    scrollContentInsets(this);
  });
  $('.comma:last-child').remove();
  $('.content img:last-child').load(function() {
    $('.nano').nanoScroller();
  });
  $('.nano').nanoScroller();
  // $(document).ready(function() {
    $('#slider1').bxSlider({
      startingSlide: 0,
      pager: false,
      auto: false,
      autoControls: true,
      displaySlideQty: 3,
      moveSlideQty: 1,
      randomStart: true
    });
  // });
</script>


<?php get_footer(); ?>
