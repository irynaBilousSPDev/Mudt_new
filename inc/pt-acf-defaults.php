<?php
/**
 * First-load defaults + one-time "Sync content" admin button for PT / CRA pages.
 * After both pages are synced, delete this file and remove require_once from functions.php.
 */

function mudt_pt_acf_defaults()
{
    static $defaults = null;
    if ($defaults !== null) {
        return $defaults;
    }

    $cra_url = home_url('/cra-practitioner/');
    $pt_url = home_url('/professional-training/');

    $defaults = array(
        // —— Professional Training ——
        'pt_hero_eyebrow' => 'Professional Training',
        'pt_hero_title' => 'Training taught and delivered by the people who practise it',
        'pt_hero_sub' => 'Advanced courses for working professionals and their organisations - led by seasoned experts with years of hands-on experience in their field, backed by the university\'s academic standards and an established partner network.',
        'pt_hero_note' => '<b>First course: CRA Practitioner, 31 Aug - 2 Sep 2026</b> - on-site in Munich. Further dates will follow.',
        'pt_hero_cta_primary' => array(
            'title' => 'See the CRA Practitioner',
            'url' => $cra_url,
            'target' => '',
        ),
        'pt_hero_cta_secondary' => array(
            'title' => 'Explore the centers',
            'url' => '#centers',
            'target' => '',
        ),

        'pt_featured_kicker' => 'First course',
        'pt_featured_title' => 'CRA Practitioner',
        'pt_featured_lead' => 'The EU Cyber Resilience Act, from regulation to engineering practice. A 3-day practitioner course for the cross-functional teams that have to implement it.',
        'pt_featured_badge' => 'Enrolling now',
        'pt_featured_heading' => 'Get CRA-ready before the deadlines',
        'pt_featured_text' => 'Notification obligations apply from 11 September 2026 and the essential requirements from 11 December 2027, with fines of up to € 15 million or 2.5% of global annual turnover. This course turns the regulation into concrete processes, architecture and evidence.',
        'pt_featured_tags' => array(
            array('label' => '31 Aug - 2 Sep 2026'),
            array('label' => '3 days'),
            array('label' => 'On-site · Munich'),
            array('label' => 'English'),
            array('label' => '6-16 participants'),
        ),
        'pt_featured_btn' => array(
            'title' => 'Course details →',
            'url' => $cra_url,
            'target' => '',
        ),
        'pt_featured_quote' => array(
            'title' => 'Request a quote',
            'url' => '#enquire',
            'target' => '',
        ),
        'pt_featured_side_title' => 'At a glance',
        'pt_featured_kv' => array(
            array('label' => 'Fee', 'value' => '€ 1,950'),
            array('label' => 'Level', 'value' => 'Practitioner'),
            array('label' => 'Format', 'value' => 'On-site'),
            array('label' => 'Venue', 'value' => 'Siemens Campus'),
        ),

        'pt_catalogue_kicker' => 'Course catalogue',
        'pt_catalogue_title' => 'Our courses',
        'pt_catalogue_lead' => 'We open with the AppSec track and a current, urgent topic. Further courses follow in AppSec and in Compliance, Regulations and Frameworks.',
        'pt_courses' => array(
            array(
                'badge' => 'Open now',
                'badge_grey' => 0,
                'soon' => 0,
                'title' => 'CRA Practitioner',
                'text' => 'A 3-day practitioner course that turns the EU Cyber Resilience Act from legal text into engineering and compliance practice.',
                'link' => array(
                    'title' => 'Course details',
                    'url' => $cra_url,
                    'target' => '',
                ),
            ),
            array(
                'badge' => 'Coming soon',
                'badge_grey' => 1,
                'soon' => 1,
                'title' => 'AppSec track',
                'text' => 'Threat Modelling, Security Architecture, OWASP SAMM, Secure Coding, DevSecOps, SBOM & supply chain, AI for secure development.',
                'link' => array(
                    'title' => '',
                    'url' => '',
                    'target' => '',
                ),
            ),
            array(
                'badge' => 'Coming soon',
                'badge_grey' => 1,
                'soon' => 1,
                'title' => 'Compliance, Regulations & Frameworks',
                'text' => 'EU cybersecurity regulation landscape (NIS2, DORA, AI Act, CRA), the EU AI Act, and NIS2.',
                'link' => array(
                    'title' => '',
                    'url' => '',
                    'target' => '',
                ),
            ),
        ),

        'pt_centers_kicker' => 'The centers',
        'pt_centers_title' => 'Our centers',
        'pt_centers_lead' => 'Our professional training is organised in centers. Each center brings together a clear theme, a faculty of experienced practitioners and an established partner network. Centers and their offerings grow over time; the first is the Center for Cyber Security and AI.',
        'pt_centers' => array(
            array(
                'badge' => 'Open now',
                'badge_grey' => 0,
                'soon' => 0,
                'title' => 'Center for Cyber Security and AI',
                'text' => 'Training on secure software, the EU Cyber Resilience Act and applied AI security - grounded in recognised frameworks and led by experienced security professionals. First course: CRA Practitioner.',
                'link' => array(
                    'title' => 'Visit the center',
                    'url' => '#',
                    'target' => '',
                ),
            ),
            array(
                'badge' => 'Coming soon',
                'badge_grey' => 1,
                'soon' => 1,
                'title' => 'Further centers',
                'text' => 'Additional centers will follow, extending the model to new themes, faculties and partner networks.',
                'link' => array(
                    'title' => '',
                    'url' => '',
                    'target' => '',
                ),
            ),
        ),

        'pt_why_kicker' => 'Why train with us',
        'pt_why_title' => 'What sets our training apart',
        'pt_why_cards' => array(
            array(
                'title' => 'Taught by practitioners',
                'text' => 'Every course is led by specialists with many years of hands-on experience - professionals who have built, secured and audited real systems, not only studied them.',
            ),
            array(
                'title' => 'Practice over theory',
                'text' => 'Small groups, concrete methods and tools you can apply the next day. Participants leave with a shared vocabulary and concrete next steps, not just slides.',
            ),
            array(
                'title' => 'University rigour, industry reach',
                'text' => 'The academic standards of MUDT combined with an active partner network, so what you learn is current, recognised and repeatable long after the course.',
            ),
        ),

        'pt_workshops_kicker' => 'Beyond training',
        'pt_workshops_title' => 'Workshops and consulting',
        'pt_workshops_lead' => 'The same experts who teach also work with organisations directly - at the depth you need.',
        'pt_workshops_cards' => array(
            array(
                'title' => 'In-house workshops',
                'text' => 'Tailored sessions delivered for a single organisation and built around your products, stack and goals - the fastest way to bring a whole team to a shared level.',
                'link' => array(
                    'title' => 'Enquire',
                    'url' => '#enquire',
                    'target' => '',
                ),
            ),
            array(
                'title' => 'Consulting & advisory',
                'text' => 'Hands-on support on your real projects: assessments, architecture and process reviews, compliance guidance and expert advice - from the same practitioners who teach the courses.',
                'link' => array(
                    'title' => 'Discuss an engagement',
                    'url' => '#enquire',
                    'target' => '',
                ),
            ),
        ),

        'pt_enquire_kicker' => 'Get in touch',
        'pt_enquire_title' => 'Training, workshops or consulting - let\'s talk',
        'pt_enquire_lead' => 'Whatever you need - a scheduled course, an in-house workshop, a session on a special topic, or hands-on consulting on your own project - tell us and we will get back to you within one working day.',
        'pt_enquire_note' => 'Dates, figures and fees are indicative and to be confirmed.',
        'pt_form_shortcode' => '',

        // —— CRA Practitioner ——
        'cra_crumb_pt' => array(
            'title' => 'Professional Training',
            'url' => $pt_url,
            'target' => '',
        ),
        'cra_crumb_center' => array(
            'title' => 'Center for Cyber Security and AI',
            'url' => '#',
            'target' => '',
        ),
        'cra_crumb_current' => 'CRA Practitioner',

        'cra_hero_eyebrow' => 'Professional Centers › Center for Cyber Security and AI › CRA Practitioner',
        'cra_hero_title' => 'CRA Practitioner',
        'cra_hero_sub' => 'The EU Cyber Resilience Act - from regulation to engineering practice. A 3-day practitioner course for the teams that have to implement it.',
        'cra_hero_note' => '<b>First cohort: 31 Aug - 2 Sep 2026</b> - further dates will follow. In-house courses for a single organisation are available on request.',
        'cra_hero_cta_primary' => array(
            'title' => 'Register / request a call',
            'url' => '#enquire',
            'target' => '',
        ),
        'cra_hero_cta_secondary' => array(
            'title' => 'Join the free CRA webinar',
            'url' => '#webinar',
            'target' => '',
        ),
        'cra_hero_facts' => array(
            array('label' => '31 Aug - 2 Sep 2026'),
            array('label' => '3 days'),
            array('label' => 'On-site · Siemens Campus, Neuperlach'),
            array('label' => 'English'),
            array('label' => 'Small group (6-16)'),
        ),

        'cra_why_kicker' => 'Why now',
        'cra_why_title' => 'The deadlines are no longer on the horizon',
        'cra_why_lead' => 'Unlike earlier guidance, the CRA carries real enforcement: fines of up to €15 million or 2.5% of global annual turnover, and the authority to withdraw non-compliant products from the EU market. Its notification obligations apply from 11 September 2026 and its essential requirements from 11 December 2027. Building the vulnerability tracking, incident detection and reporting workflows the CRA requires takes months - this course gives your team the shared understanding to start building the right things straight away.',

        'cra_who_title' => 'Who it\'s for',
        'cra_who_lead' => 'The cross-functional roles that have to implement the CRA. It is relevant to anyone who touches a product that falls under the CRA, not just the security team - and no prior CRA knowledge is required. Best attended as a team - you leave with a shared vocabulary and an aligned view of who does what.',
        'cra_who_chips' => array(
            array('label' => 'CISOs & information security officers'),
            array('label' => 'Compliance, legal & risk'),
            array('label' => 'AppSec & product security'),
            array('label' => 'Product managers'),
            array('label' => 'Software architects'),
            array('label' => 'DevOps engineers'),
            array('label' => 'Developers & testers'),
        ),

        'cra_approach_kicker' => 'Course approach',
        'cra_approach_title' => 'Expert-led and built around your products',
        'cra_approach_lead' => 'Each day combines expert-led instruction with guided discussion and worked examples. Participants work through real CRA requirements and map them to realistic products - whether software, connected hardware or industrial systems, with practical rather than hypothetical scenarios. Because the course is designed for cross-functional groups, product, engineering, legal and security teams build a shared understanding of the law and what it means for their work. It ends with a structured action-planning session, so teams leave with concrete next steps rather than just notes.',
        'cra_approach_chips' => array(
            array('label' => '3 days'),
            array('label' => '6-16 participants'),
            array('label' => 'On-site in Munich'),
            array('label' => 'Digital materials included'),
            array('label' => 'No prior CRA knowledge required'),
        ),

        'cra_outcomes_title' => 'What you\'ll be able to do',
        'cra_outcomes' => array(
            array('text' => 'Assess your CRA exposure, product classification and obligations.'),
            array('text' => 'Run a compliant vulnerability-handling and incident-notification process (national CERT / ENISA).'),
            array('text' => 'Apply secure-by-design and secure-by-default across architecture and code.'),
            array('text' => 'Derive and demonstrate security requirements from threat modelling.'),
            array('text' => 'Self-assess against the CRA with OWASP SAMM and the ENISA playbook.'),
            array('text' => 'Handle post-release conformity, documentation and support duties.'),
        ),

        'cra_days_kicker' => 'Topics outline',
        'cra_days_title' => 'What the three days cover',
        'cra_days' => array(
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
        ),

        'cra_format_title' => 'Format & facilities',
        'cra_format_lead_1' => 'Delivered by the Center for Cyber Security and AI at MUDT, combining applied research with an expert partner network. Grounded in recognised frameworks - OWASP SAMM and the ENISA Secure-by-Design & Default playbook - so what you learn is repeatable and auditable.',
        'cra_format_lead_2' => 'This first cohort (31 Aug - 2 Sep 2026) runs fully on-site at MUDT on the Siemens Campus in Neuperlach, Munich. Further dates follow, and later cohorts can also be delivered fully remote.',
        'cra_format_panel_title' => 'At a glance',
        'cra_format_kv' => array(
            array('label' => 'Dates', 'value' => '31 Aug - 2 Sep 2026 (first cohort)'),
            array('label' => 'Duration', 'value' => '3 days'),
            array('label' => 'Format', 'value' => 'On-site (first cohort)'),
            array('label' => 'Group size', 'value' => '6 - 16'),
            array('label' => 'Fee', 'value' => '€ 1,950 for the full course *'),
            array('label' => 'Language', 'value' => 'English'),
        ),
        'cra_format_fee_note' => '* Per participant for all three days, excl. VAT - request a quote.',

        'cra_trainers_kicker' => 'Trainers',
        'cra_trainers_title' => 'Who teaches',
        'cra_trainers' => array(
            array(
                'photo_url' => 'https://securehabits.nl/wp-content/uploads/2024/10/2023_November_square-Medium.jpg',
                'photo_style' => '',
                'name' => 'Nariman Aga-Tagiyev',
                'role' => 'Product Security Architect',
                'bio' => 'Application Security Architect with more than 20 years in software development - full-stack, backend, DevOps and cloud - and fully focused on application security since 2016. He is a member of the CEN/CLC/JTC 13/WG9 that develops the CRA standards.',
                'link' => array(
                    'title' => 'LinkedIn profile',
                    'url' => 'https://www.linkedin.com/in/aganariman/',
                    'target' => '',
                ),
            ),
            array(
                'photo_url' => 'https://securehabits.nl/wp-content/uploads/2026/06/dagmar.KZEwhguV_2plRTu.webp',
                'photo_style' => 'contain',
                'name' => 'Dagmar Stefanie Moser',
                'role' => 'Consultant, Auditor and Lecturer',
                'bio' => 'Seasoned IT security expert and founder of blueheads GmbH, with over 25 years in IT architecture, secure software engineering and information security; certified ISO/IEC 27001 Lead Auditor and lecturer at MUDT.',
                'link' => array(
                    'title' => 'LinkedIn profile',
                    'url' => 'https://www.linkedin.com/in/dagmar-stefanie-moser-909777176/',
                    'target' => '',
                ),
            ),
        ),

        'cra_faq_title' => 'Questions',
        'cra_faq' => array(
            array(
                'question' => 'Do I need a technical background?',
                'answer' => 'No - the course is designed for a mix of security, compliance, product and engineering roles.',
            ),
            array(
                'question' => 'Can we book it for our own team?',
                'answer' => 'Yes - in-house and team bookings are available on request.',
            ),
            array(
                'question' => 'On-site or remote?',
                'answer' => 'The first cohort (31 Aug - 2 Sep 2026) runs fully on-site in Munich. We run the course regularly, and later cohorts can be delivered fully remote - register your interest and we\'ll match you to a suitable date.',
            ),
            array(
                'question' => 'What happens after 2 September?',
                'answer' => 'Further dates follow - including remote cohorts. Register your interest for a later date.',
            ),
        ),

        'cra_enquire_kicker' => 'Get CRA-ready',
        'cra_enquire_title' => 'Register or request a quote',
        'cra_enquire_lead' => 'Tell us a little about you and we\'ll come back within one working day.',
        'cra_form_shortcode' => '',

        'cra_webinar_text' => '<b>Free 60-minute webinar</b> - "CRA in practice: what to do before the deadlines" · 12 August 2026, 13:00-14:00',
        'cra_webinar_btn' => array(
            'title' => 'Register for the webinar',
            'url' => '#enquire',
            'target' => '',
        ),
        'cra_webinar_note' => 'Dates, figures and fees are indicative and to be confirmed.',
    );

    return $defaults;
}

