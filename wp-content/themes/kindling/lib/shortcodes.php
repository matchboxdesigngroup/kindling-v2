<?php
/**
 * All WordPress ShortCodes should be added here.
 *
 * @see http://codex.wordpress.org/Shortcode_API
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Adds a simple divider.
 * <code>[divider]</code>
 *
 * @return  string  The divider HTML.
 */
add_shortcode('divider', function () {
    return '<div class="divider"></div>';
});

/**
 * Creates a 50% column
 *
 * <code>
 * [col-half]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-half]
 *
 * [col-half]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-half]
 * [/clear]
 *
 *
 * @param   array   $atts     ShortCode attributes.
 * @param   string  $content  ShortCode inner content.
 *
 * @return  string            HTML for 50% column with content.
 */
add_shortcode('col-half', function ($atts, $content) {
    $html  = '<div class="col-half fitvid">';
    $html .= apply_filters('the_content', $content);
    $html .= '</div>';
    return $html;
});

/**
 * Creates a 33.3333% column
 *
 * <code>
 * [col-third]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-third]
 *
 * [col-third]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-third]
 *
 * [col-third]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-third]
 * [/clear]
 * </code>
 *
 * @param   array   $atts     ShortCode attributes.
 * @param   string  $content  ShortCode inner content.
 *
 * @return  string            HTML for 33.3333% column with content.
 */
add_shortcode('col-third', function ($atts, $content) {
    $html  = '<div class="col-third fitvid">';
    $html .= apply_filters('the_content', $content);
    $html .= '</div>';
    return $html;
});

/**
 * Creates a 25% column
 *
 * <code>
 * [col-quarter]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-quarter]
 *
 * [col-quarter]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-quarter]
 *
 * [col-quarter]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-quarter]
 *
 * [col-quarter]
 * Curabitur faucibus non justo eu sollicitudin. Sed risus purus, volutpat.
 * [/col-quarter]
 * [/clear]
 * </code>
 *
 * @param   array   $atts     ShortCode attributes.
 * @param   string  $content  ShortCode inner content.
 *
 * @return  string            HTML for 25% column with content.
 */
add_shortcode('col-quarter', function ($atts, $content) {
    $html  = '<div class="col-quarter fitvid">';
    $html .= apply_filters('the_content', $content);
    $html .= '</div>';
    return $html;
});

/**
 * Adds a clearing div.
 *
 * <code>[clear]</code>
 *
 * @param   array   $atts     ShortCode attributes.
 *
 * @return  string            The div with .clear.
 */
add_shortcode('clear', function ($atts) {
    $atts = extract(shortcode_atts([], $atts));

    return '<div class="clear"></div>';
});

/**
 * Adds row shortcode.
 *
 * <code>
 * [row]
 * Content
 * [/row]
 * </code>
 *
 * @param   array  $atts    ShortCode attributes.
 * @param   string $content ShortCode inner content.
 *
 * @return string           The row HTML.
 */
add_shortcode('row', function ($atts, $content) {
    $content = apply_filters('the_content', $content);
    return "<div class='row'>{$content}</div>";
});
