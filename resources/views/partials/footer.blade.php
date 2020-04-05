@php use App\Controllers\App as A @endphp
<footer class="footer">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-copyright"><span>© {!! A::redclick("company_name") !!}, {!! date("Y") !!}.</span>
                <?php wp_nav_menu(["theme_location" => "footer_navigation"]) ?>
            </div>
            <div class="footer-links">
                <a target="_blank" rel="nofollow" href="tel:{!! App\create_link_phone(A::redclick("phone_number")) !!}" class="footer-link footer-link_phone">{!! A::redclick("phone_number") !!}</a>
                <a href="mailto:{!! A::redclick("email_address") !!}" class="footer-link footer-link_mail">{!! A::redclick("email_address") !!}</a>
                <a href="{!! A::redclick("fb_url") !!}" class="footer-link footer-link_fb"></a>
            </div>
        </div>
    </div>
</footer>