/**
 * Safe HTML from ACF textarea/wysiwyg (wpautop may wrap in <p>).
 */
function mudt_pt_html($value)
{
    if ($value === null || $value === false || $value === '') {
        return '';
    }
    return wp_kses_post($value);
}

/**
 * Plain text for titles / labels (strip any ACF <p> wrappers).
 */
function mudt_pt_plain($value)
{
    if ($value === null || $value === false || $value === '') {
        return '';
    }
    return esc_html(wp_strip_all_tags((string) $value));
}

/**
 * Page templates that use the PT content sync button.
 */
function mudt_pt_sync_templates()
{
    return array(
        'page-professional-training.php',
        'page-cra-practitioner.php',
    );
}

function mudt_pt_is_sync_template($post_id)
{
    if (!$post_id || !is_numeric($post_id)) {
        return false;
    }
    return in_array(get_page_template_slug((int) $post_id), mudt_pt_sync_templates(), true);
}

function mudt_pt_content_is_synced($post_id)
{
    return (bool) get_post_meta((int) $post_id, '_mudt_pt_content_synced', true);
}

/**
 * Write all template defaults into ACF fields for this page.
 */
function mudt_pt_sync_content_to_post($post_id)
{
    $post_id = (int) $post_id;
    if (!mudt_pt_is_sync_template($post_id) || !function_exists('update_field')) {
        return false;
    }

    $template = get_page_template_slug($post_id);
    $defaults = mudt_pt_acf_defaults();
    $prefix = ($template === 'page-cra-practitioner.php') ? 'cra_' : 'pt_';

    foreach ($defaults as $name => $value) {
        if (strpos($name, $prefix) !== 0) {
            continue;
        }
        update_field($name, $value, $post_id);
    }

    update_post_meta($post_id, '_mudt_pt_content_synced', 1);
    // Clear old auto-seed flag if present from earlier approach.
    delete_post_meta($post_id, '_mudt_pt_defaults_applied');

    return true;
}

