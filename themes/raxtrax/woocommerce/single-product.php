<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<div class="container store">
		<section class="head">
			<h1 class="breadcrumb"><?php woocommerce_breadcrumb(); ?></h1>
			<div class="inset-shadow"></div>
			<b></b><b></b>
		</section>
		<section class="scrollable-content nano">
			<div class="content">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
				<div class="clearfix"></div>
			</div>
		</section>
	</div>
<?php get_footer( 'shop' ); ?>
