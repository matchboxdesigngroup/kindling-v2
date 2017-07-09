<?php
/**
 * 404 page template.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */
?>
@extends('layouts.base')

@section('content')
<?php get_template_part('templates/page-header'); ?>

<div class="alert alert-warning">
    <?php _e('Sorry, but the page you were trying to view does not exist.', 'kindling'); ?>
</div>

<?php get_search_form(); ?>
@endsection