/**
 * Admin metabox: one-time "Sync content" button.
 * After sync, the button is hidden. Later you can remove this whole block + require from functions.php.
 */
add_action('add_meta_boxes', function () {
    foreach (array('page') as $screen) {
        add_meta_box(
            'mudt_pt_sync_content',
            'PT content sync',
            'mudt_pt_sync_content_metabox',
            $screen,
            'side',
            'high'
        );
    }
});

function mudt_pt_sync_content_metabox($post)
{
    if (!mudt_pt_is_sync_template($post->ID)) {
        echo '<p style="margin:0;color:#646970;">Assign template <strong>Professional Training</strong> or <strong>CRA Practitioner</strong> to use sync.</p>';
        return;
    }

    if (mudt_pt_content_is_synced($post->ID)) {
        echo '<p style="margin:0 0 8px;"><strong style="color:#008a20;">Content synced</strong></p>';
        echo '<p style="margin:0;color:#646970;font-size:12px;">ACF fields were filled from the HTML template. You can edit them normally. When both pages are done, remove <code>inc/pt-acf-defaults.php</code> and its <code>require_once</code> from <code>functions.php</code>.</p>';
        return;
    }

    $url = wp_nonce_url(
        admin_url('admin-post.php?action=mudt_pt_sync_content&post_id=' . (int) $post->ID),
        'mudt_pt_sync_content_' . (int) $post->ID
    );

    echo '<p style="margin:0 0 10px;">Fill all ACF fields (including repeaters) from the HTML template copy. One-time action.</p>';
    echo '<p style="margin:0;"><a class="button button-primary" href="' . esc_url($url) . '">Sync content</a></p>';
}

add_action('admin_post_mudt_pt_sync_content', function () {
    $post_id = isset($_GET['post_id']) ? (int) $_GET['post_id'] : 0;

    if (!$post_id || !current_user_can('edit_post', $post_id)) {
        wp_die('Forbidden');
    }

    check_admin_referer('mudt_pt_sync_content_' . $post_id);

    if (!mudt_pt_is_sync_template($post_id)) {
        wp_die('Wrong page template.');
    }

    mudt_pt_sync_content_to_post($post_id);

    wp_safe_redirect(get_edit_post_link($post_id, 'raw'));
    exit;
});
