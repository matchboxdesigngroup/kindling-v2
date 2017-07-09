@php
/**
 * Base template wrapper.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

@endphp
<!doctype html>
<html {{ language_attributes() }}>
    @include('partials.layouts.head')
    <body {{ body_class() }}>
        <div class="body-bg">
            @include('templates.partials.outdated')

            @php
            do_action('get_header');
            @endphp

            @include('partials.layouts.header')

            <div class="site-wrap content-bg" role="document">
                <div class="container">
                    <div class="content row">
                        <main class="main">
                            @yield('content')
                        </main> {{-- /.main --}}

                        @if (kindling_display_sidebar())
                            @yield('sidebar')
                        @endif
                    </div> {{-- /.content --}}
                </div>
            </div> {{-- /.site-wrap --}}

            @php
            do_action('get_footer');
            @endphp

            @include('partials.layouts.footer')

            @php
            wp_footer();
            @endphp
        </div>
    </body>
</html>
