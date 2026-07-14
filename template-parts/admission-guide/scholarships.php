<?php $page_id = get_the_id(); ?>
<?php $scholarships = get_field('scholarships', $page_id); ?>
<?php if ($scholarships): ?>
    <?php
    $title = $scholarships['title'];
    $content = $scholarships['content'];
    $image_url = $scholarships['image']['url'];
    ?>
    <section id="scholarships" class="section_scholarships mb-5 section_sub_menu">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="section_title mb-5"><?php echo $title; ?></h2>
                    <div class="content_wrapper mb-5"><?php echo $content; ?></div>
                </div>
                <div class="col-md-5">
                    <div class="image_wrapper">
                        <img style="border-radius: 80px;"
                             src="<?php echo $image_url; ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
