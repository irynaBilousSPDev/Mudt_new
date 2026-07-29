<?php get_header();
$position_title = get_field('position_title');
$short_description = get_field('short_description');
$information_about_person = get_field('information_about_person');
$has_information_about_person = trim(wp_strip_all_tags((string) $information_about_person)) !== '';
?>
    <main>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <section id="munich_team-<?php the_ID(); ?>" <?php post_class('section_single_munich_team'); ?>>
                <div class="munich_team_header mb-5">
                    <div class="container">
                        <div class="row">
                            <?php $imgurl = get_the_post_thumbnail_url(get_the_ID()); ?>
                            <?php if ($imgurl) : ?>
                                <div class="col-lg-4">
                                    <div role="img" class="bg"
                                         style="background-image: url(<?php echo $imgurl; ?>);"></div>
                                </div>
                            <?php endif; ?>
                            <div class="col-lg-8">
                                <div class="entry-content mb-5">
                                    <h1 class="mb-5">
                                        <?php echo $position_title; ?><br>
                                        <?php the_title(); ?>
                                    </h1>
                                    <div class="short_description">
                                        <?php echo $short_description; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($has_information_about_person) : ?>
                    <div class="information_about_person">
                        <div class="container">
                            <?php echo $information_about_person; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
        <?php endwhile; endif; ?>
    </main>
<?php get_footer(); ?>