<section class="section_latest_specialisations">
    <div class="container">
        <h2>latest specialisations</h2>
        <br>
        <?php foreach ($programs as $key => $program): ?>
            Program -   <?php echo $program->name; ?><br>
            <br>
            <?php
            $args = array(
                'post_type' => 'programs',
                'order' => 'ASC',
                'post__not_in' => [get_the_ID()],
                'posts_per_page' => -1
            );
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
                $imgurl = get_the_post_thumbnail_url(get_the_ID(), 'full');
                $title = get_the_title($post->ID);
                ?>
                <a class="specialisation" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?> <br>
                </a>
            <?php endwhile;
            wp_reset_postdata(); ?>
        <?php endforeach; ?>
    </div>
</section>