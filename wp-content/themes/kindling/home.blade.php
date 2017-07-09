<?php
/**
 * Post roll template.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */
?>
@extends('layouts.base')

@section('content')
@include('partials.page-header')
<?php
get_template_part('templates/news');
?>
@endsection
