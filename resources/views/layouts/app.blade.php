<!doctype html>
<html {!! get_language_attributes() !!}>
    @include('partials.head')
    <body @php body_class() @endphp>

        @php do_action('get_header') @endphp
        @include('partials.header')
        @include('partials.menu-mobile')
        @include('partials.menu-aside')
        @include('partials.info')

        <main>
            @yield('content')
        </main>

        @php do_action('get_footer') @endphp
        @include('partials.footer')
        @include('partials.backdrop')
        @include('partials.preloader')
        @php wp_footer() @endphp

    </body>
</html>
