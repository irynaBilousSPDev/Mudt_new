<?php
/**
 * Template Name: Professional Training
 */
get_header();

$uri = get_template_directory_uri();
$facet = get_field('pt_hero_facet');
$facet_url = is_array($facet) && !empty($facet['url']) ? $facet['url'] : $uri . '/images/pt-hero-facet.png';

$eyebrow = get_field('pt_hero_eyebrow') ?: 'Professional Training';
$title = get_field('pt_hero_title') ?: 'Training taught and delivered by the people who practise it';
$sub = get_field('pt_hero_sub') ?: 'Advanced courses for working professionals and their organisations - led by seasoned experts with years of hands-on experience in their field, backed by the university\'s academic standards and an established partner network.';
$note = get_field('pt_hero_note') ?: '<b>First course: CRA Practitioner, 31 Aug - 2 Sep 2026</b> - on-site in Munich. Further dates will follow.';
$cta_primary = get_field('pt_hero_cta_primary');
$cta_secondary = get_field('pt_hero_cta_secondary');
$cta_primary_url = is_array($cta_primary) && !empty($cta_primary['url']) ? $cta_primary['url'] : home_url('/cra-practitioner/');
$cta_primary_title = is_array($cta_primary) && !empty($cta_primary['title']) ? $cta_primary['title'] : 'See the CRA Practitioner';
$cta_secondary_url = is_array($cta_secondary) && !empty($cta_secondary['url']) ? $cta_secondary['url'] : '#centers';
if ($cta_secondary_url === '#layout_id_3') {
    $cta_secondary_url = '#centers';
}
$cta_secondary_title = is_array($cta_secondary) && !empty($cta_secondary['title']) ? $cta_secondary['title'] : 'Explore the centers';

