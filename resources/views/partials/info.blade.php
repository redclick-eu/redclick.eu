@php use App\Controllers\App as A @endphp
<ul class="info" id="info-mobile">
    <li class="info-item">
        <a href="tel:{!! App\create_link_phone(A::redclick("phone_number")) !!}" class="info-link info-link_phone">
            {!! A::redclick("phone_number") !!}
        </a>
    </li>
    <li class="info-item">
        <a href="mailto:{!! A::redclick("email_address") !!}" class="info-link info-link_email">{!! A::redclick("email_address") !!}</a>
    </li>
</ul>
