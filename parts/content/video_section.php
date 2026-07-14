<?php
$video = get_sub_field('video_url');
preg_match('/src="(.+?)"/', $video, $matches_url);
$src = $matches_url[1];
preg_match('/embed(.*?)?feature/', $src, $matches_id);
$id = $matches_id[1];
$id = str_replace(str_split('?/'), '', $id);
?>
<section id="layout_id_<?php echo get_row_index(); ?>" class="video_section section_sub_menu">
    <div class="container">
        <div class="parallax-section">
            <div class="youtube-container parallax-image">
                <iframe title=""
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""
                        src="https://www.youtube.com/embed/<?php echo $id; ?>?autoplay=1&amp;mute=1&amp;playlist=<?php echo $id; ?>&amp;loop=1&amp;controls=0&amp;modestbranding=0&amp;playsinline=0&amp;rel=0&amp;enablejsapi=1"
                ></iframe>
            </div>
        </div>
    </div>
</section>
