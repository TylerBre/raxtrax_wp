<?php /* Template Name: Studios Page */
get_header();

$fields = get_fields($post->ID);

$studios = array(
  'studio_a' => array('control_room', 'live_room', 'iso_booth'),
  'studio_b' => array('control_room', 'live_room', 'iso_booth'),
  'lounge' => array('lounge')
);

$studioNames = array(
  'studio_a' => 'Studio A',
  'studio_b' => 'Studio B',
  'lounge' => 'Lounge',
);

$roomNames = array(
  'control_room' => 'Control Room',
  'live_room' => 'Live Room',
  'iso_booth' => 'Iso Booth',
  'lounge' => 'Lounge',
);
?>

<div class="studios container">
  <div class="col col1 no-mobi">
    <h1><span>Use Floorplan to View</span></h1>
    <div id="studio-map">
      <a href="#" id="isob"class="iso_booth" rel="studio_b"><em>Studio B Iso Booth</em></a>
      <a href="#" id="controlb"class="control_room" rel="studio_b"><em>Studio B Control Room</em></a>
      <a href="#" id="liveb" class="live_room" rel="studio_b"><em>Studio B Live Room</em></a>
      <a href="#" id="isoa" class="iso_booth" rel="studio_a"><em>Studio A Iso Booth</em></a>
      <a href="#" id="controla" class="control_room" rel="studio_a"><em>Studio A Control Room</em></a>
      <a href="#" id="lounge"  class="lounge" rel="lounge"><em>Lounge</em></a>
      <a href="#" id="livea" class="live_room" rel="studio_a"><em>Studio A Live Room</em></a>
    </div>
  </div>
  <b class="border vertical"></b>
  <div class="col col2">
    <?php
      foreach ($studios as $studio => $rooms):
      foreach ($rooms as $room_name):
      $key = $studio . "-" . $room_name;
      $hidden = ($key == 'studio_a-control_room') ? 'active' : 'hidden';
    ?>
    <article class="rooms-container <?php echo $studio . ' ' . $room_name . ' ' . $hidden; ?>">
      <section class="head">
        <h1><?php echo $studioNames[$studio]; ?><span> - <small><?php echo strtoupper($roomNames[$room_name]); ?></small></span></h1>
        <div class="inset-shadow"></div>
        <b></b>
      </section>
      <!-- desktop :? -->
      <section class="scrollable-content nano no-mobi">
        <div class="content">
          <p><?php echo $fields[$key . '_description']; ?></p>
          <?php foreach ($fields[$key . '_images'] as $image): ?>

            <!-- regular images :? -->
            <div class="no-mobi">
              <a href="<?php bloginfo("url"); ?>/gallery/studios?image_id=<?php echo $image['image']['id']; ?>" class="to-gallery studios no-large">
                <div style="background-image: url('<?php echo $image['image']['sizes']['large'] ?>');">
                  <h3><?php echo $image['image']['title'] ?><b class="popout-icon"></b></h3>
                  <img src="<?php echo $image['image']['sizes']['large'] ?>" width="211" style="display: none;">
                </div>
              </a>
            </div>

            <!-- large images :? -->
            <a href="<?php bloginfo("url"); ?>/gallery/studios?image_id=<?php echo $image['image']['id']; ?>" class="to-gallery studios large">
              <div style="background-image: url('<?php echo $image['image']['sizes']['large'] ?>');" >
                <h3><?php echo $image['image']['title'] ?><b class="popout-icon"></b></h3>
                <img src="<?php echo $image['image']['sizes']['large'] ?>" width="818" style="visibility: hidden;">
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- mobile :? -->
      <section class="scrollable-content mobi">
        <p><?php echo $fields[$key . '_description']; ?></p>
        <br>
        <?php foreach ($fields[$key . '_images'] as $image): ?>
        <div class="static mobi">
          <div style="background-image: url('<?php echo $image['image']['sizes']['medium'] ?>');">
            <img src="<?php echo $image['image']['sizes']['large'] ?>" width="100%">
          </div>
        </div>
        <?php endforeach; ?>
      </section>
    </article>
    <?php endforeach; endforeach; ?>

  </div>
  <div class="clearfix"></div>
</div>
<?php get_footer(); ?>
