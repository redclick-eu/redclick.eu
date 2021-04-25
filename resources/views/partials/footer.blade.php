@php use App\Controllers\App as A @endphp
<footer class="footer">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-copyright"><span>© {!! A::get_field("company_name") !!}, {!! date("Y") !!}.</span>
                @php(wp_nav_menu(["theme_location" => "footer_navigation", 'container_class' => 'menu_footer']))
            </div>
            <div class="footer-links">
                <a href="tel:{!! App\create_link_phone(A::get_field("phone_number")) !!}" class="footer-link footer-link_phone">{!! A::get_field("phone_number") !!}</a>
                <a href="mailto:{!! A::get_field("email_address") !!}" class="footer-link footer-link_mail">{!! A::get_field("email_address") !!}</a>
                <a target="_blank" rel="nofollow" href="{!! A::get_field("fb_url") !!}" class="footer-link footer-link_fb"></a>
            </div>
        </div>
    </div>
</footer>

<button id="up" class="btn-scroll-top invisible"></button>
