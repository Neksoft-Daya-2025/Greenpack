<?php
/** Language-specific labels for the Greenpack header contact buttons. */
add_filter('elementor/widget/render_content', function ($content, $widget) {
    if (!in_array($widget->get_id(), ['4a8f7ad', 'd525486', '5c0344c', '18ae5db'], true)) {
        return $content;
    }
    global $TRP_LANGUAGE;
    $label = $TRP_LANGUAGE === 'en_US' ? 'Get In Touch' : 'Contactează-ne';
    return preg_replace(
        '/(<span\s+class="ekit_creative_button_text")>([^<]*)<\/span>/',
        '$1 data-no-translation>' . esc_html($label) . '</span>',
        $content
    );
}, 20, 2);
