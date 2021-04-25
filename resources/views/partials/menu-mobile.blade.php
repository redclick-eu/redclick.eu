@php use App\Controllers\App as A @endphp
<div class="menu_mobile js-sticky">
    <div class="menu-hamburger"  data-toggle="#menu-aside,#mobile-hamburger">
        <button class="hamburger hamburger--slider" id="mobile-hamburger">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>

    <a id="menu-mobile-logo" class="menu-logo {!! get_search_query() ? 'is-active' : '' !!}" href="{!! get_home_url() !!}"></a>

    @include("partials.search-mobile")

    <a class="menu-phone" href="tel:{!! App\create_link_phone(A::redclick("phone_number")) !!}"></a>

    <div class="menu-additional" data-toggle="#info-mobile,#mobile-dots">
        <div class="menu-dots" id="mobile-dots"></div>
    </div>
</div>
