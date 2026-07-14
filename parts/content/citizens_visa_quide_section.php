<?php
$citizens_cards = get_sub_field('citizens_visa_guide_cards');
?>
<?php if ($citizens_cards) : ?>
    <section id="layout_id_<?php echo get_row_index(); ?>" class="section_entering section_sub_menu">
        <div class="container">
            <div class="citizens_visa_guide">
                <div class="row">
                    <?php foreach ($citizens_cards as $key => $item) : ?>
                        <?php
                        $description = $item['description'];
                        $content = $item['content'];
                        $link = $item['custom_btn'];
                        ?>
                        <div class="col-xl-4 entering_col">
                            <div class="entering_item">
                                <div class="description mb-5">
                                    <?php echo $description; ?>
                                </div>
                                <div class="content">
                                    <?php echo $content; ?>
                                </div>
                                <?php
                                if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <div class="btn_wrapper text-center">
                                        <a href="<?php echo esc_url($link_url); ?>" class="primary_btn my-3"
                                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>