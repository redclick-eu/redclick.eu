@php use App\Controllers\App as A @endphp
<header class="header">
    <div class="header-container">
        <div class="header-row">
            <div class="header-logo">
                <a href="{!! esc_url(home_url( '/' )); !!}">
                    <img src="{!! App\asset_path("images/menu/logo_white.svg")  !!}" alt="Logo">
                </a>
            </div>
            <div class="header-languageSwitch">
                @include("components.languageSwitch")
            </div>
            <div class="header-menu">
                @include("blocks.menu.main")
            </div>
            <div class="header-phone">
                <a href="tel:{!! App\create_link_phone(A::get_field("phone_number")) !!}">{!! A::get_field("phone_number") !!}</a>
            </div>
        </div>
    </div>
</header>
