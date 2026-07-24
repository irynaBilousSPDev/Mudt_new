<?php
/**
 * Contact Form 7 helpers for Professional Training forms
 * (moved from functions.php — behavior unchanged).
 */

function mudt_pt_cf7_shortcode($value)
{
    if ($value instanceof WP_Post) {
        $value = $value->ID;
    }

    if (is_numeric($value) && (int) $value > 0) {
        return '[contact-form-7 id="' . (int) $value . '"]';
    }

    if (is_string($value)) {
        $value = trim($value);
        if ($value !== '' && strpos($value, '[contact-form-7') === 0) {
            return $value;
        }
    }

    return '';
}

function mudt_pt_cf7_is_pt_form($contact_form)
{
    if (!$contact_form instanceof WPCF7_ContactForm) {
        return false;
    }
    $form = (string) $contact_form->prop('form');
    return strpos($form, 'pt-cf7') !== false;
}

function mudt_pt_cf7_messages_map()
{
    return array(
        'mail_sent_ok' => 'Thank you — your enquiry has been sent. We will get back to you within one working day.',
        'mail_sent_ng' => 'Sorry, something went wrong while sending. Please try again or contact us directly.',
        'validation_error' => 'Please check the highlighted fields and try again.',
        'spam' => 'Sorry, something went wrong while sending. Please try again or contact us directly.',
        'accept_terms' => 'You must accept the terms and conditions before sending your message.',
    );
}

add_filter('wpcf7_contact_form_properties', function ($properties, $contact_form) {
    if (!mudt_pt_cf7_is_pt_form($contact_form)) {
        return $properties;
    }
    if (!isset($properties['messages']) || !is_array($properties['messages'])) {
        $properties['messages'] = array();
    }
    foreach (mudt_pt_cf7_messages_map() as $key => $text) {
        $properties['messages'][$key] = $text;
    }
    return $properties;
}, 10, 2);

add_filter('wpcf7_display_message', function ($message, $status) {
    $contact_form = function_exists('wpcf7_get_current_contact_form')
        ? wpcf7_get_current_contact_form()
        : null;
    if (!$contact_form || !mudt_pt_cf7_is_pt_form($contact_form)) {
        return $message;
    }
    $messages = mudt_pt_cf7_messages_map();
    return $messages[$status] ?? $message;
}, 10, 2);

function mudt_pt_enqueue_cf7_feedback_script()
{
    wp_register_script('pt-cf7-feedback', '', array(), null, true);
    wp_enqueue_script('pt-cf7-feedback');
    wp_add_inline_script(
        'pt-cf7-feedback',
        "document.addEventListener('wpcf7submit',function(e){var f=e.target;if(!f||!f.closest('.pt-enquire-form'))return;f.querySelectorAll('.wpcf7-response-output').forEach(function(el){el.removeAttribute('aria-hidden');});var m=f.querySelector('.wpcf7-response-output:not(:empty)');if(m)m.scrollIntoView({behavior:'smooth',block:'nearest'});});"
    );
}
