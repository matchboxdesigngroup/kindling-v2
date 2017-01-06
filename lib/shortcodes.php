<?php
/**
 * All WordPress ShortCodes should be added here.
 *
 * @see http://codex.wordpress.org/Shortcode_API
 *
 * @package      WordPress
 * @subpackage   Kindling
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */


/**
 * Adds a simple divider.
 * <code>[divider]</code>
 *
 * @return  string  The divider HTML.
 */
function mdg_divider_shortcode() {
	return '<div class="divider"></div>';
} // mdg_divider_shortcode()
add_shortcode( 'divider', 'mdg_divider_shortcode' );


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
function mdg_col_half( $atts, $content ) {
	$html  = '<div class="col-half fitvid">';
	$html .= apply_filters( 'the_content', $content );
	$html .= '</div>';
	return $html;
} // mdg_col_half
add_shortcode( 'col-half','mdg_col_half' );


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
function mdg_col_third( $atts, $content ) {
	$html  = '<div class="col-third fitvid">';
	$html .= apply_filters( 'the_content', $content );
	$html .= '</div>';
	return $html;
} // mdg_col_third
add_shortcode( 'col-third','mdg_col_third' );


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
function mdg_col_quarter( $atts, $content ) {
	$html  = '<div class="col-quarter fitvid">';
	$html .= apply_filters( 'the_content', $content );
	$html .= '</div>';
	return $html;
} // mdg_col_quarter
add_shortcode( 'col-quarter','mdg_col_quarter' );


/**
 * Adds a clearing div.
 *
 * <code>[clear]</code>
 *
 * @param   array   $atts     ShortCode attributes.
 *
 * @return  string            The div with .clear.
 */
function mdg_clear_shortcode( $atts ) {
	$atts = extract( shortcode_atts( array(),$atts ) );

	return '<div class="clear"></div>';
} // mdg_clear_shortcode()
add_shortcode( 'clear','mdg_clear_shortcode' );

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
function mdg_row_shortcode( $atts, $content ) {
	$content = apply_filters( 'the_content', $content );
	return "<div class='row'>{$content}</div>";
}
add_shortcode( 'row','mdg_row_shortcode' );
