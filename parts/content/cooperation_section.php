<?php
$section_logo_title = get_sub_field('logo_title');
$list_logos = get_sub_field('list_logos');
?>

<section id="layout_id_<?php echo get_row_index(); ?>" class="section_logo section_sub_menu">
    <div class="container">
        <div class="section_logo_header mb-5 d-flex flex-column align-items-center">
            <h2 class="section_title">
                <?php echo $section_logo_title; ?>
            </h2>
        </div>
        <?php if ($list_logos): ?>
            <div class="wrapper_logos col-xl-10">
                <div class="row">
                    <?php foreach ($list_logos as $key => $item) : ?>
                        <?php $image = $item['logo']; ?>
                        <?php if (!empty($image)): ?>
                            <div class="col-md-3 logo_item">
                                <img data-aos="zoom-in" data-aos-duration="300" data-aos-anchor-placement="top-bottom"
                                     data-aos-delay="<?php echo $key + 1; ?>00" alt=""
                                     src="<?php echo $image['url']; ?>">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
