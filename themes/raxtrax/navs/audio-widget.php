<?php $the_query = new WP_Query( array('post_type' => 'song') ); ?>
<?php if ($the_query->have_posts()) : ?>
<div id="player-playlist" class="col-sm-6 col-sm-offset-3">
    <audio></audio>
    <div class="controls">
        <div class="btn-group">
            <a href="javascript:void(0)" class="btn btn-default previous">
                <span class="glyphicon glyphicon-backward"></span>
            </a>
            <a href="javascript:void(0)" class="btn btn-default play-pause">
                <span class="glyphicon glyphicon-play play"></span>
                <span class="glyphicon glyphicon-pause pause hidden"></span>
            </a>
            <a href="javascript:void(0)" class="btn btn-default next">
                <span class="glyphicon glyphicon-forward"></span>
            </a>
            <!-- <a href="javascript:void(0)" class="btn btn-default stop"><span class="glyphicon glyphicon-stop"></span></a> -->
        </div>
        <h4 class="text-muted time pull-right">
            <span class="time-figure elapsed"></span>
            <span>|</span>
            <span class="time-figure duration"></span>
        </h4>
    </div>

    <div class="progress media-progress hidden">
        <div class="scrub-holder">
            <!-- <div class="start"></div> -->
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            <a href="javascript:void(0)" class="handle"></a>
        </div>
    </div>

    <ul id="playlist" class="list-group">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <li class="list-group-item track"
            data-ogg="<?php echo get_field('ogg')['url']; ?>"
            data-mp3="<?php echo get_field('mp3')['url']; ?>"
            >
            <strong><?php the_title(); ?></strong>
        </li>
        <?php endwhile; ?>
    </ul>
</div>
<?php endif; wp_reset_postdata(); ?>