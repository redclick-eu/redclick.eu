<header class="header">
    <div class="header-container">
        <div class="header-row">
            <div class="header-logo">
                <a href="{!! esc_url(home_url( '/' )); !!}">
                    <img src="{!! get_template_directory_uri() !!}/assets/images/Logo_white.svg" alt="Logo">
                </a>
            </div>
            <div class="header-languageSwitch">
                @include("partials.languageSwitch")
            </div>
            <div class="header-menu">
                @include("partials.menu-main")
            </div>
            <div class="header-phone">
                <a href="tel:%%PHONE%%">+7 (958) 756-85-02</a>
            </div>
        </div>
    </div>
</header>
