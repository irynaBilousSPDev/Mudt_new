<?php
/**
 * Template Name: CRA Practitioner
 */
get_header();

$uri = get_template_directory_uri();
$facet = get_field('cra_hero_facet');
$facet_url = is_array($facet) && !empty($facet['url']) ? $facet['url'] : $uri . '/images/pt-hero-facet.png';

$eyebrow = get_field('cra_hero_eyebrow') ?: 'Professional Training';
// Temporary: ignore breadcrumb-style eyebrow from earlier sync
if (is_string($eyebrow) && (strpos($eyebrow, '›') !== false || substr_count($eyebrow, '>') >= 2)) {
    $eyebrow = 'Professional Training';
}
$title = get_field('cra_hero_title') ?: 'CRA Practitioner';
$sub = get_field('cra_hero_sub') ?: 'The EU Cyber Resilience Act - from regulation to engineering practice. A 3-day practitioner course for the teams that have to implement it.';
$note = get_field('cra_hero_note') ?: '<b>First cohort: 31 Aug - 2 Sep 2026</b> - further dates will follow. In-house courses for a single organisation are available on request.';
$cta_primary = get_field('cra_hero_cta_primary');
$cta_secondary = get_field('cra_hero_cta_secondary');
$cta_primary_url = is_array($cta_primary) && !empty($cta_primary['url']) ? $cta_primary['url'] : '#layout_id_6';
$cta_primary_title = is_array($cta_primary) && !empty($cta_primary['title']) ? $cta_primary['title'] : 'Register / request a call';
$cta_secondary_url = is_array($cta_secondary) && !empty($cta_secondary['url']) ? $cta_secondary['url'] : '#webinar';
$cta_secondary_title = is_array($cta_secondary) && !empty($cta_secondary['title']) ? $cta_secondary['title'] : 'Join the free CRA webinar';
if ($cta_primary_url === '#enquire') {
    $cta_primary_url = '#layout_id_6';
}

$facts = get_field('cra_hero_facts');
if (empty($facts)) {
    $facts = array(
        array('label' => '31 Aug - 2 Sep 2026'),
        array('label' => '3 days'),
        array('label' => 'On-site · Siemens Campus, Neuperlach'),
        array('label' => 'English'),
        array('label' => 'Small group (6-16)'),
    );
}

