<?php
/* Template Name: News Page */
get_header();

// The Query
$the_query = new WP_Query( array('post_type' => 'post') ); ?>

<?php require_once('navs/blog-navs.php'); ?>

<!-- BLOG -->
<div id="blog" class="on-dark">
    <div class="container">
        <div class="row">
            <?php get_sidebar(); ?>
            <div class="col-md-8">
                <div class="posts">
                    <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <article>
                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <hr>
                            <?php the_excerpt(); ?>
                        </article>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>