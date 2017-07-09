<?php
/**
 * Template Name: Example Pate Template
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */
?>
@extends('layouts.base')

@section('content')
<?php get_template_part('templates/partials/page-header'); ?>
<!-- Place somewhere in the <body> of your page -->
<div class="flexslider">
  <ul class="slides">
    <li>
      <img src="https://placeholdit.imgix.net/~text?txtsize=98&txt=1170%C3%97740&w=1170&h=740" />
    </li>
    <li>
      <img src="https://placeholdit.imgix.net/~text?txtsize=98&txt=1170%C3%97740&w=1170&h=740" />
    </li>
    <li>
      <img src="https://placeholdit.imgix.net/~text?txtsize=98&txt=1170%C3%97740&w=1170&h=740" />
    </li>
    <li>
      <img src="https://placeholdit.imgix.net/~text?txtsize=98&txt=1170%C3%97740&w=1170&h=740" />
    </li>
  </ul>
</div>

<div class="content-loop">
    <h1>H1</h1>

    <h2>H2</h2>

    <h3>H3</h3>

    <h4>H4</h4>

    <h5>H5</h5>

    <h6>H6</h6>

    <p>
        Lorem ipsum <a href="#">link</a>&nbsp;sit amet, consectetur adipiscing elit. Vestibulum eu nibh vel lacus accumsan dapibus. Fusce sit amet malesuada turpis, vel facilisis eros. Donec venenatis vestibulum massa, in bibendum est cursus sed. Nunc vel <strong>bold</strong>&nbsp;turpis. Sed risus enim, convallis vitae nulla elementum, vehicula consequat augue. Lorem ipsum dolor sit amet, <em>italic</em>&nbsp;adipiscing elit. Proin congue laoreet tellus quis mollis. Morbi eget turpis est. Fusce gravida at tortor ut pulvinar. Sed efficitur sem eget lacus vulputate, at blandit quam aliquam. Nullam et velit ut nulla aliquam vehicula.
    </p>

    <pre>Aliquam condimentum, libero sed consectetur maximus, justo eros fringilla purus, nec varius metus lectus sit amet odio. Sed feugiat nisi lacus, ut hendrerit tortor mollis quis. Etiam ut facilisis ante. Aenean vel quam quis ex consequat elementum id et tellus.</pre>

    <p>
        In eget ligula id ex semper consectetur. Proin pulvinar placerat varius. Nunc vel elementum risus. Praesent efficitur maximus ultricies. Quisque lobortis dui ultricies orci aliquet scelerisque. Vivamus sit amet nisi laoreet erat finibus commodo. Duis vitae sapien tincidunt nulla sollicitudin sollicitudin vel fringilla eros. Nullam viverra eros at nisl volutpat, quis rhoncus neque auctor. <strong>Proin turpis tellus, vehicula nec ornare sed, accumsan in lacus.</strong> Phasellus aliquet, metus non pulvinar porta, nisl lacus sagittis nulla, a pharetra arcu lectus eu nunc. Curabitur <del>strikethrough</del>&nbsp;viverra ultrices. Curabitur augue odio, dignissim non felis sed, faucibus suscipit nisi. Curabitur ullamcorper, enim sed auctor accumsan, ipsum mauris egestas risus, sed tincidunt purus lorem et tortor.
    </p>

    <hr>

    <p style="text-align: left;">
        Aliquam quis magna nunc. Sed convallis dictum efficitur. Mauris volutpat velit in felis pharetra, nec bibendum urna cursus. Duis vitae nisi eget nunc luctus ultricies ornare sit amet arcu. In ut lorem eros. Nam sit amet molestie arcu. Vestibulum luctus convallis justo vel congue. Integer dui orci, venenatis ac accumsan in, rhoncus eu velit. Morbi a nisi arcu.
    </p>
    <p style="text-align: center;">
        Aliquam quis magna nunc. Sed convallis dictum efficitur. Mauris volutpat velit in felis pharetra, nec bibendum urna cursus. Duis vitae nisi eget nunc luctus ultricies ornare sit amet arcu. In ut lorem eros. Nam sit amet molestie arcu. Vestibulum luctus convallis justo vel congue. Integer dui orci, venenatis ac accumsan in, rhoncus eu velit. Morbi a nisi arcu.
    </p>
    <p style="text-align: right;">
        Aliquam quis magna nunc. Sed convallis dictum efficitur. Mauris volutpat velit in felis pharetra, nec bibendum urna cursus. Duis vitae nisi eget nunc luctus ultricies ornare sit amet arcu. In ut lorem eros. Nam sit amet molestie arcu. Vestibulum luctus convallis justo vel congue. Integer dui orci, venenatis ac accumsan in, rhoncus eu velit. Morbi a nisi arcu.
    </p>
    <p style="text-align: left;">
        Quisque lobortis dui ultricies orci aliquet scelerisque.<br>
        Vivamus sit amet nisi laoreet erat finibus commodo.<br>
        Duis vitae sapien tincidunt nulla sollicitudin sollicitudin vel fringilla eros.
    </p>

    <blockquote>
        <p>
            Nullam viverra eros at nisl volutpat, quis rhoncus neque auctor.
        </p>
    </blockquote>

    <p style="text-align: left;">
        Proin turpis tellus, vehicula nec ornare sed, accumsan in lacus.<br>
        In ut lorem eros. Nam sit amet molestie arcu.<br>
        Aliquam quis magna nunc. Sed convallis dictum efficitur.

    </p>

    <ul>
        <li>Quisque lobortis dui ultricies orci aliquet scelerisque.</li>
        <li>Vivamus sit amet nisi laoreet erat finibus commodo.</li>
        <li>Duis vitae sapien tincidunt nulla sollicitudin sollicitudin vel fringilla eros.</li>
        <li>Nullam viverra eros at nisl volutpat, quis rhoncus neque auctor.</li>
        <li>Proin turpis tellus, vehicula nec ornare sed, accumsan in lacus.</li>
        <li>In ut lorem eros. Nam sit amet molestie arcu.</li>
        <li>Aliquam quis magna nunc. Sed convallis dictum efficitur.</li>
    </ul>

    <ol>
        <li>Quisque lobortis dui ultricies orci aliquet scelerisque.</li>
        <li>Vivamus sit amet nisi laoreet erat finibus commodo.</li>
        <li>Duis vitae sapien tincidunt nulla sollicitudin sollicitudin vel fringilla eros.</li>
        <li>Nullam viverra eros at nisl volutpat, quis rhoncus neque auctor.</li>
        <li>Proin turpis tellus, vehicula nec ornare sed, accumsan in lacus.</li>
        <li>In ut lorem eros. Nam sit amet molestie arcu.</li>
        <li>Aliquam quis magna nunc. Sed convallis dictum efficitur.</li>
    </ol>
</div>
@endsection
