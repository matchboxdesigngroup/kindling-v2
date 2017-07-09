<?php
/**
 * Post tag template.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

?>
@extends('layouts.base')

@section('content')
<?php
get_template_part('templates/partials/page-header');
get_template_part('templates/content/news');
?>
@endsection
