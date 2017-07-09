<?php
/**
 * Shortcode Examples.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

?>
<h3>2 Columns</h3>
<?php
$rowOpen = "[row]\n";
$rowClose = "\n[/row]";
$twoColumns = "{$rowOpen}[col-half]\nColumn 1\n[/col-half]\n\n";
$twoColumns .= "[col-half]\nColumn 2\n[/col-half]{$rowClose}";
echo $twoColumns;
echo '<pre>' . str_replace('[', '<span>[</span>', $twoColumns) . '</pre>';
?>

<h3>3 Columns</h3>
<?php
$rowOpen = "[row]\n";
$rowClose = "\n[/row]";
$threeColumns = "{$rowOpen}[col-third]\nColumn 1\n[/col-third]\n\n";
$threeColumns .= "[col-third]\nColumn 2\n[/col-third]\n\n";
$threeColumns .= "[col-third]\nColumn 3\n[/col-third]{$rowClose}";
echo $threeColumns;
echo '<pre>' . str_replace('[', '<span>[</span>', $threeColumns) . '</pre>';
?>

<h3>4 Columns</h3>
<?php
$rowOpen = "[row]\n";
$rowClose = "\n[/row]";
$fourColumns = "{$rowOpen}[col-quarter]\nColumn 1\n[/col-quarter]\n\n";
$fourColumns .= "[col-quarter]\nColumn 2\n[/col-quarter]\n\n";
$fourColumns .= "[col-quarter]\nColumn 3\n[/col-quarter]\n\n";
$fourColumns .= "[col-quarter]\nColumn 4\n[/col-quarter]{$rowClose}";
echo $fourColumns;
echo '<pre>' . str_replace('[', '<span>[</span>', $fourColumns) . '</pre>';
?>

<h3>Clear content</h3>
<pre><span>[</span>clear]</pre>

<h3>Button</h3>
[button link="#link" new-tab="1"]
Opens in new tab
[/button]

<pre>
<span>[</span>button link="#link" new-tab="1"]
Opens in new tab
<span>[</span>/button]
</pre>

[button link="#link"]
Opens in same tab
[/button]
<pre>
<span>[</span>button link="#link"]
Opens in same tab
<span>[</span>/button]
</pre>