$form_shortcode = mudt_pt_cf7_shortcode(get_field('pt_cf7_form') ?: get_field('pt_form_shortcode'));
?>
<main class="page custom-page pt-page page_professional_training">

    <div class="pt-hero">
        <img class="pt-facet" src="<?php echo esc_url($facet_url); ?>" alt="">
        <div class="pt-wrap">
            <div class="pt-eyebrow"><?php echo mudt_pt_plain($eyebrow); ?></div>
            <h1><?php echo mudt_pt_plain($title); ?></h1>
            <p class="pt-sub"><?php echo mudt_pt_plain($sub); ?></p>
            <?php if ($note) : ?>
                <p class="pt-hero-note"><?php echo mudt_pt_html($note); ?></p>
            <?php endif; ?>
            <div class="pt-cta">
                <a class="pt-btn" href="<?php echo esc_url($cta_primary_url); ?>"><?php echo esc_html($cta_primary_title); ?></a>
                <a class="pt-btn ghost" href="<?php echo esc_url($cta_secondary_url); ?>"><?php echo esc_html($cta_secondary_title); ?></a>
            </div>
        </div>
    </div>

    <?php
    $fc_kicker = get_field('pt_featured_kicker') ?: 'First course';
    $fc_title = get_field('pt_featured_title') ?: 'CRA Practitioner';
    $fc_lead = get_field('pt_featured_lead') ?: 'The EU Cyber Resilience Act, from regulation to engineering practice. A 3-day practitioner course for the cross-functional teams that have to implement it.';
    $fc_badge = get_field('pt_featured_badge') ?: 'Enrolling now';
    $fc_heading = get_field('pt_featured_heading') ?: 'Get CRA-ready before the deadlines';
    $fc_text = get_field('pt_featured_text') ?: 'Notification obligations apply from 11 September 2026 and the essential requirements from 11 December 2027, with fines of up to € 15 million or 2.5% of global annual turnover. This course turns the regulation into concrete processes, architecture and evidence.';
    $fc_tags = get_field('pt_featured_tags');
    if (empty($fc_tags)) {
        $fc_tags = array(
            array('label' => '31 Aug - 2 Sep 2026'),
            array('label' => '3 days'),
            array('label' => 'On-site · Munich'),
            array('label' => 'English'),
            array('label' => '6-16 participants'),
        );
    }
    $fc_btn = get_field('pt_featured_btn');
    $fc_btn_url = is_array($fc_btn) && !empty($fc_btn['url']) ? $fc_btn['url'] : home_url('/cra-practitioner/');
    $fc_btn_title = is_array($fc_btn) && !empty($fc_btn['title']) ? $fc_btn['title'] : 'Course details →';
    $fc_quote = get_field('pt_featured_quote');
    $fc_quote_url = is_array($fc_quote) && !empty($fc_quote['url']) ? $fc_quote['url'] : '#enquire';
    if ($fc_quote_url === '#layout_id_6') {
        $fc_quote_url = '#enquire';
    }
    $fc_quote_title = is_array($fc_quote) && !empty($fc_quote['title']) ? $fc_quote['title'] : 'Request a quote';
    $fc_side_title = get_field('pt_featured_side_title') ?: 'At a glance';
    $fc_kv = get_field('pt_featured_kv');
    if (empty($fc_kv)) {
        $fc_kv = array(
            array('label' => 'Fee', 'value' => '€ 1,950'),
            array('label' => 'Level', 'value' => 'Practitioner'),
            array('label' => 'Format', 'value' => 'On-site'),
            array('label' => 'Venue', 'value' => 'Siemens Campus'),
        );
    }
    ?>
    <section class="pt-section">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($fc_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($fc_title); ?></h2>
            <p class="pt-lead"><?php echo mudt_pt_plain($fc_lead); ?></p>
            <div class="pt-featured">
                <div>
                    <?php if ($fc_badge) : ?><span class="pt-badge"><?php echo esc_html($fc_badge); ?></span><?php endif; ?>
                    <h3><?php echo mudt_pt_plain($fc_heading); ?></h3>
                    <p><?php echo mudt_pt_plain($fc_text); ?></p>
                    <?php if ($fc_tags) : ?>
                        <div class="fx">
                            <?php foreach ($fc_tags as $tag) :
                                $label = is_array($tag) ? ($tag['label'] ?? '') : $tag;
                                if (!$label) continue;
                                ?>
                                <span><?php echo esc_html($label); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="acts">
                        <a class="pt-btn" href="<?php echo esc_url($fc_btn_url); ?>"><?php echo esc_html($fc_btn_title); ?></a>
                        <a class="pt-btn outline" href="<?php echo esc_url($fc_quote_url); ?>"><?php echo esc_html($fc_quote_title); ?></a>
                    </div>
                </div>
                <div class="side">
                    <h4><?php echo esc_html($fc_side_title); ?></h4>
                    <div class="pt-kv">
                        <?php foreach ($fc_kv as $row) : ?>
                            <div>
                                <span><?php echo esc_html($row['label'] ?? ''); ?></span>
                                <b><?php echo esc_html($row['value'] ?? ''); ?></b>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $cat_kicker = get_field('pt_catalogue_kicker') ?: 'Course catalogue';
    $cat_title = get_field('pt_catalogue_title') ?: 'Our courses';
    $cat_lead = get_field('pt_catalogue_lead') ?: 'We open with the AppSec track and a current, urgent topic. Further courses follow in AppSec and in Compliance, Regulations and Frameworks.';
    $courses = get_field('pt_courses');
    if (empty($courses)) {
        $courses = array(
            array(
                'badge' => 'Open now',
                'badge_grey' => false,
                'soon' => false,
                'title' => 'CRA Practitioner',
                'text' => 'A 3-day practitioner course that turns the EU Cyber Resilience Act from legal text into engineering and compliance practice.',
                'link' => array('url' => home_url('/cra-practitioner/'), 'title' => 'Course details'),
            ),
            array(
                'badge' => 'Coming soon',
                'badge_grey' => true,
                'soon' => true,
                'title' => 'AppSec track',
                'text' => 'Threat Modelling, Security Architecture, OWASP SAMM, Secure Coding, DevSecOps, SBOM & supply chain, AI for secure development.',
                'link' => null,
            ),
            array(
                'badge' => 'Coming soon',
                'badge_grey' => true,
                'soon' => true,
                'title' => 'Compliance, Regulations & Frameworks',
                'text' => 'EU cybersecurity regulation landscape (NIS2, DORA, AI Act, CRA), the EU AI Act, and NIS2.',
                'link' => null,
            ),
        );
    }
    ?>
    <section class="pt-section alt">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($cat_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($cat_title); ?></h2>
            <p class="pt-lead"><?php echo mudt_pt_plain($cat_lead); ?></p>
            <div class="pt-cards">
                <?php foreach ($courses as $card) :
                    $soon = !empty($card['soon']);
                    $badge_grey = !empty($card['badge_grey']);
                    $link = $card['link'] ?? null;
                    ?>
                    <div class="pt-card<?php echo $soon ? ' soon' : ''; ?>">
                        <?php if (!empty($card['badge'])) : ?>
                            <span class="pt-badge<?php echo $badge_grey ? ' grey' : ''; ?>"><?php echo mudt_pt_plain($card['badge']); ?></span>
                        <?php endif; ?>
                        <h3><?php echo mudt_pt_plain($card['title'] ?? ''); ?></h3>
                        <p><?php echo mudt_pt_plain($card['text'] ?? ''); ?></p>
                        <?php if (is_array($link) && !empty($link['url'])) : ?>
                            <a class="pt-btn" href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title'] ?: 'Learn more'); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $cen_kicker = get_field('pt_centers_kicker') ?: 'The centers';
    $cen_title = get_field('pt_centers_title') ?: 'Our centers';
    $cen_lead = get_field('pt_centers_lead') ?: 'Our professional training is organised in centers. Each center brings together a clear theme, a faculty of experienced practitioners and an established partner network. Centers and their offerings grow over time; the first is the Center for Cyber Security and AI.';
    $centers = get_field('pt_centers');
    if (empty($centers)) {
        $centers = array(
            array(
                'badge' => 'Open now',
                'badge_grey' => false,
                'soon' => false,
                'title' => 'Center for Cyber Security and AI',
                'text' => 'Training on secure software, the EU Cyber Resilience Act and applied AI security - grounded in recognised frameworks and led by experienced security professionals. First course: CRA Practitioner.',
                'link' => array('url' => '#', 'title' => 'Visit the center'),
            ),
            array(
                'badge' => 'Coming soon',
                'badge_grey' => true,
                'soon' => true,
                'title' => 'Further centers',
                'text' => 'Additional centers will follow, extending the model to new themes, faculties and partner networks.',
                'link' => null,
            ),
        );
    }
    ?>
    <section class="pt-section" id="centers">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($cen_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($cen_title); ?></h2>
            <p class="pt-lead"><?php echo mudt_pt_plain($cen_lead); ?></p>
            <div class="pt-cards">
                <?php foreach ($centers as $card) :
                    $soon = !empty($card['soon']);
                    $badge_grey = !empty($card['badge_grey']);
                    $link = $card['link'] ?? null;
                    ?>
                    <div class="pt-card<?php echo $soon ? ' soon' : ''; ?>">
                        <?php if (!empty($card['badge'])) : ?>
                            <span class="pt-badge<?php echo $badge_grey ? ' grey' : ''; ?>"><?php echo mudt_pt_plain($card['badge']); ?></span>
                        <?php endif; ?>
                        <h3><?php echo mudt_pt_plain($card['title'] ?? ''); ?></h3>
                        <p><?php echo mudt_pt_plain($card['text'] ?? ''); ?></p>
                        <?php if (is_array($link) && !empty($link['url']) && $link['url'] !== '#') : ?>
                            <a class="pt-btn" href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title'] ?: 'Learn more'); ?></a>
                        <?php elseif (is_array($link) && !empty($link['title'])) : ?>
                            <a class="pt-btn" href="<?php echo esc_url($link['url'] ?: '#'); ?>"><?php echo esc_html($link['title']); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $why_kicker = get_field('pt_why_kicker') ?: 'Why train with us';
    $why_title = get_field('pt_why_title') ?: 'What sets our training apart';
    $why_cards = get_field('pt_why_cards');
    if (empty($why_cards)) {
        $why_cards = array(
            array('title' => 'Taught by practitioners', 'text' => 'Every course is led by specialists with many years of hands-on experience - professionals who have built, secured and audited real systems, not only studied them.'),
            array('title' => 'Practice over theory', 'text' => 'Small groups, concrete methods and tools you can apply the next day. Participants leave with a shared vocabulary and concrete next steps, not just slides.'),
            array('title' => 'University rigour, industry reach', 'text' => 'The academic standards of MUDT combined with an active partner network, so what you learn is current, recognised and repeatable long after the course.'),
        );
    }
    ?>
    <section class="pt-section alt">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($why_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($why_title); ?></h2>
            <div class="pt-cards">
                <?php foreach ($why_cards as $card) : ?>
                    <div class="pt-card">
                        <h3><?php echo mudt_pt_plain($card['title'] ?? ''); ?></h3>
                        <p><?php echo mudt_pt_plain($card['text'] ?? ''); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $ws_kicker = get_field('pt_workshops_kicker') ?: 'Beyond training';
    $ws_title = get_field('pt_workshops_title') ?: 'Workshops and consulting';
    $ws_lead = get_field('pt_workshops_lead') ?: 'The same experts who teach also work with organisations directly - at the depth you need.';
    $ws_cards = get_field('pt_workshops_cards');
    if (empty($ws_cards)) {
        $ws_cards = array(
            array(
                'title' => 'In-house workshops',
                'text' => 'Tailored sessions delivered for a single organisation and built around your products, stack and goals - the fastest way to bring a whole team to a shared level.',
                'link' => array('url' => '#enquire', 'title' => 'Enquire'),
            ),
            array(
                'title' => 'Consulting & advisory',
                'text' => 'Hands-on support on your real projects: assessments, architecture and process reviews, compliance guidance and expert advice - from the same practitioners who teach the courses.',
                'link' => array('url' => '#enquire', 'title' => 'Discuss an engagement'),
            ),
        );
    }
    ?>
    <section class="pt-section">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($ws_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($ws_title); ?></h2>
            <p class="pt-lead"><?php echo mudt_pt_plain($ws_lead); ?></p>
            <div class="pt-cards">
                <?php foreach ($ws_cards as $card) :
                    $link = $card['link'] ?? null;
                    $link_url = is_array($link) && !empty($link['url']) ? $link['url'] : '';
                    if ($link_url === '#layout_id_6') {
                        $link_url = '#enquire';
                    }
                    ?>
                    <div class="pt-card">
                        <h3><?php echo mudt_pt_plain($card['title'] ?? ''); ?></h3>
                        <p><?php echo mudt_pt_plain($card['text'] ?? ''); ?></p>
                        <?php if ($link_url) : ?>
                            <a class="pt-btn" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link['title'] ?: 'Enquire'); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $eq_kicker = get_field('pt_enquire_kicker') ?: 'Get in touch';
    $eq_title = get_field('pt_enquire_title') ?: 'Training, workshops or consulting - let\'s talk';
    $eq_lead = get_field('pt_enquire_lead') ?: 'Whatever you need - a scheduled course, an in-house workshop, a session on a special topic, or hands-on consulting on your own project - tell us and we will get back to you within one working day.';
    $eq_note = get_field('pt_enquire_note') ?: 'Dates, figures and fees are indicative and to be confirmed.';
    ?>
    <section class="pt-section alt" id="enquire">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($eq_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($eq_title); ?></h2>
            <p class="pt-lead"><?php echo mudt_pt_plain($eq_lead); ?></p>
            <div class="pt-enquire-form">
                <?php if ($form_shortcode) : ?>
                    <?php echo do_shortcode($form_shortcode); ?>
                <?php else : ?>
                    <div class="pt-enquire-missing">Contact form not configured.</div>
                <?php endif; ?>
            </div>
            <?php if ($eq_note) : ?>
                <p class="pt-note"><?php echo mudt_pt_plain($eq_note); ?></p>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php get_footer(); ?>
