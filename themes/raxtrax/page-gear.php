<?php /* Template Name: Gear Page */
get_header(); ?>

<?php
  $pageID = get_the_ID();

  $gear = new WP_Query(array(
    'post_type' => array('instrument', 'outboard-gear', 'microphone', 'software')
  ));

  // yeah...

  function mapCategories ($initial, $item) {
    $category = get_field('category', $item->ID);
    $category = $category ? $category : "All"; // would like to just do $category = get_field('category', $item->ID) || "All";

    if (!array_key_exists($category, $initial)) $initial[$category] = array();

    array_push($initial[$category], $item);

    return $initial;
  }

  $instruments = array_filter(array_map(function ($item) {
    if ($item->post_type == 'instrument') return $item;
  }, $gear->posts));


  $outboard_gear = array_filter(array_map(function ($item) {
    if ($item->post_type == 'outboard-gear') return $item;
  }, $gear->posts));

  $microphones = array_filter(array_map(function ($item) {
    if ($item->post_type == 'microphone') return $item;
  }, $gear->posts));

  $software = array_filter(array_map(function ($item) {
    if ($item->post_type == 'software') return $item;
  }, $gear->posts));

  $gear = array(
    'instruments'   => array_reduce($instruments, "mapCategories", array()),
    'outboard_gear' => array_reduce($outboard_gear, "mapCategories", array()),
    'microphones'   => array_reduce($microphones, "mapCategories", array()),
    'software'      => array_reduce($software, "mapCategories", array())
  );

?>

<!-- js tab navigation -->
<div class="tab-nav no-mobi">
  <ul class="tabrow">
    <li class="instruments first active"><a href="#">Instruments</a></li>
    <li class="microphones"><a href="#">Microphones</a></li>
    <li class="outboard_gear"><a href="#">Outboard Gear</a></li>
    <li class="software last"><a href="#">Software</a></li>
  </ul>
</div>

<?php foreach ($gear as $key => $value): ?>
<div id='<?php echo $key ?>' class="container gear no-mobi <?php echo ($key == 'instruments') ? 'active' : 'hidden'; ?>">
  <div class="col col1 split">
    <section class="head">
      <h1><span>Complete List</span></h1>
      <div class="inset-shadow"></div>
      <b></b>
    </section>

    <section class="scrollable-content nano">
      <div class="content">
        <table>
          <?php foreach ($value as $category => $gear_items): ?>
          <tr>
            <th align="left"><h2><?php echo $category; ?></h2></th>
          </tr>
          <?php foreach ($gear_items as $gear_item): ?>
          <tr>
            <td class="name"><?php echo $gear_item->post_title; ?></td>
            <td><?php echo get_field('quantity', $gear_item->ID); ?></td>
          </tr>
          <?php endforeach; endforeach; ?>
        </table>
      </div>
    </section>

  </div>
  <div class="border vertical"></div>
  <!-- GEAR DETAIL -->
  <div class="col col2 split">
    <section class="head">
      <h1>Gear<span> - <small><?php echo strtoupper(str_replace('_', ' ', $key)); ?></small></span></h1>
      <div class="inset-shadow"></div>
      <b></b>
    </section>
    <section class="scrollable-content nano">
      <div class="content">
        <article>

        </article>
      </div>
    </section>
  </div>
  <div class="clearfix"></div>
</div>
<?php endforeach; get_footer(); ?>
