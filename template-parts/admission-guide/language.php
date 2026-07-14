<?php $page_id = get_the_id(); ?>
<?php $language = get_field('addmission_language', $page_id); ?>
<?php if ($language): ?>
    <?php $columns = $language['columns'];
    $description = $language['description']; ?>
    <section id="language_proficiency" class="section_language  my-5 section_sub_menu">
        <div class="container">
            <div class="row">
                <?php foreach ($columns as $col): ?>
                    <div class="col-md-6" data-aos="fade-up" data-aos-duration="1000">
                        <h2 class="section_title mb-5"><?php echo $col['title']; ?></h2>
                        <?php echo $col['content']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="description my-3" data-aos="fade-up" data-aos-duration="1000"><?php echo $description; ?> </div>
        </div>
    </section>
<?php endif; ?>
