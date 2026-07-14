<?php
$scholarship_title = get_sub_field('scholarship_title');
$mudt_scholarship = get_sub_field('mudt_scholarship');
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="section_scholarship mb-5 section_sub_menu">
    <div class="container">
        <?php if ($scholarship_title): ?>
            <h2 class="section_title text-center my-5">
                <?php echo $scholarship_title; ?>
            </h2>
        <?php endif; ?>
        <?php if ($mudt_scholarship): ?>
            <div class="row">
                <?php foreach ($mudt_scholarship as $key => $item) :
                    $sub_title = $item['sub_title'];
                    $title = $item['title'];
                    $text = $item['text'];
                    ?>
                    <div class="col-md-6 scholarship_col">
                        <div class="scholarship_item">
                            <div class="scholarship_sub_title">
                                <?php echo $sub_title; ?>
                            </div>
                            <h2 class="scholarship_title section_title">
                                <?php echo $title; ?>
                            </h2>
                            <div class="scholarship_text">
                                <?php echo $text; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>