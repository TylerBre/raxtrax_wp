<?php /* Template Name: Gallery Page */
get_header();

$args = array( 'post_type' => 'attachment', 'numberposts' => -1);
$studio_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'studios'");
$gear_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'gear'");
$studio_page_fields = get_fields($studio_page_id);
$gear_page_fields = get_fields($gear_page_id);
$args = array(
  'post_type' => array('instrument', 'outboard-gear', 'microphone', 'software')
);

$images = array();


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

foreach ($studios as $studio => $rooms) {
  foreach ($rooms as $room_name) {
    $key = $studio . "-" . $room_name;
    foreach ($studio_page_fields[$key . '_images'] as $image) {
      $images[] = $image['image']['url'];
    }
  }
}

?>

<?php foreach ($images as $image) : ?>
  <img src="<?php echo $image ?>"  class="source hidden">
<?php endforeach; ?>

<?php get_footer(); ?>
