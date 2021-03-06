<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<div class="container store">
		<section class="head">
			<h1><?php woocommerce_page_title(); ?></h1>
			<div class="inset-shadow"></div>
			<b></b><b></b>
		</section>
		<section class="scrollable-content nano">
			<div class="content">
				<?php if ( have_posts() ) : ?>
					<?php woocommerce_product_loop_start(); ?>
						<?php // woocommerce_product_subcategories(); ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php wc_get_template_part( 'content', 'product' ); ?>
						<?php endwhile; // end of the loop. ?>
					<?php woocommerce_product_loop_end(); ?>
				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
					<?php wc_get_template( 'loop/no-products-found.php' ); ?>
				<?php endif; ?>
				<div class="clearfix"></div>
			</div>
		</section>
	</div>
<?php get_footer( 'shop' ); ?>
