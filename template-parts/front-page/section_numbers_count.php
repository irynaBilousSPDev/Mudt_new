<?php $page_id = get_the_id(); ?>
<?php $numbers_count = get_field('numbers_count', $page_id); ?>
<?php if ($numbers_count) : ?>
    <section class="section_numbers_count">
        <div class="container">
            <div class="row">
                <?php foreach ($numbers_count as $key => $item) : ?>
                    <?php $number = $item['number_count'];
                    $title = $item['title_count']; ?>
                    <div class="col-6 col-md-3 numbers_count__item">
                        <div class="data_count_box">
                            <div class="data_count" data-count="<?php echo $number; ?>">10</div>
                            <span>%</span>
                        </div>
                        <h2><?php echo $title; ?></h2>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
