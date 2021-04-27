<!doctype html>
<html {!! get_language_attributes() !!}>
    @include('blocks.head')

    <body @php body_class() @endphp>

        @php do_action('get_header') @endphp
        @include('blocks.header')
        @include('blocks.menu.mobile')
        @include('blocks.menu.aside')
        @include('components.info')

        <main>
            @yield('content')
        </main>

        @php do_action('get_footer') @endphp
        @include('blocks.footer')
        @include('components.backdrop')
        @include('components.preloader')
        @include('components.privacyPolicy')
        @include('components.upBtn')
        @php wp_footer() @endphp

    </body>
</html>
