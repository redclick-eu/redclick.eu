<div class="menu_aside" id="menu-aside">
    @php wp_nav_menu(['theme_location'  => 'primary_navigation','container_class' => 'menu-menu' ])@endphp
    <div class="menu-languageSwitch">
        @include('partials.languageSwitch')
    </div>
</div>