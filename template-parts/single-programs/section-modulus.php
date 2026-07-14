<?php
$program_post_id = get_the_id();
$modulus_title = get_field('modulus_title', $program_post_id);
$download_file = get_field('download_file', $program_post_id);
$modulus_card = get_field('modulus_card', $program_post_id);
$modulus_content = get_field('modulus_content', $program_post_id);
?>
<section class="modulus_section section_sub_menu" id="modulus">
    <div class="container">
        <h2 class="section_title text-center">
            <?php echo $modulus_title; ?>
        </h2>
        <?php if ($download_file): ?>
            <div class="download_btn_wrapper text-center">
                <a class="download_btn" href="<?php echo $download_file; ?>">
                    <?php echo _e('Download Curriculum') ?>
                </a>
            </div>
        <?php endif; ?>
        <?php if ($modulus_card): ?>
            <div class="modulus_content list_style">
                <div class="row">

                    <?php foreach ($modulus_card as $key => $item): ?>
                        <div class="col-lg-4 modul_card">
                            <div class="modul_item">
                                <?php echo $item['content']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
</section>