$form_shortcode = trim((string) get_field('cra_form_shortcode'));
?>
<main class="page custom-page pt-page page_cra_practitioner">

    <div class="pt-hero">
        <img class="pt-facet" src="<?php echo esc_url($facet_url); ?>" alt="">
        <div class="pt-wrap">
            <div class="pt-eyebrow"><?php echo mudt_pt_plain($eyebrow); ?></div>
            <h1><?php echo mudt_pt_plain($title); ?></h1>
            <div class="pt-sub"><?php echo mudt_pt_html($sub); ?></div>
            <?php if ($note) : ?>
                <div class="pt-hero-note"><?php echo mudt_pt_html($note); ?></div>
            <?php endif; ?>
            <div class="pt-cta">
                <a class="pt-btn" href="<?php echo esc_url($cta_primary_url); ?>"><?php echo esc_html($cta_primary_title); ?></a>
                <a class="pt-btn ghost" href="<?php echo esc_url($cta_secondary_url); ?>"><?php echo esc_html($cta_secondary_title); ?></a>
            </div>
            <?php if ($facts) : ?>
                <div class="pt-facts">
                    <?php foreach ($facts as $fact) :
                        $label = is_array($fact) ? ($fact['label'] ?? '') : $fact;
                        if (!$label) continue;
                        ?>
                        <span><?php echo esc_html($label); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    $wn_kicker = get_field('cra_why_kicker') ?: 'Why now';
    $wn_title = get_field('cra_why_title') ?: 'The deadlines are no longer on the horizon';
    $wn_lead = get_field('cra_why_lead') ?: 'Unlike earlier guidance, the CRA carries real enforcement: fines of up to €15 million or 2.5% of global annual turnover, and the authority to withdraw non-compliant products from the EU market. Its notification obligations apply from 11 September 2026 and its essential requirements from 11 December 2027. Building the vulnerability tracking, incident detection and reporting workflows the CRA requires takes months - this course gives your team the shared understanding to start building the right things straight away.';
    ?>
    <section class="pt-section section_sub_menu" id="layout_id_1">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($wn_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($wn_title); ?></h2>
            <div class="pt-lead"><?php echo mudt_pt_html($wn_lead); ?></div>
        </div>
    </section>

    <?php
    $who_title = get_field('cra_who_title') ?: 'Who it\'s for';
    $who_lead = get_field('cra_who_lead') ?: 'The cross-functional roles that have to implement the CRA. It is relevant to anyone who touches a product that falls under the CRA, not just the security team - and no prior CRA knowledge is required. Best attended as a team - you leave with a shared vocabulary and an aligned view of who does what.';
    $who_chips = get_field('cra_who_chips');
    if (empty($who_chips)) {
        $who_chips = array(
            array('label' => 'CISOs & information security officers'),
            array('label' => 'Compliance, legal & risk'),
            array('label' => 'AppSec & product security'),
            array('label' => 'Product managers'),
            array('label' => 'Software architects'),
            array('label' => 'DevOps engineers'),
            array('label' => 'Developers & testers'),
        );
    }
    ?>
    <section class="pt-section alt section_sub_menu" id="layout_id_2">
        <div class="pt-wrap">
            <h2><?php echo mudt_pt_plain($who_title); ?></h2>
            <div class="pt-lead"><?php echo mudt_pt_html($who_lead); ?></div>
            <div class="pt-chips">
                <?php foreach ($who_chips as $chip) :
                    $label = is_array($chip) ? ($chip['label'] ?? '') : $chip;
                    if (!$label) continue;
                    ?>
                    <span><?php echo esc_html($label); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $ap_kicker = get_field('cra_approach_kicker') ?: 'Course approach';
    $ap_title = get_field('cra_approach_title') ?: 'Expert-led and built around your products';
    $ap_lead = get_field('cra_approach_lead') ?: 'Each day combines expert-led instruction with guided discussion and worked examples. Participants work through real CRA requirements and map them to realistic products - whether software, connected hardware or industrial systems, with practical rather than hypothetical scenarios. Because the course is designed for cross-functional groups, product, engineering, legal and security teams build a shared understanding of the law and what it means for their work. It ends with a structured action-planning session, so teams leave with concrete next steps rather than just notes.';
    $ap_chips = get_field('cra_approach_chips');
    if (empty($ap_chips)) {
        $ap_chips = array(
            array('label' => '3 days'),
            array('label' => '6-16 participants'),
            array('label' => 'On-site in Munich'),
            array('label' => 'Digital materials included'),
            array('label' => 'No prior CRA knowledge required'),
        );
    }
    ?>
    <section class="pt-section">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($ap_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($ap_title); ?></h2>
            <div class="pt-lead"><?php echo mudt_pt_html($ap_lead); ?></div>
            <div class="pt-chips" style="margin-top:6px">
                <?php foreach ($ap_chips as $chip) :
                    $label = is_array($chip) ? ($chip['label'] ?? '') : $chip;
                    if (!$label) continue;
                    ?>
                    <span><?php echo esc_html($label); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $out_title = get_field('cra_outcomes_title') ?: 'What you\'ll be able to do';
    $outcomes = get_field('cra_outcomes');
    if (empty($outcomes)) {
        $outcomes = array(
            array('text' => 'Assess your CRA exposure, product classification and obligations.'),
            array('text' => 'Run a compliant vulnerability-handling and incident-notification process (national CERT / ENISA).'),
            array('text' => 'Apply secure-by-design and secure-by-default across architecture and code.'),
            array('text' => 'Derive and demonstrate security requirements from threat modelling.'),
            array('text' => 'Self-assess against the CRA with OWASP SAMM and the ENISA playbook.'),
            array('text' => 'Handle post-release conformity, documentation and support duties.'),
        );
    }
    ?>
    <section class="pt-section alt">
        <div class="pt-wrap">
            <h2><?php echo mudt_pt_plain($out_title); ?></h2>
            <ul class="pt-check">
                <?php foreach ($outcomes as $item) :
                    $text = is_array($item) ? ($item['text'] ?? '') : $item;
                    if (!$text) continue;
                    ?>
                    <li><?php echo mudt_pt_html($text); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <?php
    $days_kicker = get_field('cra_days_kicker') ?: 'Topics outline';
    $days_title = get_field('cra_days_title') ?: 'What the three days cover';
    $days = get_field('cra_days');
    if (empty($days)) {
        $days = array(
            array(
                'badge' => 'Day 1',
                'title' => 'The CRA & notification obligations',
                'text' => 'The CRA at a glance - scope, classification, timeline, fines and effects on open source; notification obligations (active from 11 Sep 2026); Software & Hardware Bill of Materials and vulnerability management; external communication and regulatory reporting to national CERTs and ENISA.',
            ),
            array(
                'badge' => 'Day 2',
                'title' => 'Secure product development lifecycle',
                'text' => 'Architecture discovery and risk profiling; threat modelling in the CRA context; product and process security requirements; baseline maturity with OWASP SAMM; and the ENISA secure-by-design and secure-by-default principles.',
            ),
            array(
                'badge' => 'Day 3',
                'title' => 'Essential requirements, conformity & next steps',
                'text' => 'CRA essential requirements deep dive and self-assessment; declaration of conformity, technical and user documentation, and long-term support duties; closing with an action-planning session on the roles and next steps for your organisation.',
            ),
        );
    }
    ?>
    <section class="pt-section section_sub_menu" id="layout_id_3">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($days_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($days_title); ?></h2>
            <div class="pt-days">
                <?php foreach ($days as $day) : ?>
                    <div class="pt-day">
                        <?php if (!empty($day['badge'])) : ?>
                            <span class="pt-badge"><?php echo mudt_pt_plain($day['badge']); ?></span>
                        <?php endif; ?>
                        <h3><?php echo mudt_pt_plain($day['title'] ?? ''); ?></h3>
                        <div><?php echo mudt_pt_html($day['text'] ?? ''); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $fmt_title = get_field('cra_format_title') ?: 'Format & facilities';
    $fmt_lead_1 = get_field('cra_format_lead_1') ?: 'Delivered by the Center for Cyber Security and AI at MUDT, combining applied research with an expert partner network. Grounded in recognised frameworks - OWASP SAMM and the ENISA Secure-by-Design & Default playbook - so what you learn is repeatable and auditable.';
    $fmt_lead_2 = get_field('cra_format_lead_2') ?: 'This first cohort (31 Aug - 2 Sep 2026) runs fully on-site at MUDT on the Siemens Campus in Neuperlach, Munich. Further dates follow, and later cohorts can also be delivered fully remote.';
    $fmt_panel_title = get_field('cra_format_panel_title') ?: 'At a glance';
    $fmt_kv = get_field('cra_format_kv');
    if (empty($fmt_kv)) {
        $fmt_kv = array(
            array('label' => 'Dates', 'value' => '31 Aug - 2 Sep 2026 (first cohort)'),
            array('label' => 'Duration', 'value' => '3 days'),
            array('label' => 'Format', 'value' => 'On-site (first cohort)'),
            array('label' => 'Group size', 'value' => '6 - 16'),
            array('label' => 'Fee', 'value' => '€ 1,950 for the full course *'),
            array('label' => 'Language', 'value' => 'English'),
        );
    }
    $fmt_fee_note = get_field('cra_format_fee_note') ?: '* Per participant for all three days, excl. VAT - request a quote.';
    ?>
    <section class="pt-section alt section_sub_menu" id="layout_id_4">
        <div class="pt-wrap">
            <div class="pt-grid2">
                <div>
                    <h2><?php echo mudt_pt_plain($fmt_title); ?></h2>
                    <div class="pt-lead"><?php echo mudt_pt_html($fmt_lead_1); ?></div>
                    <div class="pt-lead"><?php echo mudt_pt_html($fmt_lead_2); ?></div>
                </div>
                <div class="pt-panel">
                    <h3><?php echo esc_html($fmt_panel_title); ?></h3>
                    <div class="pt-kv">
                        <?php foreach ($fmt_kv as $row) : ?>
                            <div>
                                <span><?php echo esc_html($row['label'] ?? ''); ?></span>
                                <b><?php echo esc_html($row['value'] ?? ''); ?></b>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($fmt_fee_note) : ?>
                        <p class="pt-reassure"><?php echo mudt_pt_plain($fmt_fee_note); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    $tr_kicker = get_field('cra_trainers_kicker') ?: 'Trainers';
    $tr_title = get_field('cra_trainers_title') ?: 'Who teaches';
    $trainers = get_field('cra_trainers');
    if (empty($trainers)) {
        $trainers = array(
            array(
                'photo_url' => 'https://securehabits.nl/wp-content/uploads/2024/10/2023_November_square-Medium.jpg',
                'photo_style' => '',
                'name' => 'Nariman Aga-Tagiyev',
                'role' => 'Product Security Architect',
                'bio' => 'Application Security Architect with more than 20 years in software development - full-stack, backend, DevOps and cloud - and fully focused on application security since 2016. He is a member of the CEN/CLC/JTC 13/WG9 that develops the CRA standards.',
                'link' => array('url' => 'https://www.linkedin.com/in/aganariman/', 'title' => 'LinkedIn profile'),
            ),
            array(
                'photo_url' => 'https://securehabits.nl/wp-content/uploads/2026/06/dagmar.KZEwhguV_2plRTu.webp',
                'photo_style' => 'contain',
                'name' => 'Dagmar Stefanie Moser',
                'role' => 'Consultant, Auditor and Lecturer',
                'bio' => 'Seasoned IT security expert and founder of blueheads GmbH, with over 25 years in IT architecture, secure software engineering and information security; certified ISO/IEC 27001 Lead Auditor and lecturer at MUDT.',
                'link' => array('url' => 'https://www.linkedin.com/in/dagmar-stefanie-moser-909777176/', 'title' => 'LinkedIn profile'),
            ),
        );
    }
    ?>
    <section class="pt-section section_sub_menu" id="layout_id_5">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($tr_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($tr_title); ?></h2>
            <div class="pt-cards">
                <?php foreach ($trainers as $trainer) :
                    $photo = $trainer['photo'] ?? null;
                    $photo_url = is_array($photo) && !empty($photo['url']) ? $photo['url'] : ($trainer['photo_url'] ?? '');
                    $style = $trainer['photo_style'] ?? '';
                    $link = $trainer['link'] ?? null;
                    ?>
                    <div class="pt-card person">
                        <?php if ($photo_url) : ?>
                            <img class="trainer<?php echo $style === 'contain' ? ' contain' : ''; ?>"
                                 src="<?php echo esc_url($photo_url); ?>"
                                 alt="<?php echo esc_attr($trainer['name'] ?? ''); ?>">
                        <?php endif; ?>
                        <div class="pbody">
                            <h3><?php echo mudt_pt_plain($trainer['name'] ?? ''); ?></h3>
                            <?php if (!empty($trainer['role'])) : ?>
                                <div class="role"><?php echo mudt_pt_plain($trainer['role']); ?></div>
                            <?php endif; ?>
                            <div><?php echo mudt_pt_html($trainer['bio'] ?? ''); ?></div>
                            <?php if (is_array($link) && !empty($link['url'])) : ?>
                                <a class="pt-btn" href="<?php echo esc_url($link['url']); ?>" target="_blank" rel="noopener"><?php echo esc_html($link['title'] ?: 'LinkedIn profile'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $faq_title = get_field('cra_faq_title') ?: 'Questions';
    $faqs = get_field('cra_faq');
    if (empty($faqs)) {
        $faqs = array(
            array('question' => 'Do I need a technical background?', 'answer' => 'No - the course is designed for a mix of security, compliance, product and engineering roles.'),
            array('question' => 'Can we book it for our own team?', 'answer' => 'Yes - in-house and team bookings are available on request.'),
            array('question' => 'On-site or remote?', 'answer' => 'The first cohort (31 Aug - 2 Sep 2026) runs fully on-site in Munich. We run the course regularly, and later cohorts can be delivered fully remote - register your interest and we\'ll match you to a suitable date.'),
            array('question' => 'What happens after 2 September?', 'answer' => 'Further dates follow - including remote cohorts. Register your interest for a later date.'),
        );
    }
    ?>
    <section class="pt-section alt">
        <div class="pt-wrap">
            <h2><?php echo mudt_pt_plain($faq_title); ?></h2>
            <div class="pt-faq">
                <?php foreach ($faqs as $faq) : ?>
                    <details>
                        <summary><?php echo mudt_pt_plain($faq['question'] ?? ''); ?></summary>
                        <div><?php echo mudt_pt_html($faq['answer'] ?? ''); ?></div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $eq_kicker = get_field('cra_enquire_kicker') ?: 'Get CRA-ready';
    $eq_title = get_field('cra_enquire_title') ?: 'Register or request a quote';
    $eq_lead = get_field('cra_enquire_lead') ?: 'Tell us a little about you and we\'ll come back within one working day.';
    ?>
    <section class="pt-section section_sub_menu" id="layout_id_6">
        <div class="pt-wrap">
            <div class="pt-kicker"><?php echo mudt_pt_plain($eq_kicker); ?></div>
            <h2><?php echo mudt_pt_plain($eq_title); ?></h2>
            <div class="pt-lead"><?php echo mudt_pt_html($eq_lead); ?></div>
            <div class="pt-enquire-form">
                <?php if ($form_shortcode) : ?>
                    <?php echo do_shortcode($form_shortcode); ?>
                <?php else : ?>
                    <div class="pt-enquire-missing">Add a Contact Form 7 shortcode in the ACF field <strong>CF7 shortcode</strong> on this page.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $wb_text = get_field('cra_webinar_text') ?: '<b>Free 60-minute webinar</b> - "CRA in practice: what to do before the deadlines" · 12 August 2026, 13:00-14:00';
    $wb_btn = get_field('cra_webinar_btn');
    $wb_btn_url = is_array($wb_btn) && !empty($wb_btn['url']) ? $wb_btn['url'] : '#layout_id_6';
    if ($wb_btn_url === '#enquire') {
        $wb_btn_url = '#layout_id_6';
    }
    $wb_btn_title = is_array($wb_btn) && !empty($wb_btn['title']) ? $wb_btn['title'] : 'Register for the webinar';
    $wb_note = get_field('cra_webinar_note') ?: 'Dates, figures and fees are indicative and to be confirmed.';
    ?>
    <section class="pt-section" id="webinar">
        <div class="pt-wrap">
            <div class="pt-webinar">
                <div><?php echo wp_kses_post($wb_text); ?></div>
                <a class="pt-btn" href="<?php echo esc_url($wb_btn_url); ?>"><?php echo esc_html($wb_btn_title); ?></a>
            </div>
            <?php if ($wb_note) : ?>
                <p class="pt-note"><?php echo mudt_pt_plain($wb_note); ?></p>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php get_footer(); ?>
