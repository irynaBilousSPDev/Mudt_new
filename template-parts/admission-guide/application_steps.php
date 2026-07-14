<?php $page_id = get_the_id();?>

<?php $application_steps = get_field('application_steps', $page_id); ?>
<?php if ($application_steps): ?>
    <?php
    $title = $application_steps['title'];
    $content = $application_steps['content'];
    $right_side = $application_steps['right_side'];
    ?>
    <section id="application_steps" class="section_application_steps mb-5 section_sub_menu">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <h2 class="section_title"><?php echo $title; ?></h2>
                    <div class="steps_list">
                        <?php echo $content; ?>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="title_wrapper">
                        <h2 class="section_title" style="color: #fff;">
                            <?php echo $right_side; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
